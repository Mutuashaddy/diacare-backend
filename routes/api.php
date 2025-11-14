<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BiodataController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bio-data', [AuthController::class, 'storeBioData']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/biodata', [BiodataController::class, 'store']);
    Route::get('/biodata', [BiodataController::class, 'show']);
    Route::put('/biodata', [BiodataController::class, 'update']);
    Route::delete('/biodata', [BiodataController::class, 'destroy']);
});
