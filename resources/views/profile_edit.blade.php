@extends('layouts.app')

@section('title', 'Edit Profile')

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
        margin-bottom: 24px;
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

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--beige-200);
        border-radius: 8px;
        background: #ffffff;
        font-size: 15px;
        color: var(--text-dark);
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--beige-600);
        box-shadow: 0 0 0 4px rgba(139, 115, 85, 0.1);
    }

    .form-control::placeholder {
        color: var(--text-light);
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

    .help-text {
        color: var(--text-light);
        font-size: 13px;
        display: block;
        margin-top: 6px;
    }

    .info-badge {
        display: inline-block;
        padding: 4px 12px;
        background: var(--beige-100);
        border-radius: 6px;
        font-size: 13px;
        color: var(--text-medium);
        margin-left: 8px;
        font-weight: 500;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        background: #ffffff;
    }

    .card-body {
        padding: 32px;
    }
</style>

<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
    </nav>

    <div class="form-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <!-- Profile Information Section -->
                    <div class="form-section">
                        <h4 class="form-section-title">Profile Information</h4>

                        <div class="form-group">
                            <label for="name" class="form-label">
                                Name <span class="required">*</span>
                                <span class="info-badge">ID: #{{ $user->id }}</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $user->name) }}"
                                placeholder="Your full name"
                                required
                                autofocus
                            >
                            <small class="help-text">
                                Enter your full name as you want it displayed
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email <span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}"
                                placeholder="you@example.com"
                                required
                            >
                            <small class="help-text">
                                Make sure this email is active and correct
                            </small>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
