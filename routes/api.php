<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HutangController;
use App\Http\Controllers\API\TabunganController;
use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\LampiranTransaksiController;
use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\BudgetController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ActivityController;

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

    Route::get('/tabungan', [TabunganController::class, 'index']);
    Route::post('/tabungan', [TabunganController::class, 'store']);
    Route::get('/tabungan/{id}', [TabunganController::class, 'show']); 
    Route::put('/tabungan/{id}', [TabunganController::class, 'update']);
    Route::delete('/tabungan/{id}', [TabunganController::class, 'destroy']);

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);
    Route::get('/transaksi/tabungan/{tabungan_id}', [TransaksiController::class, 'getByTabungan']);

    Route::get('/lampiran', [LampiranTransaksiController::class, 'index']);
    Route::post('/lampiran', [LampiranTransaksiController::class, 'store']);
    Route::get('/lampiran/{id}', [LampiranTransaksiController::class, 'show']);
    Route::put('/lampiran/{id}', [LampiranTransaksiController::class, 'update']); 
    Route::delete('/lampiran/{id}', [LampiranTransaksiController::class, 'destroy']);
    Route::get('/lampiran/transaksi/{transaksi_id}', [LampiranTransaksiController::class, 'getByTransaksi']);

    Route::get('/budget', [BudgetController::class, 'index']);
    Route::post('/budget', [BudgetController::class, 'store']);
    Route::put('/budget/{id}', [BudgetController::class, 'update']);
    Route::delete('/budget/{id}', [BudgetController::class, 'destroy']);
    
    Route::get('/notification', [NotificationController::class, 'index']);
    Route::post('/notification', [NotificationController::class, 'store']);
    Route::get('/notification/{id}', [NotificationController::class, 'show']);
    Route::put('/notification/{id}', [NotificationController::class, 'update']);
    Route::delete('/notification/{id}', [NotificationController::class, 'destroy']);

    Route::get('/income', [IncomeController::class, 'index']);
    Route::post('/income', [IncomeController::class, 'store']);
    Route::put('/income/{id}', [IncomeController::class, 'update']);
    Route::delete('/income/{id}', [IncomeController::class, 'destroy']);

    Route::get('/activity', [ActivityController::class, 'index']);
    Route::post('/activity', [ActivityController::class, 'store']);
    Route::get('/activity/{id}', [ActivityController::class, 'show']);
    Route::put('/activity/{id}', [ActivityController::class, 'update']);
    Route::delete('/activity/{id}', [ActivityController::class, 'destroy']);

});