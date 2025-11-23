@extends('layouts.app')

@section('title', 'Reservations')

@section('content')
<style>
.btn-update-status {
    border-radius: 50px;
    font-weight: 600;
    padding: 0.4rem 1.1rem;
    font-size: 0.95rem;
    color: #fff;
    background: #1a237e;
    border: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-update-status:hover {
    background: #3949ab;
    color: #fff;
    text-decoration: none;
}
.card-custom {
    background: #f5f5dc;
    color: #111;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}
.table thead th { color: #1a237e; }
.table tbody td { color: #111; }
.table-responsive { padding: 1rem; }
.mt-3 { margin-top: 1rem !important; }
</style>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Reservations</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Book</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Reserved At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->book->title ?? 'N/A' }}</td>
                                <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($reservation->status) }}</span>
                                </td>
                                <td>{{ $reservation->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <!-- Status update dropdown -->
                                    <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm d-inline w-auto" style="display:inline-block;">
                                            <option value="approved" @if($reservation->status=='approved') selected @endif>Approve</option>
                                            <option value="cancelled" @if($reservation->status=='cancelled') selected @endif>Cancel</option>
                                            <option value="fulfilled" @if($reservation->status=='fulfilled') selected @endif>Fulfill</option>
                                        </select>
                                        <button type="submit" class="btn btn-update-status btn-sm ms-1">Update</button>
                                    </form>
                                    <!-- Cancel reservation -->
                                    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No reservations found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
