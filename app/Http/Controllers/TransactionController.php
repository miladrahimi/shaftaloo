<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Contribution;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;

/**
 * Class TransactionController
 *
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTransactions()
    {
        $users = User::all();
        $transactions = Transaction::with('contributions')
            ->whereArchiveId(null)
            ->get();

        $balances = $contributions = [];
        foreach ($transactions as $transaction) {
            /** @var Contribution $contribution */
            foreach ($transaction->contributions as $contribution) {
                $userId = $contribution->user_id;

                if (isset($balances[$userId]) == false) {
                    $balances[$userId] = $contributions[$userId] = 0;
                }

                $balances[$userId] += $contribution->value;
                $contributions[$userId]++;
            }
        }

        $balanceColor = function (int $balance): string {
            if ($balance > 0) {
                return 'success';
            } elseif ($balance < 0) {
                return 'warning';
            } else {
                return 'light';
            }
        };

        return view('transactions', [
            'users' => $users,
            'transactions' => $transactions,
            'balances' => $balances,
            'contributions' => $contributions,
            'balance_color' => $balanceColor,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteTransaction(Request $request)
    {
        $transaction = Transaction::find($request->input('id'));

        if ($transaction && $transaction->user_id == Auth::id()) {
            $transaction->delete();
        }

        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $users = User::all();

        return view('transactions-add', [
            'users' => $users,
            'u' => Auth::user(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
        ]);

        $sum = 0;
        $contributions = [];
        $anyContribution = false;

        foreach (User::all() as $user) {
            $contributions[$user->id] = intval($request->input($user->username));
            $sum += $contributions[$user->id];

            if ($contributions[$user->id] != 0) {
                $anyContribution = true;
            }
        }

        if ($anyContribution == false) {
            return back()->with('error', 'No money transferred!')->withInput();
        }

        if ($sum != 0) {
            return back()->with('error', 'Transaction must be zero!')->withInput();
        }

        DB::transaction(function () use ($contributions, $request) {
            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->title = $request->input('title');
            $transaction->save();

            foreach ($contributions as $userId => $value) {
                if ($value == 0) {
                    continue;
                }

                $contribution = new Contribution();
                $contribution->transaction_id = $transaction->id;
                $contribution->user_id = $userId;
                $contribution->value = $value;
                $contribution->save();
            }
        });

        return back()->with('success', 'Transaction added.');
    }

    /**
     * @throws \Throwable
     */
    public function getArchive()
    {
        DB::transaction(function () {
            $archive = new Archive();
            $archive->user_id = Auth::id();
            $archive->save();

            Transaction::whereArchiveId(null)->update(['archive_id' => $archive->id]);
        });

        return back();
    }
}
