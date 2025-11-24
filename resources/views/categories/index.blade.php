@extends('layouts.app')

@section('title', 'Categories')

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

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
    }

    .btn-edit {
        background: var(--beige-200);
        color: var(--text-dark);
    }

    .btn-edit:hover {
        background: var(--beige-300);
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

    .btn-primary {
        background: var(--beige-600);
        color: #ffffff;
    }

    .btn-primary:hover {
        background: var(--beige-700);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 115, 85, 0.25);
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
        margin-bottom: 24px;
    }

    /* Footer Actions */
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

    /* Category Name */
    .category-name {
        font-weight: 600;
        color: var(--text-dark);
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

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .action-buttons .btn {
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
            <li class="breadcrumb-item active">Categories</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Categories Management</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Category
        </a>
    </div>

    <!-- Categories Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <span class="id-badge">#{{ $category->id }}</span>
                                </td>
                                <td>
                                    <span class="category-name">{{ $category->name }}</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-edit">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block; margin: 0;" onsubmit="return confirm('Are you sure you want to delete this category? This will only work if no books depend on it.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-folder"></i>
                                    </div>
                                    <div class="empty-state-title">No categories found</div>
                                    <div class="empty-state-text">Start by adding your first category</div>
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Add New Category
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($categories->isNotEmpty())
        <div class="card-footer">
            <span class="stats-text">
                Showing {{ $categories->count() }} {{ Str::plural('category', $categories->count()) }}
            </span>
        </div>
        @endif
    </div>
</div>

@endsection