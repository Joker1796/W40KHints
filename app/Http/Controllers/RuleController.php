<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Services\RuleService;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function create(Request $request)
    {
        return RuleService::create($request);
    }

    public function show(Rule $rule)
    {
        return response($rule, 200);
    }

    public function update(Request $request, Rule $rule)
    {
        return RuleService::update($request, $rule);
    }

    public function destroy(Rule $rule)
    {
        return RuleService::destroy($rule);
    }
}
