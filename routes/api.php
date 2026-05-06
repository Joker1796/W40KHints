<?php

use App\Http\Controllers\KeywordController;
use App\Http\Controllers\AbilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/keyword/create', [KeywordController::class, 'create']);
Route::get('/keyword/{keyword}', [KeywordController::class, 'show']);
Route::put('/keyword/{keyword}', [KeywordController::class, 'update']);
Route::delete('/keyword/{keyword}', [KeywordController::class, 'destroy']);

Route::get('/ability/create', [AbilityController::class, 'create']);
Route::get('/ability/{ability}', [AbilityController::class, 'show']);
Route::put('/ability/{ability}', [AbilityController::class, 'update']);
Route::delete('/ability/{ability}', [AbilityController::class, 'destroy']);
