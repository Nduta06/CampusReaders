@extends('layouts.app')

@section('title', 'Borrowed Items')

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
        padding: 0;
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

    .status-returned {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status-borrowed {
        background: #fff3e0;
        color: #e65100;
    }

    .status-overdue {
        background: #ffebee;
        color: #c62828;
    }

    /* Action Buttons */
    .action-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: flex-start;
    }

    .action-row {
        display: flex;
        gap: 8px;
        align-items: center;
        width: 100%;
    }

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

    .btn-primary {
        background: var(--beige-600);
        color: #ffffff;
    }

    .btn-primary:hover {
        background: var(--beige-700);
        transform: translateY(-1px);
    }

    .btn-success {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .btn-success:hover {
        background: #c8e6c9;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #ffebee;
        color: #c62828;
    }

    .btn-delete:hover {
        background: #ffcdd2;
        transform: translateY(-1px);
    }

    /* Date Input */
    .date-input {
        padding: 6px 10px;
        border: 2px solid var(--beige-200);
        border-radius: 6px;
        font-size: 13px;
        color: var(--text-dark);
        background: #ffffff;
        transition: all 0.2s ease;
        width: 150px;
    }

    .date-input:focus {
        outline: none;
        border-color: var(--beige-600);
        box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.1);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 64px 32px;
    }

    .empty-state-icon {
        font-size: 64px;
        color: var(--beige-300);
        margin-bottom: 16px;
    }

    .empty-state-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .empty-state-text {
        font-size: 15px;
        color: var(--text-light);
    }

    /* Footer */
    .card-footer {
        padding: 20px 24px;
        background: var(--beige-50);
        border-top: 1px solid var(--beige-200);
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .stats-text {
        font-size: 14px;
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

    /* Book Title Strong */
    .book-title {
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Date Text */
    .date-text {
        font-size: 14px;
        color: var(--text-medium);
    }

    .overdue-text {
        color: #c62828;
        font-weight: 600;
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

        .action-group {
            width: 100%;
        }

        .action-row {
            flex-direction: column;
            align-items: stretch;
        }

        .date-input {
            width: 100%;
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
            <li class="breadcrumb-item active">Borrowed Items</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Borrowed Items Management</h1>
    </div>

    <!-- Borrowed Items Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book</th>
                            <th>User</th>
                            <th>Borrowed At</th>
                            <th>Due Date</th>
                            <th>Returned At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowedItems as $item)
                            @php
                                $isOverdue = !$item->returned_at && $item->due_date && $item->due_date->isPast();
                            @endphp
                            <tr>
                                <td>
                                    <span class="id-badge">#{{ $item->id }}</span>
                                </td>
                                <td>
                                    <span class="book-title">{{ $item->book->title ?? 'N/A' }}</span>
                                </td>
                                <td>{{ $item->user->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="date-text">
                                        {{ $item->borrowed_at ? $item->borrowed_at->format('M d, Y H:i') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="date-text {{ $isOverdue ? 'overdue-text' : '' }}">
                                        {{ $item->due_date ? $item->due_date->format('M d, Y') : '-' }}
                                        @if($isOverdue)
                                            <i class="bi bi-exclamation-triangle"></i>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span class="date-text">
                                        {{ $item->returned_at ? $item->returned_at->format('M d, Y H:i') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->returned_at)
                                        <span class="status-badge status-returned">
                                            <i class="bi bi-check-circle"></i>
                                            Returned
                                        </span>
                                    @elseif($isOverdue)
                                        <span class="status-badge status-overdue">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Overdue
                                        </span>
                                    @else
                                        <span class="status-badge status-borrowed">
                                            <i class="bi bi-clock"></i>
                                            Borrowed
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-group">
                                        @if(!$item->returned_at)
                                        <!-- Mark as Returned -->
                                        <div class="action-row">
                                            <form action="{{ route('borrowed-items.update', $item) }}" method="POST" style="margin: 0; flex: 1;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="mark_returned" value="1">
                                                <button type="submit" class="btn btn-sm btn-success" style="width: 100%;">
                                                    <i class="bi bi-check-circle"></i> Mark Returned
                                                </button>
                                            </form>
                                        </div>
                                        @endif

                                        <!-- Update Due Date -->
                                        <div class="action-row">
                                            <form action="{{ route('borrowed-items.update', $item) }}" method="POST" style="margin: 0; display: flex; gap: 8px; flex: 1;">
                                                @csrf
                                                @method('PUT')
                                                <input 
                                                    type="date" 
                                                    name="due_date" 
                                                    value="{{ $item->due_date ? $item->due_date->format('Y-m-d') : '' }}" 
                                                    class="date-input"
                                                    required
                                                >
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-calendar-check"></i> Update Due
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Delete -->
                                        <div class="action-row">
                                            <form action="{{ route('borrowed-items.destroy', $item) }}" method="POST" style="margin: 0; flex: 1;" onsubmit="return confirm('Are you sure you want to delete this borrowed item? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-delete" style="width: 100%;">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <div class="empty-state-title">No borrowed items found</div>
                                    <div class="empty-state-text">There are currently no borrowed items in the system</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($borrowedItems->isNotEmpty())
        <div class="card-footer">
            <span class="stats-text">
                Showing {{ $borrowedItems->count() }} {{ Str::plural('item', $borrowedItems->count()) }}
            </span>
            <span class="stats-text">
                Active Loans: {{ $borrowedItems->whereNull('returned_at')->count() }} | 
                Returned: {{ $borrowedItems->whereNotNull('returned_at')->count() }}
            </span>
        </div>
        @endif
    </div>
</div>

@endsection