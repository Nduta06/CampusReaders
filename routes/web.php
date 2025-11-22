<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/bookcatalogue', function () {
    return view('bookcatalogue');
})->name('bookcatalogue');


Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/profile/edit', [ProfileController::class, 'edit'])
    ->name('profile.edit');
    
Route::post('/profile/update', [ProfileController::class, 'update'])
    ->name('profile.update');


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
    
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
    
    Route::get('/bookcatalogue', function () {
        return view('bookcatalogue');
    })->name('bookcatalogue');
});

// Admin protected routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
});