<?php

namespace App\Services;

use App\Models\Weapon;
use App\Models\WeaponProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class WeaponService
{
    public static function create(Request $request): Response
    {
        if (self::isWeaponNameExists($request->name)) {
            return response('This weapon name already exists.', 400);
        }

        $weapon = new Weapon;
        $weapon->name = $request->name;
        $weapon->description = $request->description ?? null;
        $weapon->type = $request->type;

        $weapon->save();

        return response($weapon, 200);
    }

    public static function update(Request $request, Weapon $weapon): Response
    {
        if (isset($request->isNewVersion) && $request->isNewVersion) {
            $weapon = $weapon->replicate();
            $weapon->version = $weapon->version + 1;
        } elseif (self::isWeaponNameExists($request->name)) {
            return response('This weapon name already exists.', 400);
        }

        $weapon->name = $request->name;
        $weapon->description = $request->description ?? null;
        $weapon->type = $request->type;

        $weapon->save();

        return response($weapon, 200);
    }

    public static function softDelete(Weapon $weapon): Response
    {
        $weapon->delete();

        return response($weapon, 200);
    }

    public static function deleteWeaponProfile(Weapon $weapon, WeaponProfile $weaponProfile): Response
    {
        $weapon->weaponProfiles()->delete($weaponProfile->id);

        return response($weapon, 200);
    }

    private static function isWeaponNameExists(string $name): bool
    {
        return Weapon::where('name', $name)
            ->exists();
    }
}
