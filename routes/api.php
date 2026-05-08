<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\GameRuleController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\RangedWeaponController;
use App\Http\Controllers\WargearController;
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

Route::get('/game-rule/create', [GameRuleController::class, 'create']);
Route::get('/game-rule/{gameRule}', [GameRuleController::class, 'show']);
Route::put('/game-rule/{gameRule}', [GameRuleController::class, 'update']);
Route::delete('/game-rule/{gameRule}', [GameRuleController::class, 'destroy']);

Route::get('/wargear/create', [WargearController::class, 'create']);
Route::get('/wargear/{wargear}', [WargearController::class, 'show']);
Route::put('/wargear/{wargear}', [WargearController::class, 'update']);
Route::delete('/wargear/{wargear}', [WargearController::class, 'destroy']);
Route::put('/wargear/{wargear}/ability/{ability}', [WargearController::class, 'attachAbility']);
Route::delete('/wargear/{wargear}/ability/{ability}', [WargearController::class, 'detachAbility']);

Route::get('/ranged-weapon/create', [RangedWeaponController::class, 'create']);
Route::get('/ranged-weapon/{rangedWeapon}', [RangedWeaponController::class, 'show']);
Route::put('/ranged-weapon/{rangedWeapon}', [RangedWeaponController::class, 'update']);
Route::delete('/ranged-weapon/{rangedWeapon}', [RangedWeaponController::class, 'destroy']);
Route::put('/ranged-weapon/{rangedWeapon}/keyword/{keyword}', [RangedWeaponController::class, 'attachKeyword']);
Route::delete('/ranged-weapon/{rangedWeapon}/keyword/{keyword}', [RangedWeaponController::class, 'detachKeyword']);
