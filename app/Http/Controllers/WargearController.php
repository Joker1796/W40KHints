<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Wargear;
use App\Services\WargearService;
use Illuminate\Http\Request;

class WargearController extends Controller
{
    public function create(Request $request)
    {
        return WargearService::create($request);
    }

    public function show(Wargear $wargear)
    {
        return response($wargear, 200);
    }

    public function update(Request $request, Wargear $wargear)
    {
        return WargearService::update($request, $wargear);
    }

    public function softDelete(Wargear $wargear)
    {
        return WargearService::softDelete($wargear);
    }

    public function attachAbility(Wargear $wargear, Ability $ability)
    {
        return WargearService::attachAbility($wargear, $ability);
    }

    public function detachAbility(Wargear $wargear, Ability $ability)
    {
        return WargearService::detachAbility($wargear, $ability);
    }
}
