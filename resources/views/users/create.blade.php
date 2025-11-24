@extends('layouts.app')

@section('title', 'Add New User')

@section('content')

<style>
    .form-card {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-section {
        margin-bottom: 32px;
    }

    .form-section-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--beige-200);
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .form-label .required {
        color: var(--danger);
        margin-left: 2px;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--beige-200);
        border-radius: 8px;
        background: #ffffff;
        font-size: 15px;
        color: var(--text-dark);
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--beige-600);
        box-shadow: 0 0 0 4px rgba(139, 115, 85, 0.1);
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 24px;
        border-top: 1px solid var(--beige-200);
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--beige-600);
        color: #ffffff;
    }

    .btn-primary:hover {
        background: var(--beige-700);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(139, 115, 85, 0.2);
    }

    .btn-secondary {
        background: var(--beige-200);
        color: var(--text-dark);
    }

    .btn-secondary:hover {
        background: var(--beige-300);
    }

    .breadcrumb {
        margin-bottom: 24px;
        padding: 0;
        background: transparent;
    }

    .breadcrumb-item {
        font-size: 14px;
        color: var(--text-medium);
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
</style>

<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">Add New User</li>
        </ol>
    </nav>

    <div class="form-card">
        <div class="card">
            <div class="card-body" style="padding: 32px;">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-section">
                        <h4 class="form-section-title">User Information</h4>

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name <span class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email <span class="required">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="role_id" class="form-label">Role <span class="required">*</span></label>
                            <select class="form-select" id="role_id" name="role_id" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password <span class="required">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
