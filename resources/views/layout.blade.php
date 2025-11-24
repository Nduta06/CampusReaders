<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CampusReaders - Library Management System')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @livewireStyles
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --beige-50: #faf8f3;
            --beige-100: #f5f1e8;
            --beige-200: #e8e2d1;
            --beige-300: #d4c9b4;
            --beige-400: #c4b5a0;
            --beige-500: #a08c6c;
            --beige-600: #8b7355;
            --beige-700: #756045;
            --white: #ffffff;
            --text-dark: #3a3a3a;
            --text-medium: #5a5a5a;
            --text-light: #8a8a8a;
            --border-light: #e5e0d5;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #f59e0b;
            --info: #0284c7;
        }

        body {
            background-color: var(--beige-100);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ========== HEADER STYLES ========== */
        header {
            background-color: var(--white);
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            gap: 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .logo a {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            color: var(--beige-600);
            font-size: 28px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-medium);
            font-weight: 500;
            transition: color 0.2s;
            white-space: nowrap;
        }

        .nav-links a:hover {
            color: var(--beige-600);
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-shrink: 0;
        }

        .user-welcome {
            color: var(--text-medium);
            font-size: 14px;
            margin-right: 8px;
            white-space: nowrap;
        }

        /* ========== BUTTON STYLES ========== */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-login {
            background-color: transparent;
            color: var(--text-dark);
            border: 2px solid var(--beige-300);
        }

        .btn-login:hover {
            background-color: var(--beige-100);
            border-color: var(--beige-400);
        }

        .btn-signup {
            background-color: var(--beige-600);
            color: var(--white);
        }

        .btn-signup:hover {
            background-color: var(--beige-700);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-logout {
            background-color: transparent;
            color: var(--text-dark);
            border: 2px solid var(--beige-300);
        }

        .btn-logout:hover {
            background-color: #fef2f2;
            border-color: var(--danger);
            color: var(--danger);
        }

        .btn-primary {
            background-color: var(--beige-600);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--beige-700);
        }

        .btn-secondary {
            background-color: var(--beige-200);
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background-color: var(--beige-300);
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-success {
            background-color: var(--success);
            color: var(--white);
        }

        .btn-success:hover {
            background-color: #15803d;
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 13px;
        }

        /* ========== ALERT STYLES ========== */
        .alert {
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 24px;
            border: 1px solid transparent;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
        }

        .alert-danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        /* ========== CARD STYLES ========== */
        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-light);
            overflow: hidden;
        }

        .card-header {
            padding: 24px 28px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .card-header h1,
        .card-header h2 {
            margin: 0;
            color: var(--text-dark);
            font-weight: 600;
        }

        .card-header h1 {
            font-size: 28px;
        }

        .card-header h2 {
            font-size: 22px;
        }

        .card-body {
            padding: 28px;
        }

        .card-footer {
            padding: 20px 28px;
            background-color: var(--beige-50);
            border-top: 1px solid var(--border-light);
        }

        /* ========== TABLE STYLES ========== */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid var(--border-light);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
        }

        thead {
            background-color: var(--beige-100);
        }

        thead th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-dark);
            border-bottom: 2px solid var(--beige-300);
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--border-light);
            transition: background-color 0.15s;
        }

        tbody tr:hover {
            background-color: var(--beige-50);
        }

        tbody td {
            padding: 14px 16px;
            color: var(--text-medium);
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        .table-empty {
            text-align: center;
            padding: 48px 20px !important;
            color: var(--text-light);
            font-style: italic;
        }

        .table-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ========== FORM STYLES ========== */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-light);
            border-radius: 8px;
            background: var(--white);
            font-size: 15px;
            transition: all 0.2s ease;
            color: var(--text-dark);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--beige-400);
            box-shadow: 0 0 0 4px rgba(212, 201, 180, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        select.form-control {
            cursor: pointer;
        }

        /* ========== PAGE HEADER STYLES ========== */
        .page-header {
            padding: 32px 0;
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 16px;
            color: var(--text-medium);
        }

        /* ========== SECTION STYLES ========== */
        .section {
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        /* ========== LIST STYLES ========== */
        .list-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .list-item {
            background: var(--white);
            border: 1px solid var(--border-light);
            border-radius: 8px;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .list-item:hover {
            border-color: var(--beige-300);
            box-shadow: var(--shadow-sm);
        }

        .list-item-content {
            flex: 1;
            min-width: 200px;
        }

        .list-item-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .list-item-meta {
            font-size: 13px;
            color: var(--text-light);
        }

        /* ========== BADGE STYLES ========== */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #b45309;
        }

        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
        }

        /* ========== FILTER BAR STYLES ========== */
        .filter-bar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .filter-bar .form-control {
            flex: 1;
            min-width: 200px;
            max-width: 300px;
        }

        /* ========== FOOTER STYLES ========== */
        footer {
            background-color: var(--beige-200);
            padding: 32px 0;
            text-align: center;
            color: var(--text-medium);
            margin-top: auto;
        }

        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 768px) {
            .navbar {
                flex-wrap: wrap;
            }

            .nav-links {
                display: none;
            }

            .logo-text {
                font-size: 20px;
            }

            .page-title {
                font-size: 24px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-body {
                padding: 20px;
            }

            .filter-bar {
                flex-direction: column;
            }

            .filter-bar .form-control {
                max-width: 100%;
            }

            .list-item {
                flex-direction: column;
                align-items: flex-start;
            }

            thead th {
                font-size: 11px;
                padding: 10px 8px;
            }

            tbody td {
                font-size: 13px;
                padding: 10px 8px;
            }

            .btn {
                padding: 8px 14px;
                font-size: 13px;
            }
        }

        /* ========== UTILITY CLASSES ========== */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mt-1 { margin-top: 8px; }
        .mt-2 { margin-top: 16px; }
        .mt-3 { margin-top: 24px; }
        .mb-1 { margin-bottom: 8px; }
        .mb-2 { margin-bottom: 16px; }
        .mb-3 { margin-bottom: 24px; }
        .flex { display: flex; }
        .flex-wrap { flex-wrap: wrap; }
        .gap-2 { gap: 16px; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-book-open logo-icon"></i>
                        <span class="logo-text">CampusReaders</span>
                    </a>
                </div>
                
                @auth
                    <div class="nav-links">
                        <a href="{{ route('catalogue') }}">Book Catalogue</a>
                        <a href="{{ route('profile') }}">My Profile</a>
                        @can('admin')
                            <a href="{{ route('admin') }}">Admin</a>
                        @endcan
                    </div>
                    <div class="auth-buttons">
                        <span class="user-welcome">Welcome, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-logout">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="auth-buttons">
                        <a href="{{ route('login') }}" class="btn btn-login">Log In</a>
                        <a href="{{ route('signup') }}" class="btn btn-signup">Sign Up</a>
                    </div>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container">
            <!-- Display Success/Error Messages -->
            @if(session('success'))
                <div style="margin-top: 24px;">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div style="margin-top: 24px;">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div style="margin-top: 24px;">
                    <div class="alert alert-danger">
                        <div>
                            <i class="fas fa-exclamation-circle"></i>
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 CampusReaders. All rights reserved.</p>
        </div>
    </footer>
@livewireScripts
</body>
</html>