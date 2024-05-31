<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('adminLogin', [AuthenticationController::class, 'adminLogin']);
Route::post('doctorLogin', [AuthenticationController::class, 'doctorLogin']);
Route::post('patientLogin', [AuthenticationController::class, 'patientLogin']);

Route::get('doctors', [DoctorController::class, 'doctors']);
Route::get('showDoctor/{id}', [DoctorController::class, 'showDoctor']);
Route::post('registerDoctors', [DoctorController::class, 'registerDoctors']);
Route::put('editDoctor/{id}', [DoctorController::class, 'editDoctor']);
Route::delete('deleteDoctor/{id}', [DoctorController::class, 'deleteDoctor']);

Route::get('patients', [PatientController::class, 'patients']);
Route::get('showPatient/{id}', [PatientController::class, 'showPatient']);
Route::post('registerPatients', [PatientController::class, 'registerPatients']);
Route::put('editPatient/{id}', [PatientController::class, 'editPatient']);
Route::delete('deletePatient/{id}', [PatientController::class, 'deletePatient']);