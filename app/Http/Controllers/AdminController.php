<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        $books = \App\Models\Books::with('category')->get();
        $users = \App\Models\User::all();
        $categories = \App\Models\Category::all();
        $reservations = \App\Models\Reservation::with('user', 'book')->get();
        $fines = \App\Models\Fine::all();
        $totalBorrowed = \App\Models\BorrowedItem::count();
        $recentReservations = \App\Models\Reservation::with('user', 'book')->latest()->take(5)->get();
        $overdueBooks = \App\Models\BorrowedItem::with('book', 'user')
            ->where('due_date', '<', now())
            ->whereNull('return_date')
            ->take(5)
            ->get();
        return view('admin.dashboard', compact('books', 'users', 'categories', 'reservations', 'fines', 'totalBorrowed', 'recentReservations', 'overdueBooks'));
    }
}
