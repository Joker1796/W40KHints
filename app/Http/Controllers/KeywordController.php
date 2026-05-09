<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Services\KeywordService;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function create(Request $request)
    {
        return KeywordService::create($request);
    }

    public function show(Keyword $keyword)
    {
        return response($keyword, 200);
    }

    public function update(Request $request, Keyword $keyword)
    {
        return KeywordService::update($request, $keyword);
    }

    public function softDelete(Keyword $keyword)
    {
        return KeywordService::softDelete($keyword);
    }
}
