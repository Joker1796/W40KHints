<?php

namespace App\Services;

use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RuleService
{
    public static function create(Request $request): Response
    {
        if (self::isRuleNameExists($request->name)) {
            return response('This rule name already exists.', 400);
        }

        $rule = new Rule;
        $rule->name = $request->name;
        $rule->description = $request->description;
        $rule->html = $request->html;
        $rule->version = 1;

        $rule->save();

        return response($rule, 200);
    }

    public static function update(Request $request, Rule $rule): Response
    {
        if (self::isRuleNameExists($request->name)) {
            return response('This rule name already exists.', 400);
        }

        if (isset($request->isNewVersion) && $request->isNewVersion) {
            $rule->version = $rule->version + 1;
        }

        $rule->name = $request->name;
        $rule->description = $request->description;
        $rule->html = $request->html;

        $rule->save();

        return response($rule, 200);
    }

    public static function destroy(Rule $rule): Response
    {
        $rule->is_deleted = true;

        $rule->save();

        return response('Ok', 200);
    }

    private static function isRuleNameExists(string $name): bool
    {
        return Rule::where('name', $name)
            ->exists();
    }
}
