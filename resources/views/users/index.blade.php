@extends('layouts.app')

@section('title', 'Users')

@section('content')
<style>
.btn-add-user {
    border-radius: 50px;
    font-weight: 600;
    padding: 0.65rem 1.5rem;
    font-size: 1rem;
    color: #1a237e;
    background: linear-gradient(90deg, #f5e9d7 0%, #ffe0b2 100%);
    border: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-add-user i { font-size: 1.3rem; }
.btn-add-user:hover {
    background: linear-gradient(90deg, #ffe0b2 0%, #f5e9d7 100%);
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    color: #1a237e;
    text-decoration: none;
}
.card-custom { background: #f5f5dc; color: #111; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.05); }
.table thead th { color: #1a237e; }
.table tbody td { color: #111; }
.table-responsive { padding: 1rem; }
.mt-3 { margin-top: 1rem !important; }
</style>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Users</h3>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No users found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3 text-end">
                        <a href="{{ route('users.create') }}" class="btn btn-add-user shadow-sm">
                            <i class="bi bi-plus-circle"></i> Add New User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
