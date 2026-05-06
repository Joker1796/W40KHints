<?php

namespace App\Services;

use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class KeywordService
{
    public static function create(Request $request): Response
    {
        if (self::isKeywordExists($request->name)) {
            return response('This keyword already exists.', 400);
        }

        $keyword = new Keyword;
        $keyword->name = $request->name;

        $keyword->save();

        return response($keyword, 200);
    }

    public static function update(Request $request, Keyword $keyword): Response
    {
        if (self::isKeywordExists($request->name)) {
            return response('This keyword already exists.', 400);
        }

        $keyword->name = $request->name;
        $keyword->save();

        return response($keyword, 200);
    }

    private static function isKeywordExists(string $name): bool
    {
        return Keyword::where('name', $name)
            ->exists();
    }
}
