<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\JsonResponse;
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
    public function getAdd()
    {
        $users = User::orderBy('username')->get()->reject(function (User $user) {
            return $user->id == Auth::id();
        })->prepend(Auth::user());

        return view('transactions-add', [
            'users' => $users
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
            return back()->with('error', 'At least two contribution is needed!')->withInput();
        }

        if ($sum != 0) {
            return back()->with('error', 'Transaction sum is: ' . $sum)->withInput();
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $transaction = Transaction::find($request->input('id'));

        if ($transaction && $transaction->user_id == Auth::id()) {
            $transaction->delete();
        }

        return back();
    }

    /**
     * @return JsonResponse
     */
    public function getTitles()
    {
        $titles = Transaction::select(['title'])
            ->distinct()
            ->orderBy('title')
            ->get()
            ->pluck('title');

        return new JsonResponse($titles);
    }
}
