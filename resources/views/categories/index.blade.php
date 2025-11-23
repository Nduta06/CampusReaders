@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<style>
/* Add New Category Button */
.btn-add-category {
    border-radius: 50px; /* Pill shape */
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

.btn-add-category i {
    font-size: 1.3rem;
}

.btn-add-category:hover {
    background: linear-gradient(90deg, #ffe0b2 0%, #f5e9d7 100%);
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    color: #1a237e;
    text-decoration: none;
}

/* Table Card Styling */
.card-custom {
    background: #f5f5dc;
    color: #111;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}

.table thead th {
    color: #1a237e;
}

.table tbody td {
    color: #111;
}

/* Responsive Spacing */
.table-responsive {
    padding: 1rem;
}

.mt-3 {
    margin-top: 1rem !important;
}
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Categories</h3>
        </div>
    </div>

    <!-- Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure? This will delete the category only if no books depend on it.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($categories->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center text-muted">No categories found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <!-- Add New Category Button under table -->
                    <div class="mt-3 text-end">
                        <a href="{{ route('categories.create') }}" class="btn btn-add-category shadow-sm">
                            <i class="bi bi-plus-circle"></i> Add New Category
                        </a>
                    </div>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div>
    </div> <!-- row -->
</div> <!-- container -->
@endsection
