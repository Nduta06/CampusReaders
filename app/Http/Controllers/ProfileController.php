<?php

namespace App\Http\Controllers;

use App\Models\BorrowRecord;
use App\Models\BookReservation;
use App\Models\borrowed_items;
use App\Models\Fine;
use App\Models\fines;
use App\Models\reservations;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $currentBorrows = borrowed_items::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->with('book')
            ->get();

        $history = borrowed_items::where('user_id', $user->id)
            ->whereNotNull('returned_at')
            ->with('book')
            ->orderBy('returned_at', 'desc')
            ->get();

        $reservations = reservations::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('book')
            ->get();

        $fines = fines::where('user_id', $user->id)
            ->where('status', 'unpaid')
            ->get();

        return view('profile', compact(
            'user',
            'currentBorrows',
            'history',
            'reservations',
            'fines'
        ));
    }

    public function renew(borrowed_items $record)
    {
        // Extend due date
        $record->update([
            'due_date' => now()->addDays(7)
        ]);

        return back()->with('success', 'Book renewed for 7 more days!');
    }

    public function cancelReservation(reservations $reservation)
    {
        $reservation->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Reservation cancelled!');
    }
}
