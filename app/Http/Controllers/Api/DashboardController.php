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
        $transactions = Transaction::with('contributions')->orderBy('id', 'desc')->get();

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

        $results = [];

        /** @var User $user */
        foreach ($users as $user) {
            $results[$user->id] = [
                'username' => $user->username,
                'value' => $balances[$user->id],
                'contributions' => $contributions[$user->id],
            ];
        }

        return new JsonResponse([
            'balances' => $results,
            'transactions' => $transactions,
        ]);
    }
}
