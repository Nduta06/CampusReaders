@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Book Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Author: {{ $book->author }}</h6>
            <p class="card-text">Category: {{ $book->category->name ?? 'N/A' }}</p>
            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
