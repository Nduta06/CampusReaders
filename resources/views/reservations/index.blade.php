@extends('layouts.app')

@section('title', 'Reservations')

@section('content')

<style>
    /* Page Header */
    .page-header {
        margin-bottom: 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    /* Breadcrumb */
    .breadcrumb {
        margin-bottom: 24px;
        padding: 0;
        background: transparent;
        list-style: none;
        display: flex;
        flex-wrap: wrap;
    }

    .breadcrumb-item {
        font-size: 14px;
        color: var(--text-medium);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: '/';
        padding: 0 8px;
        color: var(--text-light);
    }

    .breadcrumb-item a {
        color: var(--beige-600);
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: var(--text-dark);
    }

    /* Card Styling */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        background: #ffffff;
    }

    .card-body {
        padding: 32px;
    }

    /* Table Container */
    .table-container {
        overflow-x: auto;
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
        width: 100%;
    }

    .table thead th {
        background: var(--beige-100);
        color: var(--text-dark);
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        border: none;
        border-bottom: 2px solid var(--beige-200);
    }

    .table thead th:first-child {
        border-top-left-radius: 12px;
    }

    .table thead th:last-child {
        border-top-right-radius: 12px;
    }

    .table tbody td {
        padding: 16px 20px;
        color: var(--text-dark);
        font-size: 15px;
        border-bottom: 1px solid var(--beige-100);
        vertical-align: middle;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table tbody tr:hover {
        background: var(--beige-50);
        transition: background 0.2s ease;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-approved {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status-cancelled {
        background: #ffebee;
        color: #c62828;
    }

    .status-fulfilled {
        background: #fff3e0;
        color: #e65100;
    }

    /* ID Badge */
    .id-badge {
        display: inline-block;
        padding: 4px 10px;
        background: var(--beige-100);
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-medium);
    }

    /* Buttons */
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

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 64px 32px;
        color: var(--text-medium);
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .table thead th,
        .table tbody td {
            padding: 12px 16px;
            font-size: 14px;
        }

        .btn-update-status {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Reservations</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Reservations Management</h1>
    </div>

    <!-- Reservations Table -->
    <div class="card">
        <div class="card-body table-container">
            <table class="table table-hover align-middle mb-0">
                <thead>
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
                            <td><span class="id-badge">#{{ $reservation->id }}</span></td>
                            <td>{{ $reservation->book->title ?? 'N/A' }}</td>
                            <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                            <td>
                                @php $statusClass = 'status-' . strtolower($reservation->status) @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td>{{ $reservation->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <!-- Status update dropdown -->
                                <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="d-inline mb-1">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm d-inline w-auto">
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
                            <td colspan="6" class="empty-state">No reservations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
