<?php

namespace App\Console\Commands;

use App\Models\Contribution;
use App\Models\Transaction;
use App\Models\User;
use DB;
use Illuminate\Console\Command;

class Interest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:interest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate interests';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var Transaction[] $transactions */
        $transactions = Transaction::with(['contributions', 'contributions.user'])->get();

        $balances = $interests = [];
        foreach (User::withTrashed()->get() as $user) {
            $balances[$user->id] = $contributions[$user->id] = 0;
        }

        foreach ($transactions as $transaction) {
            foreach ($transaction->contributions as $contribution) {
                $balances[$contribution->user_id] += $contribution->value;
            }
        }

        $users = User::all();

        foreach ($users as $user) {
            $i = $balances[$user->id] * 0.2 / 365;
            $interests[$user->id] = $i > 0 ? ceil($i) : floor($i);
        }

        DB::transaction(function () use ($interests) {
            $transaction = new Transaction();
            $transaction->user_id = 0;
            $transaction->title = 'System Interest';
            $transaction->save();

            foreach ($interests as $userId => $value) {
                $contribution = new Contribution();
                $contribution->transaction_id = $transaction->id;
                $contribution->user_id = $userId;
                $contribution->value = $value;
                $contribution->save();
            }
        });

        return 0;
    }
}
