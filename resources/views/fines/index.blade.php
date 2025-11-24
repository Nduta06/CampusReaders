@extends('layouts.app')

@section('title', 'Fines')

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

.status-paid {
    background: #e8f5e9;
    color: #2e7d32;
}

.status-unpaid {
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
.btn-update-status, .btn-pay-stripe {
    border-radius: 50px;
    font-weight: 600;
    padding: 0.4rem 1.1rem;
    font-size: 0.95rem;
    color: #fff;
    border: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-update-status {
    background: #1a237e;
}

.btn-update-status:hover {
    background: #3949ab;
}

.btn-pay-stripe {
    background: #f57c00;
}

.btn-pay-stripe:hover {
    background: #fb8c00;
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

    .btn-update-status,
    .btn-pay-stripe {
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
            <li class="breadcrumb-item active">Fines</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Fines Management</h1>
    </div>

    <!-- Fines Table -->
    <div class="card">
        <div class="card-body table-container">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Book</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Issued At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fines as $fine)
                        <tr>
                            <td><span class="id-badge">#{{ $fine->id }}</span></td>
                            <td>{{ $fine->user->name ?? 'N/A' }}</td>
                            <td>{{ $fine->book->title ?? 'N/A' }}</td>
                            <td>{{ number_format($fine->amount, 2) }}</td>
                            <td>
                                @php $statusClass = strtolower($fine->status) === 'paid' ? 'status-paid' : 'status-unpaid' @endphp
                                <span class="status-badge {{ $statusClass }}">{{ ucfirst($fine->status) }}</span>
                            </td>
                            <td>{{ $fine->created_at->format('M d, Y H:i') }}</td>
                            <td class="d-flex flex-wrap gap-2">
                                @if(strtolower($fine->status) !== 'paid')
                                    <!-- Stripe Pay Button -->
                                    <form action="{{ route('fines.pay', $fine) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-pay-stripe btn-sm">Pay with Stripe</button>
                                    </form>

                                    <!-- Mark Paid (Admin) -->
                                    <form action="{{ route('fines.update', $fine) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="mark_paid" value="1">
                                        <button type="submit" class="btn btn-update-status btn-sm">Mark Paid</button>
                                    </form>
                                @endif

                                <!-- Delete Fine -->
                                <form action="{{ route('fines.destroy', $fine) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this fine?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">No fines found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
