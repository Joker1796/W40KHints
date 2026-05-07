<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wargear extends Model
{
    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(Ability::class);
    }
}
