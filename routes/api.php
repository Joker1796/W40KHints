<?php

use App\Http\Controllers\KeywordController;
use App\Http\Controllers\RuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/keyword/create', [KeywordController::class, 'create']);
Route::get('/keyword/{keyword}', [KeywordController::class, 'show']);
Route::put('/keyword/{keyword}', [KeywordController::class, 'update']);
Route::delete('/keyword/{keyword}', [KeywordController::class, 'destroy']);

Route::get('/rule/create', [RuleController::class, 'create']);
Route::get('/rule/{rule}', [RuleController::class, 'show']);
Route::put('/rule/{rule}', [RuleController::class, 'update']);
Route::delete('/rule/{rule}', [RuleController::class, 'destroy']);
