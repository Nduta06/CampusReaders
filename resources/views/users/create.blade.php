@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Add New User</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card" style="background: #f5f5dc; color: #111;">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label" style="color: #111;">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required style="background: #fff; color: #111; border: 1px solid #bbb;">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: #111;">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required style="background: #fff; color: #111; border: 1px solid #bbb;">
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label" style="color: #111;">Role</label>
                            <select class="form-select" id="role_id" name="role_id" required style="background: #fff; color: #111; border: 1px solid #bbb;">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label" style="color: #111;">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required style="background: #fff; color: #111; border: 1px solid #bbb;">
                        </div>
                        <button type="submit" class="btn btn-primary">Create User</button>
                        <a href="{{ route('users.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
