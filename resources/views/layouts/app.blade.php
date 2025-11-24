<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'CampusReaders | Dashboard')</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}" />
    
    <style>
        :root {
            --beige-50: #faf8f3;
            --beige-100: #f5f1e8;
            --beige-200: #e8dfca;
            --beige-300: #d4c9b4;
            --beige-600: #8b7355;
            --beige-700: #756045;
            --text-dark: #3a3a3a;
            --text-medium: #5a5a5a;
            --text-light: #8a8a8a;
            --sidebar-bg: #23272b;
            --sidebar-hover: #2c3034;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background: var(--beige-200) !important;
            font-family: 'Source Sans 3', 'Segoe UI', sans-serif;
        }

        .app-flex-wrapper {
            display: flex;
            min-height: 100vh;
            background: var(--beige-200);
        }

        /* ========== SIDEBAR STYLES ========== */
        .app-sidebar {
            width: 260px;
            min-width: 260px;
            max-width: 260px;
            height: 100vh;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 100;
            background: var(--sidebar-bg);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand .brand-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-brand img {
            max-height: 52px;
            width: auto;
            filter: brightness(0) invert(1);
            opacity: 0.9;
        }

        .sidebar-brand-text {
            color: var(--beige-100);
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .sidebar-wrapper {
            padding: 16px 0;
        }

        .nav-header {
            padding: 16px 20px 8px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 600;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu .nav-item {
            margin: 0;
        }

        .sidebar-menu .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            padding: 12px 20px;
            color: #e0e0e0;
            background: transparent;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .sidebar-menu .nav-link .nav-icon {
            font-size: 18px;
            min-width: 24px;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            transition: color 0.2s;
        }

        .sidebar-menu .nav-link span {
            flex: 1;
            transition: color 0.2s;
        }

        .sidebar-menu .nav-link:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
            border-left-color: var(--beige-300);
        }

        .sidebar-menu .nav-link:hover .nav-icon {
            color: var(--beige-300);
        }

        .sidebar-menu .nav-link.active {
            background: rgba(245, 233, 215, 0.1);
            color: #ffffff;
            border-left-color: var(--beige-300);
            font-weight: 600;
        }

        .sidebar-menu .nav-link.active .nav-icon {
            color: var(--beige-300);
        }

        /* ========== MAIN CONTENT STYLES ========== */
        .app-main {
            flex: 1;
            padding: 32px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--beige-200);
        }

        .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 24px;
        }

        /* ========== ALERT STYLES ========== */
        .alert {
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 24px;
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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

        .alert-dismissible .btn-close {
            background: transparent;
            border: none;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.2s;
        }

        .alert-dismissible .btn-close:hover {
            opacity: 1;
        }

        /* ========== CARD STYLES ========== */
        .card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(90, 74, 58, 0.06);
            border: 1px solid rgba(228, 223, 213, 0.5);
            overflow: hidden;
        }

        .card.p-4 {
            padding: 28px;
        }

        /* ========== FOOTER STYLES ========== */
        .app-footer {
            margin-top: auto;
            background: #fff;
            border-top: 1px solid var(--beige-300);
            padding: 20px 32px;
            color: var(--text-medium);
            font-size: 14px;
            text-align: center;
        }

        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 768px) {
            .app-sidebar {
                width: 220px;
                min-width: 220px;
                max-width: 220px;
            }

            .app-main {
                padding: 20px 16px;
            }

            .page-title {
                font-size: 24px;
            }

            .sidebar-menu .nav-link {
                padding: 10px 16px;
                font-size: 14px;
            }

            .nav-header {
                padding: 12px 16px 6px;
            }
        }
    </style>
</head>
<body>
    <div class="app-flex-wrapper">
        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')
        
        {{-- Main Content --}}
        <main class="app-main">
            <div class="container-fluid">
                <h2 class="page-title">@yield('title', 'Admin Panel')</h2>
                
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
                    </div>
                @endif
                
                <div class="card p-4">
                    @yield('content')
                </div>
            </div>
            
            {{-- Footer --}}
            @include('layouts.partials.footer')
        </main>
    </div>
    
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('adminlte/js/adminlte.js') }}"></script>
    
    {{-- Page-specific scripts --}}
    @stack('scripts')
</body>
</html>