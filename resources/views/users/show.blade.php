@extends('layouts.app')

@section('title', 'User Details')

@section('content')

<style>
    .details-container {
        max-width: 900px;
        margin: 0 auto;
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

    .user-header {
        background: linear-gradient(135deg, var(--beige-600) 0%, var(--beige-700) 100%);
        color: #ffffff;
        padding: 32px;
        border-radius: 12px 12px 0 0;
        margin-bottom: 0;
    }

    .user-title {
        font-size: 28px;
        font-weight: 700;
    }

    .details-card {
        background: #ffffff;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 2px 8px rgba(90, 74, 58, 0.06);
        border: 1px solid rgba(228, 223, 213, 0.5);
        border-top: none;
        overflow: hidden;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 0;
    }

    .detail-item {
        padding: 24px;
        border-bottom: 1px solid var(--beige-100);
        border-right: 1px solid var(--beige-100);
    }

    .detail-item:nth-child(2n) {
        border-right: none;
    }

    .detail-item:last-child,
    .detail-item:nth-last-child(2) {
        border-bottom: none;
    }

    .detail-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-light);
        margin-bottom: 6px;
        font-weight: 600;
    }

    .detail-value {
        font-size: 18px;
        color: var(--text-dark);
        font-weight: 600;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-info {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .actions-section {
        padding: 24px 32px;
        background: var(--beige-50);
        display: flex;
        gap: 12px;
        justify-content: flex-end;
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

    @media (max-width: 768px) {
        .user-header {
            padding: 24px;
        }

        .user-title {
            font-size: 22px;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .detail-item {
            border-right: none;
        }

        .actions-section {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container-fluid">
    <div class="details-container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
        </nav>

        <!-- User Details Card -->
        <div>
            <!-- Header -->
            <div class="user-header">
                <h1 class="user-title">{{ $user->name }}</h1>
            </div>

            <!-- Details Card -->
            <div class="details-card">
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">ID</div>
                        <div class="detail-value">{{ $user->id }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Name</div>
                        <div class="detail-value">{{ $user->name }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $user->email }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Role</div>
                        <div class="detail-value">
                            @if($user->role)
                                <span class="badge badge-info">{{ $user->role->name }}</span>
                            @else
                                <span class="badge badge-info">—</span>
                            @endif
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Created At</div>
                        <div class="detail-value">{{ $user->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="actions-section">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                        <i class="bi bi-pencil-fill"></i> Edit User
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
