<?php

use App\Http\Controllers\Api\MalfunctionController;
use App\Http\Controllers\Api\ReportMalfuncationController;
use App\Http\Controllers\Api\PaymentmalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('malfunctions', [MalfunctionController::class, 'index']);
Route::get('malfunction/{id}', [MalfunctionController::class, 'show']);
Route::post('malfunction', [MalfunctionController::class, 'store']);

Route::get('reportsmalfunctions', [ReportMalfuncationController::class, 'index']);
Route::get('reportsmalfunction/{id}', [ReportMalfuncationController::class, 'show']);
Route::post('reportsmalfunction', [ReportMalfuncationController::class, 'store']);
Route::post('updatereportsmal/{id}', [ReportMalfuncationController::class, 'update']);

Route::get('paymentmalfunction/{id}', [PaymentmalController::class, 'show']);
Route::post('paymentmalfunction', [PaymentmalController::class, 'store']);
