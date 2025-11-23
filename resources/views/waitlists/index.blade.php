@extends('layouts.app')

@section('title', 'Waitlists')

@section('content')
<style>
.card-custom {
    background: #f5f5dc;
    color: #111;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}
.table thead th { color: #1a237e; }
.table tbody td { color: #111; }
.table-responsive { padding: 1rem; }
.mt-3 { margin-top: 1rem !important; }
</style>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0">Waitlists</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Book</th>
                                <th>User</th>
                                <th>Joined At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($waitlists as $wait)
                            <tr>
                                <td>{{ $wait->id }}</td>
                                <td>{{ $wait->book->title ?? 'N/A' }}</td>
                                <td>{{ $wait->user->name ?? 'N/A' }}</td>
                                <td>{{ $wait->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form action="{{ route('waitlists.destroy', $wait) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this user from the waitlist?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No waitlist entries found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
