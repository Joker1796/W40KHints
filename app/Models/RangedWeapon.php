<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RangedWeapon extends Model
{
    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class);
    }
}
