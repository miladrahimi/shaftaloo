<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Contribution;
use App\Models\Transaction;
use Auth;
use DB;

class ArchivesController extends Controller
{
    public function getIndex()
    {
        $archives = Archive::all();

        return view('archives-index', [
            'archives' => $archives,
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function getPerform()
    {
        $transactions = Transaction::with('contributions')
            ->whereArchiveId(null)
            ->get();

        $items = [];
        foreach ($transactions as $transaction) {
            /** @var Contribution $contribution */
            foreach ($transaction->contributions as $contribution) {
                $userId = $contribution->user_id;

                if (isset($items[$userId]) == false) {
                    $items[$userId] = [
                        'user_id' => $userId,
                        'balance' => 0,
                    ];
                }

                $items[$userId]['balance'] += $contribution->value;
            }
        }

        DB::transaction(function () use ($items) {
            $archive = new Archive();
            $archive->user_id = Auth::id();
            $archive->description = json_encode($items);
            $archive->save();

            Transaction::whereArchiveId(null)->update(['archive_id' => $archive->id]);
        });

        return back()->with('success', 'Archived successfully.');
    }
}