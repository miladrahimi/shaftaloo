<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function show()
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

        return view('dashboard', [
            'users' => $users,
            'balances' => $balances,
            'purchases' => $purchases,
            'contributions' => $contributions,
            'transactions' => $transactions,
        ]);
    }
}
