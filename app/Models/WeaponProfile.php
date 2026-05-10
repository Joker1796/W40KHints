<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeaponProfile extends Model
{
    /** @use HasFactory<WeaponProfile> */
    use HasFactory, SoftDeletes;

    public function weapon(): BelongsTo
    {
        return $this->belongsTo(Weapon::class);
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class);
    }
}
