<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExhibitorController;

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
});

Route::middleware(['auth', 'exhibitor'])->group(function () {
    Route::get('/exhibitor/dashboard', [ExhibitorController::class, 'dashboard']);
});

Route::middleware(['auth', 'exhibitor'])->group(function () {
    Route::get('/exhibitor/profile/create', function () {
        return view('exhibitor.create-profile');
    });

    Route::post('/exhibitor/profile/store', [ExhibitorController::class, 'store']);
});
