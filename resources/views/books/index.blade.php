
@extends('layouts.app')

@section('title', 'Books')

@section('content')
<style>
.btn-add-book {
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
.btn-add-book i { font-size: 1.3rem; }
.btn-add-book:hover {
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
            <h3 class="fw-bold mb-0">Books</h3>
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
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Available</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->category->name ?? 'N/A' }}</td>
                                <td>{{ $book->available_copies }}</td>
                                <td>{{ $book->total_copies }}</td>
                                <td>
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($books->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted">No books found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="mt-3 text-end">
                        <a href="{{ route('books.create') }}" class="btn btn-add-book shadow-sm">
                            <i class="bi bi-plus-circle"></i> Add New Book
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
