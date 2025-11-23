@extends('layouts.app')

@section('title', 'Fines')

@section('content')
<style>
.btn-update-status {
    border-radius: 50px;
    font-weight: 600;
    padding: 0.4rem 1.1rem;
    font-size: 0.95rem;
    color: #fff;
    background: #1a237e;
    border: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-update-status:hover {
    background: #3949ab;
    color: #fff;
    text-decoration: none;
}
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
            <h3 class="fw-bold mb-0">Fines</h3>
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
                                <th>User</th>
                                <th>Book</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Issued At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($fines as $fine)
                            <tr>
                                <td>{{ $fine->id }}</td>
                                <td>{{ $fine->user->name ?? 'N/A' }}</td>
                                <td>{{ $fine->book->title ?? 'N/A' }}</td>
                                <td>{{ number_format($fine->amount, 2) }}</td>
                                <td>
                                    @if($fine->status === 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Unpaid</span>
                                    @endif
                                </td>
                                <td>{{ $fine->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    @if($fine->status !== 'paid')
                                    <form action="{{ route('fines.update', $fine) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="mark_paid" value="1">
                                        <button type="submit" class="btn btn-update-status btn-sm">Mark Paid</button>
                                    </form>
                                    @endif
                                    <form action="{{ route('fines.destroy', $fine) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this fine?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No fines found.</td>
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
