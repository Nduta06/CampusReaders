@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action">Users</a>
                <a href="#" class="list-group-item list-group-item-action">Books</a>
                <a href="#" class="list-group-item list-group-item-action">Categories</a>
                <a href="#" class="list-group-item list-group-item-action">Reservations</a>
                <a href="#" class="list-group-item list-group-item-action">Borrowed Items</a>
                <a href="#" class="list-group-item list-group-item-action">Fines</a>
                <a href="#" class="list-group-item list-group-item-action">Waitlists</a>
                <a href="#" class="list-group-item list-group-item-action">Messaging Logs</a>
                <a href="#" class="list-group-item list-group-item-action">Roles</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Welcome, Admin!</h5>
                    <p class="card-text">Use the navigation to manage the library system.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
