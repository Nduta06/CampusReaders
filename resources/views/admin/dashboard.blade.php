@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<style>
/* --- Global Beige Theme --- */
:root {
    --beige-bg: #f8f1e4;
    --beige-light: #fff8e8;
    --beige-dark: #000000; /* force all text to black */
    --beige-accent: #d8c3a5;
}

/* Page Background */
body {
    background-color: var(--beige-bg) !important;
    color: black !important;
}

/* Headings */
h3, h4, h5, p, div, span, a, label {
    color: black !important;
}

/* Summary Overview Cards */
.system-overview-row {
    display: flex;
    gap: 1.2rem;
    overflow-x: auto;
    padding-bottom: .5rem;
}

.overview-card {
    background: var(--beige-light);
    border-radius: 14px;
    padding: 1rem;
    min-width: 135px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    text-align: center;
    flex: 0 0 auto;
    transition: 0.2s;
}
.overview-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

/* Icons in summary cards → black */
.overview-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    margin-bottom: .7rem;
    font-size: 1.4rem;
    background: var(--beige-accent) !important;
    color: black !important;
}

.overview-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: black !important;
}

.overview-label {
    font-size: .95rem;
    color: black !important;
}

/* Quick Action Cards */
.quick-action-row {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.quick-action-card {
    background: var(--beige-light) !important;
    border-radius: 14px;
    padding: 1rem;
    width: 150px;
    height: 110px;
    text-align: center;
    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    transition: .2s;
    color: black !important;
}
.quick-action-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

/* Quick Action Icons → black circle, black icons */
.quick-action-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: .6rem;
    font-size: 1.4rem;
    background: var(--beige-accent) !important;
    color: black !important;
}

.quick-action-label {
    font-size: .95rem;
    font-weight: 600;
    color: black !important;
}

/* Cards (Recent Reservations / Overdue Books) */
.card {
    border-radius: 14px !important;
    background: var(--beige-light);
    color: black !important;
}
.card-header {
    background: var(--beige-accent);
    color: black !important;
    font-weight: 600;
}
</style>

<div class="container-fluid">
    <p></p>
    <div></div>
    <!-- Summary Row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="system-overview-row">

                <div class="overview-card">
                    <div class="overview-icon"><i class="bi bi-book"></i></div>
                    <div class="overview-value">{{ $books->count() ?? 0 }}</div>
                    <div class="overview-label">Books</div>
                </div>

                <div class="overview-card">
                    <div class="overview-icon"><i class="bi bi-people"></i></div>
                    <div class="overview-value">{{ $users->count() ?? 0 }}</div>
                    <div class="overview-label">Users</div>
                </div>

                <div class="overview-card">
                    <div class="overview-icon"><i class="bi bi-tags"></i></div>
                    <div class="overview-value">{{ $categories->count() ?? 0 }}</div>
                    <div class="overview-label">Categories</div>
                </div>

                <div class="overview-card">
                    <div class="overview-icon"><i class="bi bi-arrow-left-right"></i></div>
                    <div class="overview-value">{{ $totalBorrowed ?? 0 }}</div>
                    <div class="overview-label">Borrowed</div>
                </div>

                <div class="overview-card">
                    <div class="overview-icon"><i class="bi bi-calendar-check"></i></div>
                    <div class="overview-value">{{ $reservations->count() ?? 0 }}</div>
                    <div class="overview-label">Reservations</div>
                </div>

                <div class="overview-card">
                    <div class="overview-icon"><i class="bi bi-cash"></i></div>
                    <div class="overview-value">{{ $fines->count() ?? 0 }}</div>
                    <div class="overview-label">Fines</div>
                </div>

            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="fw-bold mb-3">Quick Actions</h5>

            <div class="quick-action-row">

                <a href="{{ route('books.create') }}" class="quick-action-card text-decoration-none">
                    <div class="quick-action-icon"><i class="bi bi-book"></i></div>
                    <div class="quick-action-label">Add Book</div>
                </a>

                <a href="{{ route('users.create') }}" class="quick-action-card text-decoration-none">
                    <div class="quick-action-icon"><i class="bi bi-person-plus"></i></div>
                    <div class="quick-action-label">Add User</div>
                </a>

                <a href="{{ route('categories.create') }}" class="quick-action-card text-decoration-none">
                    <div class="quick-action-icon"><i class="bi bi-tags"></i></div>
                    <div class="quick-action-label">Add Category</div>
                </a>

                <a href="{{ route('reservations.index') }}" class="quick-action-card text-decoration-none">
                    <div class="quick-action-icon"><i class="bi bi-calendar-check"></i></div>
                    <div class="quick-action-label">View Reservations</div>
                </a>

            </div>
        </div>
    </div>
</div>

@endsection
