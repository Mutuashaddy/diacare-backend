<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\BloodPressureController;
use App\Http\Controllers\BloodSugarController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmergencyContactController;

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

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    Route::get('/medications', [MedicationController::class, 'index']);
    Route::post('/medications', [MedicationController::class, 'store']);
    Route::get('/medications/{id}', [MedicationController::class, 'show']);
    Route::put('/medications/{id}', [MedicationController::class, 'update']);
    Route::delete('/medications/{id}', [MedicationController::class, 'destroy']);

    Route::post('/blood-sugar', [BloodSugarController::class, 'store']);
    Route::get('/blood-sugar', [BloodSugarController::class, 'index']);
    Route::get('/blood-sugar/{id}', [BloodSugarController::class, 'show']);
    Route::put('/blood-sugar/{id}', [BloodSugarController::class, 'update']);
    Route::delete('/blood-sugar/{id}', [BloodSugarController::class, ' destroy']);

    Route::post('/blood-pressure', [BloodPressureController::class, 'store']);
    Route::get('/blood-pressure', [BloodPressureController::class, 'index']);
    Route::get('/blood-pressure/{id}', [BloodPressureController::class, 'show']);
    Route::put('/blood-pressure/{id}', [BloodPressureController::class, 'update']);
    Route::delete('/blood-pressure/{id}', [BloodSugarController::class, 'destroy']);



    Route::post('/posts/{post_id}/reply', [ReplyController::class, 'store']);
    Route::get('/posts/{post_id}/replies', [ReplyController::class, 'index']);
    ///profile reminder and replise

     Route::post('/emergency', [EmergencyContactController::class, 'store']);
    Route::get('/emergency', [EmergencyContactController::class, 'show']);

  Route::post('/reminders', [ReminderController::class, 'store']);
Route::get('/reminders', [ReminderController::class, 'index']);
Route::delete('/reminders/{id}', [ReminderController::class, 'destroy']);





}); 

