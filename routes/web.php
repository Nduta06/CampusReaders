<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FinesController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/catalogue', function () {
    return view('catalogue');
});



// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup']);

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::post('/profile/renew/{record}', [ProfileController::class, 'renew'])
        ->name('profile.renew');

    Route::post('/profile/cancel-reservation/{reservation}', [ProfileController::class, 'cancelReservation'])
        ->name('profile.cancelReservation');
    
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    
    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    // --- Payment Routes (Added) ---
    Route::post('/fines/{fine}/pay', [FinesController::class, 'pay'])
        ->name('fines.pay');

    Route::get('/fines/{fine}/success', [FinesController::class, 'paymentSuccess'])
        ->name('fines.success');
    // ------------------------------
    
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/catalogue', function () {
        return view('catalogue');
    })->name('catalogue');
    
});

// Admin protected routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
});