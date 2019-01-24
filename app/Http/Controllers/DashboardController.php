<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {
        $users = User::all();

        /** @var Transaction[] $transactions */
        $transactions = Transaction::with('contributions')->get();

        $balances = $contributions = [];
        foreach ($users as $user) {
            $balances[$user->id] = $contributions[$user->id] = 0;
        }

        foreach ($transactions as $transaction) {
            foreach ($transaction->contributions as $contribution) {
                $balances[$contribution->user_id] += $contribution->value;
                $contributions[$contribution->user_id]++;
            }
        }

        return view('dashboard', [
            'users' => $users,
            'transactions' => $transactions,
            'balances' => $balances,
            'contributions' => $contributions,
        ]);
    }
}