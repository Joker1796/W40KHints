<?php

namespace App\Models;

use Database\Factories\WargearFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wargear extends Model
{
    /** @use HasFactory<WargearFactory> */
    use HasFactory;

    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(Ability::class);
    }
}
