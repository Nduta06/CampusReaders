@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">User Details</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 col-xl-5">
            <div class="card shadow-sm" style="background: #f5f5dc; color: #111;">
                <div class="card-header" style="background-color: #e3f2fd; color: #1a237e; font-weight: 600;">
                    <i class="bi bi-person"></i> User Information
                </div>
                <div class="card-body" style="background: #f5f5dc; color: #111;">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0" style="background: #fff; color: #111;">
                            <tbody>
                                <tr>
                                    <th style="width: 30%; color: #1a237e;">ID</th>
                                    <td style="color: #111;">{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th style="color: #1a237e;">Name</th>
                                    <td style="color: #111;">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th style="color: #1a237e;">Email</th>
                                    <td style="color: #111;">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th style="color: #1a237e;">Role</th>
                                    <td style="color: #111;">{{ $user->role->name ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th style="color: #1a237e;">Created</th>
                                    <td style="color: #111;">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                        <a href="{{ route('users.index') }}" class="btn btn-link btn-sm">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
