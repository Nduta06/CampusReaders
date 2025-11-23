<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CampusReaders - Library Management System')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --beige: #f5f1e8;
            --dark-beige: #e8e2d1;
            --accent-beige: #d4c9b4;
            --white: #ffffff;
            --text-dark: #3a3a3a;
            --text-light: #5a5a5a;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: var(--beige);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            color: var(--accent-beige);
            font-size: 28px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--accent-beige);
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-login {
            background-color: transparent;
            color: var(--text-dark);
            border: 1px solid var(--accent-beige);
        }

        .btn-login:hover {
            background-color: var(--dark-beige);
        }

        .btn-signup {
            background-color: var(--accent-beige);
            color: var(--text-dark);
        }

        .btn-signup:hover {
            background-color: var(--dark-beige);
            transform: translateY(-2px);
        }

        .btn-logout {
            background-color: transparent;
            color: var(--text-dark);
            border: 1px solid var(--accent-beige);
        }

        .btn-logout:hover {
            background-color: #ffeaea;
        }

        /* Auth Container Styles */
        .auth-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding: 20px;
        }

        .auth-card {
            background: var(--white);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 420px;
            border: 1px solid var(--dark-beige);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .auth-header h1 {
            color: var(--text-dark);
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: var(--text-light);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
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
            padding: 14px 16px;
            border: 2px solid var(--dark-beige);
            border-radius: 12px;
            background: var(--white);
            font-size: 15px;
            transition: all 0.3s ease;
            color: var(--text-dark);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-beige);
            box-shadow: 0 0 0 3px rgba(212, 201, 180, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        .btn-auth {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--accent-beige) 0%, #8b7355 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-auth:hover {
            background: linear-gradient(135deg, #8b7355 0%, #756045 100%);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(139, 115, 85, 0.3);
        }

        .auth-prompt {
            text-align: center;
            margin-top: 20px;
            color: var(--text-light);
            font-size: 14px;
        }

        .auth-prompt a {
            color: var(--accent-beige);
            text-decoration: none;
            font-weight: 500;
        }

        .auth-prompt a:hover {
            text-decoration: underline;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .input-icon .form-control {
            padding-left: 45px;
        }

        /* Alert Styles */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .alert-danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #16a34a;
        }

        /* Main Content Area */
        main {
            flex: 1;
        }

        /* Footer */
        footer {
            background-color: var(--dark-beige);
            padding: 40px 0;
            text-align: center;
            color: var(--text-light);
            margin-top: auto;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
        }

        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--text-dark);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 10px;
            }

            .auth-card {
                padding: 30px 25px;
            }
            
            .auth-header h1 {
                font-size: 24px;
            }
        }
    </style>
    
    <!-- Page-specific CSS -->
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <a href="{{ url('/') }}" style="text-decoration: none; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-book-open logo-icon"></i>
                        <span class="logo-text">CampusReaders</span>
                    </a>
                </div>
                
                @auth
                    <div class="nav-links">
                        <a href="{{ route('bookcatalogue') }}">Book Catalogue</a>
                        <a href="{{ route('profile') }}">My Profile</a>
                        @can('admin')
                            <a href="{{ route('admin') }}">Admin</a>
                        @endcan
                    </div>
                    <div class="auth-buttons">
                        <span style="color: var(--text-light); margin-right: 15px;">Welcome, {{ Auth::user()->name }}</span>
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
        <!-- Display Success/Error Messages -->
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="container">
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 CampusReaders. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>