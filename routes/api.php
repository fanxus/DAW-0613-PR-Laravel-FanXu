<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//User
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


//Character
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/characters', [CharacterController::class, 'store']);
    Route::put('/characters/{character}', [CharacterController::class, 'update']);
    Route::delete('/characters/{character}', [CharacterController::class, 'destroy']);
});

Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/characters/{character}', [CharacterController::class, 'show']);
