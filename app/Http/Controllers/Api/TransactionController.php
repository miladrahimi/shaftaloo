<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiErrorException;
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
 * @package App\Http\Controllers\Api
 */
class TransactionController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
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
            throw new ApiErrorException('At least two contribution is needed!');
        }

        if ($sum != 0) {
            throw new ApiErrorException('Transaction sum is: ' . $sum);
        }

        DB::transaction(function () use ($contributions, $request) {
            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->title = strtolower($request->input('title'));
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

        return new JsonResponse(['message' => 'Transaction added successfully.']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $transaction = Transaction::find($request->input('id'));

        if ($transaction && $transaction->user_id == Auth::id()) {
            $transaction->delete();
        }

        return new JsonResponse(['message' => 'Transaction deleted successfully.']);
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
