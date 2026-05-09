<?php

namespace App\Http\Controllers;

use App\Models\GameRule;
use App\Services\GameRuleService;
use Illuminate\Http\Request;

class GameRuleController extends Controller
{
    public function create(Request $request)
    {
        return GameRuleService::create($request);
    }

    public function show(GameRule $gameRule)
    {
        return response($gameRule, 200);
    }

    public function update(Request $request, GameRule $gameRule)
    {
        return GameRuleService::update($request, $gameRule);
    }

    public function softDelete(GameRule $gameRule)
    {
        return GameRuleService::softDelete($gameRule);
    }
}
