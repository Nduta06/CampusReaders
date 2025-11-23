
@extends('layout')

@section('title', 'Admin - Manage Books')

@section('content')
<div class="auth-container">
    <div class="auth-card" style="max-width:900px;width:100%;">
        <div class="auth-header">
            <h1>Manage Books</h1>
            <p>Admin panel for book management</p>
        </div>

        <!-- Add Book Button -->
        <div style="text-align:right;margin-bottom:20px;">
            <a href="{{ route('books.create') }}" class="btn-auth" style="width:auto;display:inline-block;">Add New Book</a>
        </div>

        <!-- Books Table -->
        <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f5f1e6;">
                    <th style="padding:10px 8px;border-bottom:1px solid #e8dfca;">Title</th>
                    <th style="padding:10px 8px;border-bottom:1px solid #e8dfca;">Author</th>
                    <th style="padding:10px 8px;border-bottom:1px solid #e8dfca;">ISBN</th>
                    <th style="padding:10px 8px;border-bottom:1px solid #e8dfca;">Edition</th>
                    <th style="padding:10px 8px;border-bottom:1px solid #e8dfca;">Year</th>
                    <th style="padding:10px 8px;border-bottom:1px solid #e8dfca;">Available</th>
                    <th style="padding:10px 8px;border-bottom:1px solid #e8dfca;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td style="padding:8px;">{{ $book->title }}</td>
                    <td style="padding:8px;">{{ $book->author }}</td>
                    <td style="padding:8px;">{{ $book->ISBN }}</td>
                    <td style="padding:8px;">{{ $book->edition }}</td>
                    <td style="padding:8px;">{{ $book->publication_year }}</td>
                    <td style="padding:8px;">{{ $book->available_copies }} / {{ $book->total_copies }}</td>
                    <td style="padding:8px;">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn-auth" style="width:auto;padding:6px 12px;font-size:13px;display:inline-block;">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-auth" style="width:auto;padding:6px 12px;font-size:13px;background:#d32f2f;margin-left:5px;">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:20px;color:#a08c6c;">No books found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
