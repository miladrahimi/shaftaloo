<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * @return Factory|View
     */
    public function getDashboard()
    {
        $users = User::all();

        /** @var Transaction[] $transactions */
        $transactions = Transaction::with('contributions')->get();
        $transactionsPaginated = Transaction::with('contributions')->latest()->paginate(10);

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

        return view('dashboard', [
            'users' => $users,
            'transactions' => $transactionsPaginated,
            'balances' => $balances,
            'purchases' => $purchases,
            'contributions' => $contributions,
        ]);
    }
}
