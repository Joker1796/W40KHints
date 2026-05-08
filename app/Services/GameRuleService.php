<?php

namespace App\Services;

use App\Models\GameRule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameRuleService
{
    public static function create(Request $request): Response
    {
        if (self::isGameRuleNameExists($request->name)) {
            return response('This rule name already exists.', 400);
        }

        $gameRule = new GameRule;
        $gameRule->name = $request->name;
        $gameRule->description = $request->description ?? null;
        $gameRule->comment = $request->comment ?? null;
        $gameRule->text = $request->text;

        if (isset($request->version)) {
            $gameRule->version = $request->version;
        } else {
            $gameRule->version = 1;
        }

        $gameRule->save();

        return response($gameRule, 200);
    }

    public static function update(Request $request, GameRule $gameRule): Response
    {
        if (isset($request->isNewVersion) && $request->isNewVersion) {
            $gameRule = $gameRule->replicate();
            $gameRule->version = $gameRule->version + 1;
        } elseif (self::isGameRuleNameExists($request->name)) {
            return response('This rule name already exists.', 400);
        }

        $gameRule->name = $request->name;
        $gameRule->description = $request->description ?? null;
        $gameRule->comment = $request->comment ?? null;
        $gameRule->text = $request->text;

        $gameRule->save();

        return response($gameRule, 200);
    }

    public static function destroy(GameRule $gameRule): Response
    {
        $gameRule->is_deleted = true;

        $gameRule->save();

        return response('Ok', 200);
    }

    private static function isGameRuleNameExists(string $name): bool
    {
        return GameRule::where('name', $name)
            ->exists();
    }
}
