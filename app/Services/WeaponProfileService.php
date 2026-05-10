<?php

namespace App\Services;

use App\Models\Keyword;
use App\Models\Weapon;
use App\Models\WeaponProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeaponProfileService
{
    public static function create(Request $request, Weapon $weapon): Response
    {
        if (self::isWeaponProfileNameExists($request->name)) {
            return response('This weapon profile name already exists.', 400);
        }

        $weaponProfile = new WeaponProfile;
        $weaponProfile->name = $request->name;
        $weaponProfile->range = $request->range;
        $weaponProfile->attacks = $request->attacks;
        $weaponProfile->skills = $request->skills;
        $weaponProfile->strength = $request->strength;
        $weaponProfile->penetration = $request->penetration;
        $weaponProfile->damage = $request->damage;

        $weapon->weaponProfiles()->save($weaponProfile);

        if ($request->keywords) {
            $keywords = Keyword::find($request->keywords);
            $weaponProfile->keywords()->attach($keywords);
        }

        return response($weaponProfile, 200);
    }

    public static function update(Request $request, WeaponProfile $weaponProfile): Response
    {
        if (isset($request->isNewVersion) && $request->isNewVersion) {
            $weaponProfile = $weaponProfile->replicate();
            $weaponProfile->version = $weaponProfile->version + 1;
        } elseif (self::isWeaponProfileNameExists($request->name)) {
            return response('This weapon profile name already exists.', 400);
        }

        $weaponProfile->name = $request->name;
        $weaponProfile->range = $request->range;
        $weaponProfile->attacks = $request->attacks;
        $weaponProfile->skills = $request->skills;
        $weaponProfile->strength = $request->strength;
        $weaponProfile->penetration = $request->penetration;
        $weaponProfile->damage = $request->damage;

        $weaponProfile->save();

        if ($request->keywords) {
            $keywords = Keyword::find($request->keywords);
            $weaponProfile->keywords()->attach($keywords);
        }

        return response($weaponProfile, 200);
    }

    public static function softDelete(WeaponProfile $weaponProfile): Response
    {
        $weaponProfile->delete();

        return response($weaponProfile, 200);
    }

    public static function attachKeyword(WeaponProfile $weaponProfile, Keyword $keyword): Response
    {
        $weaponProfile->keywords()->attach($keyword);

        return response($weaponProfile, 200);
    }

    public static function detachKeyword(WeaponProfile $weaponProfile, Keyword $keyword): Response
    {
        $weaponProfile->keywords()->detach($keyword);

        return response($weaponProfile, 200);
    }

    private static function isWeaponProfileNameExists(string $name): bool
    {
        return WeaponProfile::where('name', $name)
            ->exists();
    }
}
