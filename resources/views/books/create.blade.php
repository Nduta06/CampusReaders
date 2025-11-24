@extends('layouts.app')

@section('title', 'Add New Book')

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
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
            <li class="breadcrumb-item active">Add New Book</li>
        </ol>
    </nav>

    <div class="form-card">
        <div class="card">
            <div class="card-body" style="padding: 32px;">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

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
                                    placeholder="Enter book title"
                                    value="{{ old('title') }}"
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
                                    placeholder="Enter author name"
                                    value="{{ old('author') }}"
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
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ISBN" class="form-label">
                                    ISBN <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="ISBN" 
                                    name="ISBN" 
                                    placeholder="e.g., 978-3-16-148410-0"
                                    value="{{ old('ISBN') }}"
                                    required
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Publication Details Section -->
                    <div class="form-section">
                        <h4 class="form-section-title">Publication Details</h4>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="edition" class="form-label">
                                    Edition <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="edition" 
                                    name="edition" 
                                    placeholder="e.g., 1st, 2nd, 3rd"
                                    value="{{ old('edition') }}"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="publication_year" class="form-label">
                                    Publication Year <span class="required">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="publication_year" 
                                    name="publication_year" 
                                    placeholder="e.g., 2024"
                                    value="{{ old('publication_year') }}"
                                    min="1800"
                                    max="{{ date('Y') }}"
                                    required
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
                                    placeholder="Enter number of copies"
                                    value="{{ old('total_copies', 1) }}"
                                    min="1"
                                    required
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Create Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection