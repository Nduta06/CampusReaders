@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Category Details</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card" style="background: #f5f5dc; color: #111;">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-link">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
