<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Forgot password routes
Route::get('/forgot', [UserController::class, 'forgot'])->name('auth.forgot');
Route::post('/forgot', [UserController::class, 'forgotPassword'])->name('auth.forgot');

// Reset password route
Route::get('/reset/{email}/{token}', [UserController::class, 'reset'])->name('reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('auth.reset');

// Sending data to the server
Route::post('/register', [UserController::class, 'saveUser'])->name('auth.register');
Route::post('/login', [UserController::class, 'loginUser'])->name('auth.login');

// Register route    
Route::get('/register', [UserController::class, 'register']);

// Middleware
Route::group(['middleware' => ['LoginCheck']], function () {
    Route::get('/', [UserController::class, 'login']);
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    
    // Dashboard routes
    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::get('/table', [DashboardController::class, 'table'])->name('table');
    Route::get('/chart', [DashboardController::class, 'chart']);
    Route::get('/add', [DashboardController::class, 'add']);
    
    // Logout route
    Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');
});

// Save employee details
Route::post('/add', [DashboardController::class, 'saveEmployee'])->name('frontend.add');

// Corrected destroy route
Route::get('/employees/{id}', [DashboardController::class, 'destroy'])->name('employee.destroy');

// Edit employee details
Route::get('/employees/{id}/edit', [DashboardController::class, 'edit'])->name('edit');
Route::put('/employees/{id}', [DashboardController::class, 'updateEmployee'])->name('updateEmployee');

// Show employee details
Route::get('/employees/{id}/show', [DashboardController::class, 'show'])->name('showemployee');
