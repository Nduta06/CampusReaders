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
use App\Http\Controllers\ProfileController;

// Public Homepage
Route::get('/', function () {
    return view('welcome');
});

// Public book catalogue (viewable by guests)
Route::get('/bookcatalogue', function () {
    return view('bookcatalogue');
})->name('bookcatalogue');

// Admin landing page
Route::get('/admin', function () {
    return view('admin');
})->name('admin');

// Public catalogue (alternative route)
Route::get('/catalogue', function () {
    return view('catalogue');
})->name('catalogue');

// Profile edit/update
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

// Protected Routes (must be logged in)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::post('/profile/renew/{record}', [ProfileController::class, 'renew'])
        ->name('profile.renew');

    Route::post('/profile/cancel-reservation/{reservation}', [ProfileController::class, 'cancelReservation'])
        ->name('profile.cancelReservation');

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
