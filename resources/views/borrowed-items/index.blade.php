@extends('layouts.app')

@section('title', 'Borrowed Items')

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

.btn-issue-book {
    background: linear-gradient(135deg, #1a237e 0%, #283593 100%); /* Subtle gradient */
    color: white !important;
    padding: 10px 24px;
    border-radius: 50px; 
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(26, 35, 126, 0.2); /* Soft shadow */
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px; 
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.1);
}

.btn-issue-book:hover {
    background: linear-gradient(135deg, #283593 0%, #3949ab 100%);
    transform: translateY(-2px); 
    box-shadow: 0 6px 20px rgba(26, 35, 126, 0.3);
}

.btn-issue-book svg {
    width: 20px;
    height: 20px;
}
</style>
<div class="container-fluid">
    <div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-0" style="color: #1a237e;">Borrowed Items</h3>
        
        <a href="{{ route('borrowed-items.create') }}" class="btn-issue-book">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Issue New Book
        </a>
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
                                <th>Borrowed At</th>
                                <th>Due Date</th>
                                <th>Returned At</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($borrowedItems as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->book->title ?? 'N/A' }}</td>
                                <td>{{ $item->user->name ?? 'N/A' }}</td>
                                <td>{{ $item->borrowed_at ? $item->borrowed_at->format('Y-m-d H:i') : '-' }}</td>
                                <td>{{ $item->due_date ? $item->due_date->format('Y-m-d') : '-' }}</td>
                                <td>{{ $item->returned_at ? $item->returned_at->format('Y-m-d H:i') : '-' }}</td>
                                <td>
                                    @if($item->returned_at)
                                        <span class="badge bg-success">Returned</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Borrowed</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Mark as returned -->
                                    @if(!$item->returned_at)
                                    <form action="{{ route('borrowed-items.update', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="mark_returned" value="1">
                                        <button type="submit" class="btn btn-update-status btn-sm">Mark Returned</button>
                                    </form>
                                    @endif
                                    <!-- Update due date -->
                                    <form action="{{ route('borrowed-items.update', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="date" name="due_date" value="{{ $item->due_date ? $item->due_date->format('Y-m-d') : '' }}" class="form-control form-control-sm d-inline w-auto" style="display:inline-block;">
                                        <button type="submit" class="btn btn-update-status btn-sm ms-1">Update Due</button>
                                    </form>
                                    <!-- Delete (admin correction) -->
                                    <form action="{{ route('borrowed-items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this borrowed item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No borrowed items found.</td>
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
