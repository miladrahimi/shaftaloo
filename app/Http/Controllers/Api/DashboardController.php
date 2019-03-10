<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Api
 */
class DashboardController extends ApiController
{
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

        return new JsonResponse([
            'users' => $users,
            'transactions' => $transactions,
            'balances' => $balances,
            'contributions' => $contributions,
        ]);
    }
}
