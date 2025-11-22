<?php

namespace App\Http\Controllers;

use App\Models\borrowed_items;
use App\Models\fines;
use App\Models\reservations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user')); // create profile_edit.blade.php
    }
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
