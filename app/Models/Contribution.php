<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Contribution
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $user_id
 * @property int $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Transaction $transaction
 * @property-read User $user
 * @method static Builder|Contribution newModelQuery()
 * @method static Builder|Contribution newQuery()
 * @method static Builder|Contribution query()
 * @method static Builder|Contribution whereCreatedAt($value)
 * @method static Builder|Contribution whereId($value)
 * @method static Builder|Contribution whereTransactionId($value)
 * @method static Builder|Contribution whereUpdatedAt($value)
 * @method static Builder|Contribution whereUserId($value)
 * @method static Builder|Contribution whereValue($value)
 * @mixin Eloquent
 */
class Contribution extends Model
{
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
