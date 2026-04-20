<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('characters', CharacterController::class);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('characters', CharacterController::class);
// });
