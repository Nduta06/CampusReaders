@extends('layouts.app')

@section('title', 'Waitlists')

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

    /* Action Buttons */
    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-danger {
        background: #ffebee;
        color: #c62828;
    }

    .btn-danger:hover {
        background: #ffcdd2;
        transform: translateY(-1px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 64px 32px;
        color: var(--text-medium);
        font-weight: 500;
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

        .btn {
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
            <li class="breadcrumb-item active">Waitlists</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Waitlist Management</h1>
    </div>

    <!-- Waitlists Table -->
    <div class="card">
        <div class="card-body table-container">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book</th>
                        <th>User</th>
                        <th>Joined At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($waitlists as $wait)
                        <tr>
                            <td><span class="id-badge">#{{ $wait->id }}</span></td>
                            <td>{{ $wait->book->title ?? 'N/A' }}</td>
                            <td>{{ $wait->user->name ?? 'N/A' }}</td>
                            <td>{{ $wait->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <form action="{{ route('waitlists.destroy', $wait) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this user from the waitlist?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                No waitlist entries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
