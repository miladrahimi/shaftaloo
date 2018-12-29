<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Archive
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Archive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Archive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Archive query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Archive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Archive whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Archive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Archive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Archive whereUserId($value)
 * @mixin \Eloquent
 */
class Archive extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
