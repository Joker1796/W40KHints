<?php

use App\Http\Controllers\KeywordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/keyword/create', [KeywordController::class, 'create']);
Route::get('/keyword/{keyword}', [KeywordController::class, 'show']);
Route::put('/keyword/{keyword}', [KeywordController::class, 'update']);
Route::delete('/keyword/{keyword}', [KeywordController::class, 'destroy']);
