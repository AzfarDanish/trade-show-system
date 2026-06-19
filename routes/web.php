<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\BoothController;
use App\Http\Controllers\ExhibitorController;
use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/booths/create', [BoothController::class, 'create']);
    Route::post('/admin/booths/store', [BoothController::class, 'store']);

    Route::get('/admin/exhibitors', [AdminController::class, 'exhibitors']);

    Route::get('/admin/leads', [AdminController::class, 'leads']);

    Route::get('/admin/appointments', [AdminController::class, 'appointments']);

    Route::get('/admin/booths', [AdminController::class, 'booths']);
});

Route::middleware(['auth', 'exhibitor'])->group(function () {
    Route::get('/exhibitor/dashboard', [ExhibitorController::class, 'dashboard']);

    Route::get('/exhibitor/profile/edit', [ExhibitorController::class, 'edit']);
    Route::put('/exhibitor/profile/update', [ExhibitorController::class, 'update']);

    Route::get('/exhibitor/booth', [BoothController::class, 'show']);

    Route::get('/exhibitor/leads', [LeadController::class, 'index']);
    Route::get('/exhibitor/leads/create', [LeadController::class, 'create']);
    Route::post('/exhibitor/leads/store', [LeadController::class, 'store']);

    Route::get('/exhibitor/appointments', [AppointmentController::class, 'index']);
    Route::get('/exhibitor/appointments/create', [AppointmentController::class, 'create']);
    Route::post('/exhibitor/appointments/store', [AppointmentController::class, 'store']);

    Route::get('/exhibitor/appointments/edit/{id}', [AppointmentController::class, 'edit']);
    Route::put('/exhibitor/appointments/update/{id}', [AppointmentController::class, 'update']);
    Route::delete('/exhibitor/appointments/delete/{id}', [AppointmentController::class, 'destroy']);

    Route::get('/exhibitor/leads/edit/{id}', [LeadController::class, 'edit']);
    Route::put('/exhibitor/leads/update/{id}', [LeadController::class, 'update']);
    Route::delete('/exhibitor/leads/delete/{id}', [LeadController::class, 'destroy']);
    Route::get('/exhibitor/leads/search', [LeadController::class, 'search']);

    Route::get('/exhibitor/profile/create', function () {
        return view('exhibitor.create-profile');
    });

    Route::post('/exhibitor/profile/store', [ExhibitorController::class, 'store']);
});
