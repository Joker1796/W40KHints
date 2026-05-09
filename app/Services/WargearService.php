<?php

namespace App\Services;

use App\Models\Ability;
use App\Models\Wargear;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class WargearService
{
    public static function create(Request $request): Response
    {
        if (self::isWargearNameExists($request->name)) {
            return response('This wargear name already exists.', 400);
        }

        $wargear = new Wargear;
        $wargear->name = $request->name;
        $wargear->description = $request->description;
        $wargear->version = 1;
        $wargear->save();

        if ($request->abilities) {
            $abilities = Ability::find($request->abilities);
            $wargear->abilities()->attach($abilities);
        }

        return response($wargear, 200);
    }

    public static function update(Request $request, Wargear $wargear): Response
    {
        if (isset($request->isNewVersion) && $request->isNewVersion) {
            $wargear = $wargear->replicate();
            $wargear->version = $wargear->version + 1;
        } elseif (self::isWargearNameExists($request->name)) {
            return response('This wargear name already exists.', 400);
        }

        $wargear->name = $request->name;
        $wargear->description = $request->description;
        $wargear->save();

        if ($request->abilities) {
            $abilities = Ability::find($request->abilities);
            $wargear->abilities()->attach($abilities);
        }

        return response($wargear, 200);
    }

    public static function softDelete(Wargear $wargear): Response
    {
        $wargear->delete();

        return response($wargear, 200);
    }

    public static function attachAbility(Wargear $wargear, Ability $ability): Response
    {
        $wargear->abilities()->attach($ability);

        return response($wargear, 200);
    }

    public static function detachAbility(Wargear $wargear, Ability $ability): Response
    {
        $wargear->abilities()->detach($ability);

        return response($wargear, 200);
    }

    private static function isWargearNameExists(string $name): bool
    {
        return Wargear::where('name', $name)
            ->exists();
    }
}
