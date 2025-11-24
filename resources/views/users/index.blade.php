@extends('layouts.app')

@section('title', 'Users')

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
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        background: #ffffff;
    }

    .card-body {
        padding: 0;
    }

    .table-container {
        overflow-x: auto;
        padding: 1rem;
    }

    /* Table Styling */
    .table {
        width: 100%;
        margin-bottom: 0;
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

    .table thead th:first-child { border-top-left-radius: 12px; }
    .table thead th:last-child { border-top-right-radius: 12px; }

    .table tbody td {
        padding: 16px 20px;
        color: var(--text-dark);
        font-size: 15px;
        border-bottom: 1px solid var(--beige-100);
        vertical-align: middle;
    }

    .table tbody tr:last-child td { border-bottom: none; }

    .table tbody tr:hover { background: var(--beige-50); transition: background 0.2s ease; }

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

    .btn-sm { padding: 6px 12px; font-size: 13px; }

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

    .btn-view {
        background: #dbeafe;
        color: #1e40af;
    }

    .btn-view:hover {
        background: #bfdbfe;
        transform: translateY(-1px);
    }

    .btn-add {
        background: var(--beige-600);
        color: #ffffff;
        border-radius: 50px;
        font-weight: 600;
        padding: 0.65rem 1.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: var(--beige-700);
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        color: #fff;
        text-decoration: none;
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
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Users Management</h1>
        <a href="{{ route('users.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Add New User
        </a>
    </div>

    <!-- Users Table -->
    <div class="card">
        <div class="card-body table-container">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? '—' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-view" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-edit" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete" title="Delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="empty-state-title">No users found</div>
                            <div class="empty-state-text">Start by adding a new user to the system</div>
                            <a href="{{ route('users.create') }}" class="btn btn-add">
                                <i class="bi bi-plus-circle"></i> Add New User
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
