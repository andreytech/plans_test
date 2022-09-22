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
 * @property boolean is_beta
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 *
 * @property-read Collection $plans
 */
class Feature extends Model
{
    use HasFactory;

    protected $casts = [
        'is_beta' => 'boolean',
    ];

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class);
    }
}
