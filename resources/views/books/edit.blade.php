@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Edit Book</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card" style="background: #f5f5dc; color: #111;">
                <div class="card-body">
                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label" style="color: #111;">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required style="background: #fff; color: #111; border: 1px solid #bbb;">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label" style="color: #111;">Author</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required style="background: #fff; color: #111; border: 1px solid #bbb;">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label" style="color: #111;">Category</label>
                            <select class="form-select" id="category_id" name="category_id" style="background: #fff; color: #111; border: 1px solid #bbb;">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($book->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_copies" class="form-label" style="color: #111;">Total Copies</label>
                            <input type="number" class="form-control" id="total_copies" name="total_copies" value="{{ $book->total_copies }}" min="0" required style="background: #fff; color: #111; border: 1px solid #bbb;">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('books.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
