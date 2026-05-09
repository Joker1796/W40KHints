<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\RangedWeapon;
use App\Services\RangedWeaponService;
use Illuminate\Http\Request;

class RangedWeaponController extends Controller
{
    public function create(Request $request)
    {
        return RangedWeaponService::create($request);
    }

    public function show(RangedWeapon $rangedWeapon)
    {
        return response($rangedWeapon, 200);
    }

    public function update(Request $request, RangedWeapon $rangedWeapon)
    {
        return RangedWeaponService::update($request, $rangedWeapon);
    }

    public function softDelete(RangedWeapon $rangedWeapon)
    {
        return RangedWeaponService::softDelete($rangedWeapon);
    }

    public function attachKeyword(RangedWeapon $rangedWeapon, Keyword $keyword)
    {
        return RangedWeaponService::attachKeyword($rangedWeapon, $keyword);
    }

    public function detachKeyword(RangedWeapon $rangedWeapon, Keyword $keyword)
    {
        return RangedWeaponService::detachKeyword($rangedWeapon, $keyword);
    }
}
