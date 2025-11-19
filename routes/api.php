<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PostController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/medications', [MedicationController::class, 'index']);
Route::post('/medications', [MedicationController::class, 'store']);
Route::get('/medications/{id}', [MedicationController::class, 'show']);
Route::put('/medications/{id}', [MedicationController::class, 'update']);
Route::delete('/medications/{id}', [MedicationController::class, 'destroy']);


// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bio-data', [AuthController::class, 'storeBioData']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/biodata', [BiodataController::class, 'store']);
    Route::get('/biodata', [BiodataController::class, 'show']);
    Route::put('/biodata', [BiodataController::class, 'update']);
    Route::delete('/biodata', [BiodataController::class, 'destroy']);
     Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});
