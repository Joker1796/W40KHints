<?php

namespace App\Models;

use Database\Factories\AbilityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ability extends Model
{
    /** @use HasFactory<AbilityFactory> */
    use HasFactory;

    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(Wargear::class);
    }
}
