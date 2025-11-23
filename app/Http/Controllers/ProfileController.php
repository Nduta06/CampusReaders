<?php

namespace App\Http\Controllers;

use App\Models\BorrowedItem;
use App\Models\Fine;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Auto-expire reservations past their expiration date
        Reservation::where('status', 'active')
            ->where('expires_at', '<', now())
            ->update(['status' => 'completed']);

        // Current borrowed books
        $currentBorrows = BorrowedItem::where('user_id', $user->id)
            ->whereNull('return_date')
            ->with('book')
            ->get();

        // Borrowing history
        $history = BorrowedItem::where('user_id', $user->id)
            ->whereNotNull('return_date')
            ->with('book')
            ->orderBy('return_date', 'desc')
            ->get();

        // Active reservations
        $reservations = Reservation::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('book')
            ->get();

        // Unpaid fines
        $fines = Fine::where('user_id', $user->id)
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

    // Extend borrowed book due date
    public function renew(BorrowedItem $record)
    {
        $record->update([
            'due_date' => now()->addDays(7)
        ]);

        return back()->with('success', 'Book renewed for 7 more days!');
    }

    // Cancel a reservation
    public function cancelReservation(Reservation $reservation)
    {
        if ($reservation->status !== 'active') {
            return back()->with('error', 'Reservation cannot be cancelled.');
        }

        $reservation->update([
            'status' => 'cancelled',
            'cancelled_at' => now() // optional timestamp
        ]);

        return back()->with('success', 'Reservation cancelled!');
    }

    // Mark fine as paid
    public function payFine(Fine $fine)
    {
        if ($fine->status !== 'unpaid') {
            return back()->with('error', 'Fine is already paid.');
        }

        $fine->update([
            'status' => 'paid',
            'amount_paid' => $fine->amount_due,
            'paid_at' => now() // optional timestamp
        ]);

        return back()->with('success', 'Fine paid successfully!');
    }

    // Profile edit view
    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    // Update profile info
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        return redirect()->route('profile')->with('success', 'Profile updated!');
    }
}
