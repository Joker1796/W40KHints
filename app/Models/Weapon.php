<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weapon extends Model
{
    /** @use HasFactory<Weapon> */
    use HasFactory, SoftDeletes;

    public function weaponProfiles(): HasMany
    {
        return $this->hasMany(WeaponProfile::class);
    }
}
