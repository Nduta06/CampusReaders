@extends('layout')
@section('title', 'Admin - Manage Books')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">Manage Books</h1>
        <p class="page-subtitle">View, add, edit and manage your library's book collection</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Book Collection</h2>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Book
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Edition</th>
                            <th>Year</th>
                            <th>Available</th>
                            <th style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td>
                                <strong>{{ $book->title }}</strong>
                            </td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->ISBN }}</td>
                            <td>{{ $book->edition }}</td>
                            <td>{{ $book->publication_year }}</td>
                            <td>
                                <span class="badge {{ $book->available_copies > 0 ? 'badge-success' : 'badge-danger' }}">
                                    {{ $book->available_copies }} / {{ $book->total_copies }}
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="table-empty">
                                <i class="fas fa-book" style="font-size: 48px; opacity: 0.3; display: block; margin-bottom: 12px;"></i>
                                No books found in the system.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(isset($books) && $books->hasPages())
        <div class="card-footer">
            {{ $books->links() }}
        </div>
        @endif
    </div>
</div>
@endsection