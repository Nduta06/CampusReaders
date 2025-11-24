@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    /* Dashboard-specific styles */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: linear-gradient(135deg, #ffffff 0%, #faf8f3 100%);
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(90, 74, 58, 0.06);
        border: 1px solid rgba(228, 223, 213, 0.5);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: var(--beige-300);
        opacity: 0.1;
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(90, 74, 58, 0.12);
        border-color: var(--beige-300);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 24px;
        position: relative;
        z-index: 1;
    }

    .stat-icon.books {
        background: linear-gradient(135deg, #e8dfca 0%, #d4c9b4 100%);
        color: #756045;
    }

    .stat-icon.users {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
    }

    .stat-icon.categories {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #b45309;
    }

    .stat-icon.borrowed {
        background: linear-gradient(135deg, #ddd6fe 0%, #c4b5fd 100%);
        color: #6b21a8;
    }

    .stat-icon.reservations {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
    }

    .stat-icon.fines {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #b91c1c;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }

    .stat-label {
        font-size: 14px;
        color: var(--text-medium);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        z-index: 1;
    }

    /* Quick Actions */
    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: var(--beige-600);
        border-radius: 2px;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }

    .action-card {
        background: #ffffff;
        border: 2px solid var(--beige-200);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .action-card:hover {
        border-color: var(--beige-600);
        background: var(--beige-50);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(90, 74, 58, 0.1);
    }

    .action-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: var(--beige-100);
        color: var(--beige-700);
    }

    .action-card:hover .action-icon {
        background: var(--beige-600);
        color: #ffffff;
    }

    .action-label {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Recent Activity Section */
    .activity-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 20px;
    }

    .activity-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid var(--beige-200);
        overflow: hidden;
    }

    .activity-header {
        padding: 16px 20px;
        background: var(--beige-100);
        border-bottom: 1px solid var(--beige-200);
        font-weight: 600;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .activity-body {
        padding: 20px;
    }

    .activity-item {
        padding: 12px 0;
        border-bottom: 1px solid var(--beige-100);
        display: flex;
        justify-content: space-between;
        align-items: start;
        gap: 12px;
    }

    .activity-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .activity-item:first-child {
        padding-top: 0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-size: 14px;
        color: var(--text-dark);
        font-weight: 500;
        margin-bottom: 4px;
    }

    .activity-meta {
        font-size: 12px;
        color: var(--text-light);
    }

    .activity-badge {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
    }

    .empty-state i {
        font-size: 48px;
        opacity: 0.3;
        display: block;
        margin-bottom: 12px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }

        .stat-card {
            padding: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }

        .stat-value {
            font-size: 24px;
        }

        .quick-actions-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        .activity-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid">
    <!-- System Overview Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon books">
                <i class="bi bi-book-fill"></i>
            </div>
            <div class="stat-value">{{ $books->count() ?? 0 }}</div>
            <div class="stat-label">Total Books</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon users">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-value">{{ $users->count() ?? 0 }}</div>
            <div class="stat-label">Total Users</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon categories">
                <i class="bi bi-tags-fill"></i>
            </div>
            <div class="stat-value">{{ $categories->count() ?? 0 }}</div>
            <div class="stat-label">Categories</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon borrowed">
                <i class="bi bi-arrow-left-right"></i>
            </div>
            <div class="stat-value">{{ $totalBorrowed ?? 0 }}</div>
            <div class="stat-label">Borrowed Items</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon reservations">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div class="stat-value">{{ $reservations->count() ?? 0 }}</div>
            <div class="stat-label">Reservations</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon fines">
                <i class="bi bi-cash-coin"></i>
            </div>
            <div class="stat-value">{{ $fines->count() ?? 0 }}</div>
            <div class="stat-label">Active Fines</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <h3 class="section-title">Quick Actions</h3>
    <div class="quick-actions-grid">
        <a href="{{ route('books.create') }}" class="action-card">
            <div class="action-icon">
                <i class="bi bi-book"></i>
            </div>
            <div class="action-label">Add New Book</div>
        </a>

        <a href="{{ route('users.create') }}" class="action-card">
            <div class="action-icon">
                <i class="bi bi-person-plus"></i>
            </div>
            <div class="action-label">Add New User</div>
        </a>

        <a href="{{ route('categories.create') }}" class="action-card">
            <div class="action-icon">
                <i class="bi bi-tags"></i>
            </div>
            <div class="action-label">Add Category</div>
        </a>

        <a href="{{ route('reservations.index') }}" class="action-card">
            <div class="action-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="action-label">View Reservations</div>
        </a>

        <a href="{{ route('borrowed-items.index') }}" class="action-card">
            <div class="action-icon">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <div class="action-label">Borrowed Items</div>
        </a>

        <a href="{{ route('fines.index') }}" class="action-card">
            <div class="action-icon">
                <i class="bi bi-cash"></i>
            </div>
            <div class="action-label">Manage Fines</div>
        </a>
    </div>

    <!-- Recent Activity -->
    <h3 class="section-title">Recent Activity</h3>
    <div class="activity-grid">
        <!-- Recent Reservations -->
        <div class="activity-card">
            <div class="activity-header">
                <i class="bi bi-calendar-check"></i>
                Recent Reservations
            </div>
            <div class="activity-body">
                @if($reservations->count() > 0)
                    @foreach($reservations->take(5) as $reservation)
                        <div class="activity-item">
                            <div class="activity-content">
                                <div class="activity-title">{{ $reservation->book->title ?? 'N/A' }}</div>
                                <div class="activity-meta">
                                    Reserved by {{ $reservation->user->name ?? 'Unknown' }} 
                                    • {{ $reservation->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <span class="activity-badge badge-info">Active</span>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        <p>No recent reservations</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Borrowed Items -->
        <div class="activity-card">
            <div class="activity-header">
                <i class="bi bi-arrow-left-right"></i>
                Recently Borrowed
            </div>
            <div class="activity-body">
                @if(isset($recentBorrowed) && $recentBorrowed->count() > 0)
                    @foreach($recentBorrowed->take(5) as $borrowed)
                        <div class="activity-item">
                            <div class="activity-content">
                                <div class="activity-title">{{ $borrowed->book->title ?? 'N/A' }}</div>
                                <div class="activity-meta">
                                    Borrowed by {{ $borrowed->user->name ?? 'Unknown' }}
                                    • Due {{ $borrowed->due_date->format('M d, Y') }}
                                </div>
                            </div>
                            @if($borrowed->due_date->isPast())
                                <span class="activity-badge badge-danger">Overdue</span>
                            @else
                                <span class="activity-badge badge-success">Active</span>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>No borrowed items</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection