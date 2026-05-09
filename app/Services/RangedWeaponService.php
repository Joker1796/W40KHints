<?php

namespace App\Services;

use App\Models\Keyword;
use App\Models\RangedWeapon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RangedWeaponService
{
    public static function create(Request $request): Response
    {
        if (self::isRangedWeaponNameExists($request->name)) {
            return response('This ranged weapon name already exists.', 400);
        }

        $rangedWeapon = new RangedWeapon;
        $rangedWeapon->name = $request->name;
        $rangedWeapon->description = $request->description ?? null;
        $rangedWeapon->range = $request->range;
        $rangedWeapon->A = $request->A;
        $rangedWeapon->BS = $request->BS;
        $rangedWeapon->S = $request->S;
        $rangedWeapon->AP = $request->AP;
        $rangedWeapon->D = $request->D;

        $rangedWeapon->save();

        if ($request->keywords) {
            $keywords = Keyword::find($request->keywords);
            $rangedWeapon->keywords()->attach($keywords);
        }

        return response($rangedWeapon, 200);
    }

    public static function update(Request $request, RangedWeapon $rangedWeapon): Response
    {
        if (isset($request->isNewVersion) && $request->isNewVersion) {
            $rangedWeapon = $rangedWeapon->replicate();
            $rangedWeapon->version = $rangedWeapon->version + 1;
        } elseif (self::isRangedWeaponNameExists($request->name)) {
            return response('This ranged weapon name already exists.', 400);
        }

        $rangedWeapon->name = $request->name;
        $rangedWeapon->description = $request->description ?? null;
        $rangedWeapon->range = $request->range;
        $rangedWeapon->A = $request->A;
        $rangedWeapon->BS = $request->BS;
        $rangedWeapon->S = $request->S;
        $rangedWeapon->AP = $request->AP;
        $rangedWeapon->D = $request->D;

        $rangedWeapon->save();

        if ($request->keywords) {
            $keywords = Keyword::find($request->keywords);
            $rangedWeapon->keywords()->attach($keywords);
        }

        return response($rangedWeapon, 200);
    }

    public static function softDelete(RangedWeapon $rangedWeapon): Response
    {
        $rangedWeapon->delete();

        return response($rangedWeapon, 200);
    }

    public static function attachKeyword(RangedWeapon $rangedWeapon, Keyword $keyword): Response
    {
        $rangedWeapon->keywords()->attach($keyword);

        return response($rangedWeapon, 200);
    }

    public static function detachKeyword(RangedWeapon $rangedWeapon, Keyword $keyword): Response
    {
        $rangedWeapon->keywords()->detach($keyword);

        return response($rangedWeapon, 200);
    }

    private static function isRangedWeaponNameExists(string $name): bool
    {
        return RangedWeapon::where('name', $name)
            ->exists();
    }
}
