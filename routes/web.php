<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\BorrowedItemsController;
use App\Http\Controllers\FinesController;
use App\Http\Controllers\WaitlistsController;
use App\Http\Controllers\MessagingLogsController;
use App\Http\Controllers\RolesController;

// Public Homepage
Route::get('/', function () {
    return view('welcome');
});

// Public book catalogue (viewable by guests)
Route::get('/bookcatalogue', function () {
    return view('bookcatalogue');
})->name('bookcatalogue');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup']);

// Protected Routes (must be logged in)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', fn () => view('profile'))->name('profile');
    Route::get('/settings', fn () => view('settings'))->name('settings');
});

// Admin routes (no auth middleware for testing)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('users', UserController::class);
    Route::resource('books', BooksController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('reservations', ReservationsController::class);
    Route::resource('borrowed-items', BorrowedItemsController::class);
    Route::resource('fines', FinesController::class);
    Route::resource('waitlists', WaitlistsController::class);
    Route::resource('messaging-logs', MessagingLogsController::class);
    Route::resource('roles', RolesController::class);
});
