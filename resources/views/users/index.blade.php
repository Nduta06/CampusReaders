@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold mb-0">Users</h3>
            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Add User</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive" style="background: #fff; color: #212529;">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="color: #1a237e;">ID</th>
                                <th style="color: #1a237e;">Name</th>
                                <th style="color: #1a237e;">Email</th>
                                <th style="color: #1a237e;">Role</th>
                                <th style="color: #1a237e;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td style="color: #212529;">{{ $user->id }}</td>
                                <td style="color: #212529;">{{ $user->name }}</td>
                                <td style="color: #212529;">{{ $user->email }}</td>
                                <td style="color: #212529;">{{ $user->role->name ?? '—' }}</td>
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
                                <td colspan="5" class="text-center">No users found.</td>
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
