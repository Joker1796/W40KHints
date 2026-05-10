<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Weapon;
use App\Models\WeaponProfile;
use App\Services\WeaponProfileService;
use Illuminate\Http\Request;

class WeaponProfileController extends Controller
{
    public function create(Request $request, Weapon $weapon)
    {
        return WeaponProfileService::create($request, $weapon);
    }

    public function show(WeaponProfile $weaponProfile)
    {
        return response($weaponProfile, 200);
    }

    public function update(Request $request, WeaponProfile $weaponProfile)
    {
        return WeaponProfileService::update($request, $weaponProfile);
    }

    public function softDelete(WeaponProfile $weaponProfile)
    {
        return WeaponProfileService::softDelete($weaponProfile);
    }

    public function attachKeyword(WeaponProfile $weaponProfile, Keyword $keyword)
    {
        return WeaponProfileService::attachKeyword($weaponProfile, $keyword);
    }

    public function detachKeyword(WeaponProfile $weaponProfile, Keyword $keyword)
    {
        return WeaponProfileService::detachKeyword($weaponProfile, $keyword);
    }
}
