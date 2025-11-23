@extends('layouts.app')

@section('title', 'Role Details')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Role Details</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 col-xl-5">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #e3f2fd; color: #1a237e; font-weight: 600;">
                    <i class="bi bi-person-badge"></i> Role Information
                </div>
                <div class="card-body" style="background-color: #f8fafc; color: #212529;">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0" style="background: #fff;">
                            <tbody>
                                <tr>
                                    <th style="width: 30%; color: #1a237e;">ID</th>
                                    <td style="color: #212529;">{{ $role->id }}</td>
                                </tr>
                                <tr>
                                    <th style="color: #1a237e;">Name</th>
                                    <td style="color: #212529;">{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <th style="color: #1a237e;">Description</th>
                                    <td style="color: #212529;">{{ $role->description ? $role->description : '—' }}</td>
                                </tr>
                                <tr>
                                    <th style="color: #1a237e;">Users</th>
                                    <td style="color: #212529;">{{ $role->user()->count() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-secondary btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                        <a href="{{ route('roles.index') }}" class="btn btn-link btn-sm">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
