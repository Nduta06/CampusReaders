@extends('layout')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Hello, {{ Auth::user()->name }}!</h1>

    <!-- Profile Info -->
    <div class="bg-gray-800 p-6 rounded-lg shadow mb-8">
        <h2 class="text-xl font-semibold mb-4">Profile Info</h2>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Member Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
        <a href="{{ route('profile.edit') }}" class="text-cyan-400 hover:underline mt-2 inline-block">Edit Profile</a>
    </div>

    <!-- Current Borrows -->
    <div class="bg-gray-800 p-6 rounded-lg shadow mb-8">
        <h2 class="text-xl font-semibold mb-4">Current Borrowed Books</h2>
        @if($currentBorrows->count())
            <ul class="list-disc list-inside">
                @foreach($currentBorrows as $borrow)
                    <li>{{ $borrow->book->title }} — Due: {{ $borrow->due_date->format('M d, Y') }}</li>
                @endforeach
            </ul>
        @else
            <p>You have no borrowed books currently.</p>
        @endif
    </div>

    <!-- Reservations -->
    <div class="bg-gray-800 p-6 rounded-lg shadow mb-8">
        <h2 class="text-xl font-semibold mb-4">Your Reservations</h2>
        @if($reservations->count())
            <ul class="list-disc list-inside">
                @foreach($reservations as $reservation)
                    <li>{{ $reservation->book->title }} — Reserved on: {{ $reservation->created_at->format('M d, Y') }}
                        <form action="{{ route('profile.cancelReservation', $reservation->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2">Cancel</button>
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
            <ul class="list-disc list-inside">
                @foreach($fines as $fine)
                    <li>
    {{ $fine->description }} — ${{ number_format($fine->amount, 2) }} 
    @if($fine->status !== 'Paid')
        <form action="{{ route('fines.pay', $fine->id) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-green-400 hover:underline ml-2">Pay Now</button>
        </form>
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
