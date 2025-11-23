<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;

Route::get('/', function () {
    return view('welcome');
});


// Admin dashboard route (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/bookcatalogue', function () {
    return view('bookcatalogue');
})->name('bookcatalogue');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup']);

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
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
        // Pass books to the admin view
        $books = \App\Models\books::all();
        return view('admin', compact('books'));
    })->name('admin');

    // Books CRUD resource routes
    Route::resource('books', App\Http\Controllers\BooksController::class);
});