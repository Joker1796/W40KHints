<?php

namespace App\Services;

use App\Models\Ability;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class AbilityService
{
    public static function create(Request $request): Response
    {
        if (self::isAbilityNameExists($request->name)) {
            return response('This ability name already exists.', 400);
        }

        $ability = new Ability;
        $ability->name = $request->name;
        $ability->description = $request->description;
        $ability->html = $request->html;
        $ability->version = 1;

        $ability->save();

        return response($ability, 200);
    }

    public static function update(Request $request, Ability $ability): Response
    {
        if (self::isAbilityNameExists($request->name)) {
            return response('This ability name already exists.', 400);
        }

        if (isset($request->isNewVersion) && $request->isNewVersion) {
            $ability->version = $ability->version + 1;
        }

        $ability->name = $request->name;
        $ability->description = $request->description;
        $ability->html = $request->html;

        $ability->save();

        return response($ability, 200);
    }

    public static function destroy(Ability $ability): Response
    {
        $ability->is_deleted = true;

        $ability->save();

        return response('Ok', 200);
    }

    private static function isAbilityNameExists(string $name): bool
    {
        return Ability::where('name', $name)
            ->exists();
    }
}
