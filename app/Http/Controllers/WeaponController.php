<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\WeaponProfile;
use App\Services\WeaponService;
use Illuminate\Http\Request;

class WeaponController extends Controller
{
    public function create(Request $request)
    {
        return WeaponService::create($request);
    }

    public function show(Weapon $weapon)
    {
        return response($weapon, 200);
    }

    public function update(Request $request, Weapon $weapon)
    {
        return WeaponService::update($request, $weapon);
    }

    public function softDelete(Weapon $weapon)
    {
        return WeaponService::softDelete($weapon);
    }

    public function addWeaponProfile(Weapon $weapon, WeaponProfile $weaponProfile)
    {
        return WeaponService::addWeaponProfile($weapon, $weaponProfile);
    }

    public function deleteWeaponProfile(Weapon $weapon, WeaponProfile $weaponProfile)
    {
        return WeaponService::deleteWeaponProfile($weapon, $weaponProfile);
    }
}
