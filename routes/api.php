<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\AppointmentController;

// Estas líneas crean automáticamente todas las rutas (GET, POST, PUT, DELETE)
Route::apiResource('specialties', SpecialtyController::class);
Route::apiResource('doctors', DoctorController::class);
Route::apiResource('patients', PatientController::class);
Route::apiResource('appointments', AppointmentController::class);