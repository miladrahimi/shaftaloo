<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contribution
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $user_id
 * @property int $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Transaction $transaction
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereValue($value)
 * @mixin \Eloquent
 */
class Contribution extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
