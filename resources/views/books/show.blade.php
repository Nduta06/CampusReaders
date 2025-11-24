@extends('layouts.app')

@section('title', 'Book Details')

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

    .book-header {
        background: linear-gradient(135deg, var(--beige-600) 0%, var(--beige-700) 100%);
        color: #ffffff;
        padding: 32px;
        border-radius: 12px 12px 0 0;
        margin-bottom: 0;
    }

    .book-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .book-author {
        font-size: 18px;
        opacity: 0.9;
        display: flex;
        align-items: center;
        gap: 8px;
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

    .detail-value .badge {
        font-size: 14px;
        padding: 6px 14px;
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

    .badge-success {
        background-color: #dcfce7;
        color: #15803d;
    }

    .badge-warning {
        background-color: #fef3c7;
        color: #b45309;
    }

    .badge-danger {
        background-color: #fee2e2;
        color: #b91c1c;
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

    .info-section {
        padding: 32px;
        border-bottom: 1px solid var(--beige-100);
    }

    .info-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-title::before {
        content: '';
        width: 4px;
        height: 20px;
        background: var(--beige-600);
        border-radius: 2px;
    }

    .info-content {
        color: var(--text-medium);
        line-height: 1.8;
        font-size: 15px;
    }

    @media (max-width: 768px) {
        .book-header {
            padding: 24px;
        }

        .book-title {
            font-size: 22px;
        }

        .book-author {
            font-size: 16px;
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
                <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
                <li class="breadcrumb-item active">{{ $book->title }}</li>
            </ol>
        </nav>

        <!-- Book Details Card -->
        <div>
            <!-- Header -->
            <div class="book-header">
                <h1 class="book-title">{{ $book->title }}</h1>
                <div class="book-author">
                    <i class="bi bi-person-fill"></i> {{ $book->author }}
                </div>
            </div>

            <!-- Details Card -->
            <div class="details-card">
                <!-- Basic Information -->
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">Category</div>
                        <div class="detail-value">
                            <span class="badge badge-info">
                                <i class="bi bi-tag-fill"></i> {{ $book->category->name ?? 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">ISBN</div>
                        <div class="detail-value">{{ $book->ISBN }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Edition</div>
                        <div class="detail-value">{{ $book->edition }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Publication Year</div>
                        <div class="detail-value">{{ $book->publication_year }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Total Copies</div>
                        <div class="detail-value">{{ $book->total_copies }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Availability Status</div>
                        <div class="detail-value">
                            @if($book->available_copies > 5)
                                <span class="badge badge-success">
                                    <i class="bi bi-check-circle-fill"></i> {{ $book->available_copies }} Available
                                </span>
                            @elseif($book->available_copies > 0)
                                <span class="badge badge-warning">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $book->available_copies }} Left
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <i class="bi bi-x-circle-fill"></i> Out of Stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Additional Information (if exists) -->
                @if(isset($book->description) && $book->description)
                <div class="info-section">
                    <h3 class="info-title">Description</h3>
                    <div class="info-content">
                        {{ $book->description }}
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="actions-section">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">
                        <i class="bi bi-pencil-fill"></i> Edit Book
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection