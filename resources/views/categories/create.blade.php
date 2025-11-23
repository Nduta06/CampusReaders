@extends('layouts.app')

@section('title', 'Add New Category')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Add New Category</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card" style="background: #f5f5dc; color: #111;">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label" style="color: #111;">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" required style="background: #fff; color: #111; border: 1px solid #bbb;">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
