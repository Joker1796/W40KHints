<?php

namespace App\Models;

use Database\Factories\KeywordFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Keyword extends Model
{
    /** @use HasFactory<KeywordFactory> */
    use HasFactory;

    public function rangedWeapons(): BelongsToMany
    {
        return $this->belongsToMany(RangedWeapon::class);
    }
}
