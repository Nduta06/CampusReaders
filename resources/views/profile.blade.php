@extends('layout')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto py-8 space-y-8">
    <h1 class="text-3xl font-bold mb-6">Hello, {{ Auth::user()->name }}!</h1>

    <!-- Profile Info -->
    <div class="bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Profile Info</h2>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Member Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
        <a href="{{ route('profile.edit') }}" class="text-cyan-400 hover:underline mt-2 inline-block">Edit Profile</a>
    </div>

    <!-- Current Borrows -->
    <div class="bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Current Borrowed Books</h2>
        @if($currentBorrows->count())
            <ul class="divide-y divide-gray-700">
                @foreach($currentBorrows as $borrow)
                    <li class="py-2 flex justify-between items-center">
                        <span>{{ $borrow->book->title }} — Due: {{ $borrow->due_date->format('M d, Y') }}</span>
                        <form action="{{ route('profile.renew', $borrow->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-cyan-500 text-white rounded hover:bg-cyan-600 transition">Renew +7 days</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You have no borrowed books currently.</p>
        @endif
    </div>

    <!-- Reservations -->
    <div class="bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Your Reservations</h2>
        @if($reservations->count())
            <ul class="divide-y divide-gray-700">
                @foreach($reservations as $reservation)
                    <li class="py-2 flex justify-between items-center">
                        <span>{{ $reservation->book->title }} — Reserved on: {{ $reservation->created_at->format('M d, Y') }}</span>
                        <form action="{{ route('profile.cancelReservation', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Cancel</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You have no active reservations.</p>
        @endif
    </div>

    <!-- Fines -->
    <div class="bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Fines</h2>
        @if($fines->count())
            <ul class="divide-y divide-gray-700">
                @foreach($fines as $fine)
                    <li class="py-2 flex justify-between items-center">
                        <span>${{ number_format($fine->amount_due, 2) }} — Incurred: {{ $fine->incurred_on->format('M d, Y') }}</span>
                        @if($fine->status === 'Pending')
                            <form action="{{ route('fines.pay', $fine->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition">Pay Now</button>
                            </form>
                        @else
                            <span class="px-2 py-1 bg-gray-600 text-gray-200 rounded">Paid</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p>You have no fines pending.</p>
        @endif
    </div>
</div>
@endsection
