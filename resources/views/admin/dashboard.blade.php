
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Welcome, Admin!</h3>
            <p class="text-muted">Here’s a quick overview of your library system.</p>
        </div>
    </div>
    <div class="row mb-4">
        <!-- System Overview Summary as Cards -->
        <div class="col-12">
            <div class = "system-overview-row">
                
                    <div class="overview-card">
                        <div class="overview-icon bg-primary text-white"><i class="bi bi-book"></i></div>
                        <div class="overview-value">{{ $books->count() ?? 0 }}</div>
                        <div class="overview-label">Books</div>
                    </div>

                    <div class="overview-card">
                        <div class="overview-icon bg-secondary text-white"><i class="bi bi-people"></i></div>
                        <div class="overview-value">{{ $users->count() ?? 0 }}</div>
                        <div class="overview-label">Users</div>
                    </div>

                    <div class="overview-card">
                        <div class="overview-icon bg-info text-white"><i class="bi bi-tags"></i></div>
                        <div class="overview-value">{{ $categories->count() ?? 0 }}</div>
                        <div class="overview-label">Categories</div>
                    </div>

                    <div class="overview-card">
                        <div class="overview-icon bg-warning text-dark"><i class="bi bi-arrow-left-right"></i></div>
                        <div class="overview-value">{{ $totalBorrowed ?? 0 }}</div>
                        <div class="overview-label">Borrowed Books</div>
                    </div>

                    <div class="overview-card">
                        <div class="overview-icon bg-success text-white"><i class="bi bi-calendar-check"></i></div>
                        <div class="overview-value">{{ $reservations->count() ?? 0 }}</div>
                        <div class="overview-label">Reservations</div>
                    </div>

                    <div class="overview-card">
                        <div class="overview-icon bg-danger text-white"><i class="bi bi-cash"></i></div>
                        <div class="overview-value">{{ $fines->count() ?? 0 }}</div>
                        <div class="overview-label">Fines</div>
                    </div>
            </div>
        </div>
        <p></p>
        <style>
            .system-overview-row {
                display: flex;
                flex-wrap: nowrap;
                gap: 1.5rem;
                overflow-x: auto;
                width: 100%;
                align-items: stretch; /* or center */
            }

            .overview-card {
                background: #fff7e0;
                border-radius: 14px;
                box-shadow: 0 2px 8px rgba(90,74,58,0.07);
                padding: 0.6rem 0.7rem 0.6rem 0.7rem;
                min-width: 80px;
                max-width: 120px;
                width: 12vw;
                flex: 0 0 auto;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 70px;
            }
            .overview-icon {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.3rem;
                margin-bottom: 0.5rem;
            }
            .overview-value {
                font-size: 1.7rem;
                font-weight: 700;
                color: #5a4a3a;
            }
            .overview-label {
                font-size: 1rem;
                color: #7c6a4d;
                margin-top: 0.2rem;
            }
            @media (max-width: 900px) {
                .system-overview-row {
                    flex-wrap: wrap;
                    gap: 0.5rem;
                }
                .overview-card { min-width: 100px; max-width: 140px; width: 40vw; padding: 0.7rem 0.5rem; }
            }
        </style>
    </div>
    <div class="row mb-4">
        <!-- Quick Actions -->
        <div class="col-12 ">
            <div class="quick-action-row">
                    <a href="{{ route('books.create') }}" class="quick-action-card text-decoration-none">
                        <div class="quick-action-icon bg-primary text-white"><i class="bi bi-book"></i></div>
                        <div class="quick-action-label">Add Book</div>
                    </a>
                    <a href="{{ route('users.create') }}" class="quick-action-card text-decoration-none">
                        <div class="quick-action-icon bg-secondary text-white"><i class="bi bi-person-plus"></i></div>
                        <div class="quick-action-label">Add User</div>
                    </a>
                    <a href="{{ route('categories.create') }}" class="quick-action-card text-decoration-none">
                        <div class="quick-action-icon bg-info text-white"><i class="bi bi-tags"></i></div>
                        <div class="quick-action-label">Add Category</div>
                    </a>
                    <a href="{{ route('reservations.index') }}" class="quick-action-card text-decoration-none">
                        <div class="quick-action-icon bg-warning text-dark"><i class="bi bi-calendar-check"></i></div>
                        <div class="quick-action-label">View Reservations</div>
                    </a>
                </div>
            </div>
        </div>
        <style>
            .quick-action-row {
                display: flex;
                flex-wrap: nowrap;
                gap: 1rem;
                overflow-x: auto;
                width: 100%;
                align-items: stretch;
            }
            .quick-action-card {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-width: 120px;
                max-width: 160px;
                width: 12vw;
                height: 100px;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(90,74,58,0.07);
                transition: box-shadow 0.15s, transform 0.15s;
                padding: 0.5rem;
                text-align: center;
                flex-shrink: 0;
            }
            @media (max-width: 900px) {
                .quick-action-row {
                    flex-wrap: wrap;
                }
                .quick-action-card {
                    width: 40vw;
                    margin-bottom: 0.5rem;
                }
            }
            .quick-action-card {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-width: 90px;
                max-width: 120px;
                width: 10vw;
                height: 60px;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(90,74,58,0.07);
                transition: box-shadow 0.15s, transform 0.15s;
                padding: 0.3rem 0.2rem 0.2rem 0.2rem;
                text-align: center;
                position: relative;
                flex-shrink: 0;
            }
                font-weight: 500;
                color: #5a4a3a;
            }

        </style>
    </div>
    <div class="row">
        <!-- Recent Activity (example: recent reservations) -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header fw-bold">Recent Reservations</div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Book</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReservations as $reservation)
                            <tr>
                                <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                                <td>{{ $reservation->book->title ?? 'N/A' }}</td>
                                <td>{{ $reservation->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No recent reservations.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Alerts/Notifications (example: overdue books) -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header fw-bold">Overdue Books</div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>User</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($overdueBooks as $item)
                            <tr>
                                <td>{{ $item->book->title ?? 'N/A' }}</td>
                                <td>{{ $item->user->name ?? 'N/A' }}</td>
                                <td>{{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No overdue books.</td>
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
