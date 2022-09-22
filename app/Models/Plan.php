<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int id
 * @property string name
 * @property string description
 * @property int price
 * @property int type_id
 * @property int|null trial_in_days
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 *
 * @property-read Collection $features
 */
class Plan extends Model
{
    use HasFactory;

    const TYPE_ID_DEFAULT = 1;
    const TYPE_ID_POPULAR = 2;
    const TYPE_ID_RECOMMENDED = 3;

    const TYPE_IDS = [
        self::TYPE_ID_DEFAULT => 'default',
        self::TYPE_ID_POPULAR => 'popular',
        self::TYPE_ID_RECOMMENDED => 'recommended',
    ];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }
}
