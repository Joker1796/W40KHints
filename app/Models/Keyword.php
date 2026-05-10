<?php

namespace App\Models;

use Database\Factories\KeywordFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keyword extends Model
{
    /** @use HasFactory<KeywordFactory> */
    use HasFactory, SoftDeletes;

    public function weaponProfiles(): BelongsToMany
    {
        return $this->belongsToMany(WeaponProfile::class);
    }
}
