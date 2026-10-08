<?php

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Guest-only routes (login / registration)
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // After login every user lands here and is redirected to their role's dashboard.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // One dashboard per role. The 'role' middleware blocks any user whose
    // role doesn't match — including if they type the URL directly.
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->middleware('role:admin')->name('admin.dashboard');

    Route::get('/vendor/dashboard', [DashboardController::class, 'vendor'])
        ->middleware('role:vendor')->name('vendor.dashboard');

    Route::get('/customer/dashboard', [DashboardController::class, 'customer'])
        ->middleware('role:customer')->name('customer.dashboard');

    Route::get('/delivery/dashboard', [DashboardController::class, 'delivery'])
        ->middleware('role:delivery')->name('delivery.dashboard');

    // User Management Module — Administrator only.
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserManagementController::class)->except(['show']);
    });
});
