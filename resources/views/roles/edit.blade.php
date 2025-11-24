@extends('layouts.app')

@section('title', 'Edit Role')

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
    .form-textarea {
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
    .form-textarea:focus {
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
</style>

<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Edit: {{ $role->name }}</li>
        </ol>
    </nav>

    <div class="form-card">
        <div class="card">
            <div class="card-body" style="padding: 32px;">
                <form method="POST" action="{{ route('roles.update', $role) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-section">
                        <h4 class="form-section-title">Role Details</h4>

                        <div class="form-group">
                            <label for="name" class="form-label">
                                Role Name <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $role->name) }}"
                                required
                            >
                        </div>

                        <div class="form-group mt-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea 
                                class="form-control form-textarea" 
                                id="description" 
                                name="description" 
                                rows="3"
                            >{{ old('description', $role->description) }}</textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Update Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
