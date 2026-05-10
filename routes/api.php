<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\GameRuleController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\WargearController;
use App\Http\Controllers\WeaponProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/keyword/create', [KeywordController::class, 'create']);
Route::get('/keyword/{keyword}', [KeywordController::class, 'show']);
Route::put('/keyword/{keyword}', [KeywordController::class, 'update']);
Route::delete('/keyword/{keyword}', [KeywordController::class, 'softDelete']);

Route::get('/ability/create', [AbilityController::class, 'create']);
Route::get('/ability/{ability}', [AbilityController::class, 'show']);
Route::put('/ability/{ability}', [AbilityController::class, 'update']);
Route::delete('/ability/{ability}', [AbilityController::class, 'softDelete']);

Route::get('/game-rule/create', [GameRuleController::class, 'create']);
Route::get('/game-rule/{gameRule}', [GameRuleController::class, 'show']);
Route::put('/game-rule/{gameRule}', [GameRuleController::class, 'update']);
Route::delete('/game-rule/{gameRule}', [GameRuleController::class, 'softDelete']);

Route::get('/wargear/create', [WargearController::class, 'create']);
Route::get('/wargear/{wargear}', [WargearController::class, 'show']);
Route::put('/wargear/{wargear}', [WargearController::class, 'update']);
Route::delete('/wargear/{wargear}', [WargearController::class, 'softDelete']);
Route::put('/wargear/{wargear}/ability/{ability}', [WargearController::class, 'attachAbility']);
Route::delete('/wargear/{wargear}/ability/{ability}', [WargearController::class, 'detachAbility']);

Route::get('/weapon/create', [WeaponController::class, 'create']);
Route::get('/weapon/{weapon}', [WeaponController::class, 'show']);
Route::put('/weapon/{weapon}', [WeaponController::class, 'update']);
Route::delete('/weapon/{weapon}', [WeaponController::class, 'softDelete']);
Route::delete('/weapon/{weapon}/profile/{weaponProfile}', [WeaponController::class, 'deleteWeaponProfile']);

Route::get('/weapon/{weapon}/weapon-profile/create', [WeaponProfileController::class, 'create']);
Route::get('/weapon-profile/{weaponProfile}', [WeaponProfileController::class, 'show']);
Route::put('/weapon-profile/{weaponProfile}', [WeaponProfileController::class, 'update']);
Route::delete('/weapon-profile/{weaponProfile}', [WeaponProfileController::class, 'softDelete']);
Route::put('/weapon-profile/{weaponProfile}/keyword/{keyword}', [WeaponProfileController::class, 'attachKeyword']);
Route::delete('/weapon-profile/{weaponProfile}/keyword/{keyword}', [WeaponProfileController::class, 'detachKeyword']);
