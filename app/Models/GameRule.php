<?php

namespace App\Models;

use Database\Factories\GameRuleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameRule extends Model
{
    /** @use HasFactory<GameRuleFactory> */
    use HasFactory;
}
