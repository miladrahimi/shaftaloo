<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Cache;

class DashboardController extends Controller
{
    public function show()
    {
        $data = Cache::remember('dashboard', 30 * 24 * 60 * 60, function () {
            $users = User::withTrashed()->get();
            $activeUsers = User::all();

            /** @var Transaction[] $transactions */
            $transactions = Transaction::with(['contributions', 'contributions.user'])->get();

            $balances = $contributions = $purchases = [];
            foreach ($users as $user) {
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

            return [
                'users' => $users,
                'activeUsers' => $activeUsers,
                'balances' => $balances,
                'purchases' => $purchases,
                'contributions' => $contributions,
            ];
        });

        $data['transactions'] = Transaction::with('contributions')->latest()->simplePaginate(10);

        return view('dashboard', $data);
    }
}
