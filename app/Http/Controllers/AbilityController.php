<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Services\AbilityService;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    public function create(Request $request)
    {
        return AbilityService::create($request);
    }

    public function show(Ability $ability)
    {
        return response($ability, 200);
    }

    public function update(Request $request, Ability $ability)
    {
        return AbilityService::update($request, $ability);
    }

    public function softDelete(Ability $ability)
    {
        return AbilityService::softDelete($ability);
    }
}
