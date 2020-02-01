<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Cache;
use Illuminate\Contracts\View\Factory;
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
        $data = Cache::remember('dashboard', 30 * 24 * 60 * 60, function () {
            $users = User::all();

            /** @var Transaction[] $transactions */
            $transactions = Transaction::with('contributions')->get();

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
                'balances' => $balances,
                'purchases' => $purchases,
                'contributions' => $contributions,
            ];
        });

        $data['transactions'] = Transaction::with('contributions')->latest()->simplePaginate(10);

        return view('dashboard', $data);
    }
}
