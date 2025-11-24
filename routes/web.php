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

// --- 1. Public Routes ---
Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup']);

// --- 2. Protected Routes (Logged-in Users) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard / Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/renew/{record}', [ProfileController::class, 'renew'])->name('profile.renew');
    Route::post('/profile/cancel-reservation/{reservation}', [ProfileController::class, 'cancelReservation'])->name('profile.cancelReservation');

    // Fines & Payments
    Route::post('/fines/{fine}/pay', [FinesController::class, 'pay'])->name('fines.pay');
    Route::get('/fines/{fine}/success', [FinesController::class, 'paymentSuccess'])->name('fines.success');

    // Catalogue & Borrowing
    // This defines the route name 'catalogue' used in your redirects
    Route::get('/catalogue', function () {
        return view('catalogue');
    })->name('catalogue');

    // This defines the POST route for borrowing a book
    Route::post('/books/{book}/borrow', [BorrowedItemsController::class, 'borrow'])->name('books.borrow');
    
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});

// --- 3. Admin Routes ---
// Admin routes should generally be protected by 'auth' AND 'role:admin'
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin');
    })->name('admin');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Resource Routes
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