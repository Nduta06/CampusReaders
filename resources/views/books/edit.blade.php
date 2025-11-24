@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')

<style>
    .form-card {
        max-width: 800px;
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

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
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

    .form-control::placeholder {
        color: var(--text-light);
    }

    .form-control:disabled {
        background-color: var(--beige-50);
        cursor: not-allowed;
        opacity: 0.7;
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

    .help-text {
        color: var(--text-light);
        font-size: 12px;
        display: block;
        margin-top: 6px;
    }
</style>

<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
            <li class="breadcrumb-item active">Edit: {{ $book->title }}</li>
        </ol>
    </nav>

    <div class="form-card">
        <div class="card">
            <div class="card-body" style="padding: 32px;">
                <form action="{{ route('books.update', $book) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <h4 class="form-section-title">Basic Information</h4>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="title" class="form-label">
                                    Book Title <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="title" 
                                    name="title" 
                                    value="{{ old('title', $book->title) }}"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="author" class="form-label">
                                    Author <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="author" 
                                    name="author" 
                                    value="{{ old('author', $book->author) }}"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="form-label">
                                    Category <span class="required">*</span>
                                </label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ (old('category_id', $book->category_id) == $category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ISBN" class="form-label">
                                    ISBN
                                    <span class="info-badge">Read-only</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="ISBN" 
                                    name="ISBN" 
                                    value="{{ $book->ISBN }}"
                                    disabled
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Publication Details Section -->
                    <div class="form-section">
                        <h4 class="form-section-title">Publication & Inventory Details</h4>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="edition" class="form-label">
                                    Edition
                                    <span class="info-badge">Read-only</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="edition" 
                                    value="{{ $book->edition }}"
                                    disabled
                                >
                            </div>

                            <div class="form-group">
                                <label for="publication_year" class="form-label">
                                    Publication Year
                                    <span class="info-badge">Read-only</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="publication_year" 
                                    value="{{ $book->publication_year }}"
                                    disabled
                                >
                            </div>

                            <div class="form-group">
                                <label for="total_copies" class="form-label">
                                    Total Copies <span class="required">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="total_copies" 
                                    name="total_copies" 
                                    value="{{ old('total_copies', $book->total_copies) }}"
                                    min="0"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="available_copies" class="form-label">
                                    Available Copies
                                    <span class="info-badge">Current: {{ $book->available_copies }}</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    value="{{ $book->available_copies }} available"
                                    disabled
                                >
                                <small class="help-text">
                                    This updates automatically based on borrowing activity
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Update Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection