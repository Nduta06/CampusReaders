@extends('layout')
@section('title', 'My Profile')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">Hello, {{ Auth::user()->name }}!</h1>
        <p class="page-subtitle">Manage your borrowed books, reservations, and account details</p>
    </div>

    <!-- Profile Information Card -->
    <div class="card mb-3">
        <div class="card-header">
            <h2>Profile Information</h2>
            <a href="{{ route('profile.edit') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px;">
                <div>
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-light); margin-bottom: 4px; display: block;">Email Address</label>
                    <p style="font-size: 15px; color: var(--text-dark); margin: 0;">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-light); margin-bottom: 4px; display: block;">Member Since</label>
                    <p style="font-size: 15px; color: var(--text-dark); margin: 0;">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Borrowed Books -->
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h2>Currently Borrowed Books</h2>
                <span class="badge badge-info">{{ $currentBorrows->count() }} Active</span>
            </div>
            <div class="card-body">
                @if($currentBorrows->count())
                    <div class="list-group">
                        @foreach($currentBorrows as $borrow)
                            <div class="list-item">
                                <div class="list-item-content">
                                    <div class="list-item-title">
                                        <i class="fas fa-book" style="color: var(--beige-600); margin-right: 8px;"></i>
                                        {{ $borrow->book->title }}
                                    </div>
                                    <div class="list-item-meta">
                                        Due: {{ $borrow->due_date->format('M d, Y') }}
                                        @if($borrow->due_date->isPast())
                                            <span class="badge badge-danger" style="margin-left: 8px;">Overdue</span>
                                        @elseif($borrow->due_date->diffInDays(now()) <= 3)
                                            <span class="badge badge-warning" style="margin-left: 8px;">Due Soon</span>
                                        @endif
                                    </div>
                                </div>
                                <form action="{{ route('profile.renew', $borrow->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-redo"></i> Renew (+7 days)
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 48px 20px; color: var(--text-light);">
                        <i class="fas fa-books" style="font-size: 48px; opacity: 0.3; display: block; margin-bottom: 12px;"></i>
                        <p style="margin: 0;">You have no borrowed books currently.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Active Reservations -->
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h2>Your Reservations</h2>
                <span class="badge badge-info">{{ $reservations->count() }} Active</span>
            </div>
            <div class="card-body">
                @if($reservations->count())
                    <div class="list-group">
                        @foreach($reservations as $reservation)
                            <div class="list-item">
                                <div class="list-item-content">
                                    <div class="list-item-title">
                                        <i class="fas fa-bookmark" style="color: var(--beige-600); margin-right: 8px;"></i>
                                        {{ $reservation->book->title }}
                                    </div>
                                    <div class="list-item-meta">
                                        Reserved on: {{ $reservation->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                                <form action="{{ route('profile.cancelReservation', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 48px 20px; color: var(--text-light);">
                        <i class="fas fa-bookmark" style="font-size: 48px; opacity: 0.3; display: block; margin-bottom: 12px;"></i>
                        <p style="margin: 0;">You have no active reservations.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Fines -->
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h2>Fines & Payments</h2>
                @if($fines->where('status', 'Pending')->count() > 0)
                    <span class="badge badge-warning">
                        {{ $fines->where('status', 'Pending')->count() }} Pending
                    </span>
                @else
                    <span class="badge badge-success">All Clear</span>
                @endif
            </div>
            <div class="card-body">
                @if($fines->count())
                    <div class="list-group">
                        @foreach($fines as $fine)
                            <div class="list-item">
                                <div class="list-item-content">
                                    <div class="list-item-title">
                                        <i class="fas fa-dollar-sign" style="color: var(--beige-600); margin-right: 8px;"></i>
                                        ${{ number_format($fine->amount_due, 2) }} Fine
                                    </div>
                                    <div class="list-item-meta">
                                        Incurred: {{ $fine->incurred_on->format('M d, Y') }}
                                        @if($fine->status === 'Pending')
                                            <span class="badge badge-warning" style="margin-left: 8px;">{{ $fine->status }}</span>
                                        @else
                                            <span class="badge badge-success" style="margin-left: 8px;">{{ $fine->status }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if($fine->status === 'Pending')
                                    <form action="{{ route('fines.pay', $fine->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-credit-card"></i> Pay Now
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 48px 20px; color: var(--text-light);">
                        <i class="fas fa-check-circle" style="font-size: 48px; opacity: 0.3; display: block; margin-bottom: 12px; color: var(--success);"></i>
                        <p style="margin: 0;">You have no fines. Keep up the good work!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection