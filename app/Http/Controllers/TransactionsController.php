<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class TransactionsController extends Controller
{
    public function index()
    {
        $users = User::all();

        /** @var Transaction[] $transactions */
        $transactions = Transaction::with(['contributions', 'contributions.user'])->get();

        $balances = $contributions = $purchases = [];
        foreach (User::withTrashed()->get() as $user) {
            $balances[$user->id] = $contributions[$user->id] = 0;
        }

        foreach ($transactions as $transaction) {
            foreach ($transaction->contributions as $contribution) {
                $balances[$contribution->user_id] += $contribution->value;
                $contributions[$contribution->user_id]++;
            }

            isset($purchases[$transaction->user_id]) || $purchases[$transaction->user_id] = 0;
            $purchases[$transaction->user_id]++;
        }

        $transactions = Transaction::with('contributions')->latest()->simplePaginate(10);

        return view('transactions.index', [
            'users' => $users,
            'balances' => $balances,
            'purchases' => $purchases,
            'contributions' => $contributions,
            'transactions' => $transactions,
        ]);
    }

    public function create()
    {
        $users = User::orderBy('username')->get()->reject(function (User $user) {
            return $user->id == Auth::id();
        })->prepend(Auth::user());

        return view('transactions.create', [
            'users' => $users
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(Request $request)
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
            return back()->with('error', 'At least two contribution is needed!')->withInput();
        }

        if ($sum != 0) {
            return back()->with('error', 'Transaction sum is: ' . $sum)->withInput();
        }

        DB::transaction(function () use ($contributions, $request) {
            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->title = strtolower($request->input('title'));
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
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Request $request)
    {
        $transaction = Transaction::find($request->input('id'));

        if ($transaction && $transaction->user_id == Auth::id()) {
            $transaction->delete();
        }

        return back();
    }

    public function titles()
    {
        $titles = Transaction::select(['title'])
            ->distinct()
            ->orderBy('title')
            ->get()
            ->pluck('title');

        return new JsonResponse($titles);
    }
}
