<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function create(Request $request)
    {
        $keyword = new Keyword;

        $keyword->name = $request->name;

        $keyword->save();

        return response($keyword, 200);
    }

    public function show(Keyword $keyword)
    {
        return response($keyword, 200);
    }

    public function update(Request $request, Keyword $keyword)
    {
        $keyword->name = $request->name;

        $keyword->save();

        return response($keyword, 200);
    }

    public function destroy(Keyword $keyword)
    {
        $keyword->delete();

        return response('Ok', 200);
    }
}
