<?php

use App\Http\Controllers\V1\Api\{AuthController, CategoryController, TransactionController};
use Illuminate\Support\Facades\Route;

// Echo
Route::get('/', function () {
    return response(['success' => true, 'version' => '1.0']);
});

// public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('transactions/statistics', [TransactionController::class, 'statistics']);
    Route::get('categories/list', [CategoryController::class, 'listAuthUserCategory']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});
