<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HutangController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::apiResource('hutang', HutangController::class);
    Route::get('/hutang', [HutangController::class, 'index']);
    Route::post('/hutang', [HutangController::class, 'create']);
    Route::get('/hutang/{id}', [HutangController::class, 'detail']);
    Route::put('/hutang/{id}', [HutangController::class, 'update']);
    Route::delete('/hutang/{id}', [HutangController::class, 'destroy']);
});
