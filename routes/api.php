<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HutangController;
use App\Http\Controllers\API\TabunganController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::get('/hutang', [HutangController::class, 'index']);
    Route::post('/hutang', [HutangController::class, 'store']);
    Route::get('/hutang/{id}', [HutangController::class, 'show']);
    Route::put('/hutang/{id}', [HutangController::class, 'update']);
    Route::delete('/hutang/{id}', [HutangController::class, 'destroy']);

});

Route::middleware('auth:api')->group(function () {
    Route::get('/tabungan', [TabunganController::class, 'index']);
    Route::post('/tabungan', [TabunganController::class, 'store']);
    Route::get('/tabungan/{id}', [TabunganController::class, 'show']); 
    Route::put('/tabungan/{id}', [TabunganController::class, 'update']);
    Route::delete('/tabungan/{id}', [TabunganController::class, 'destroy']);

});
