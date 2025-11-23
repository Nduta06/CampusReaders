<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library System')</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f1e6 0%, #e8dfca 100%);
            min-height: 100vh;
            color: #5a4a3a;
            line-height: 1.6;
        }

        /* Common Container Styles */
        .auth-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding: 20px;
        }

        .auth-card {
            background: #fffaf0;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(175, 150, 120, 0.15);
            width: 100%;
            max-width: 420px;
            border: 1px solid #e8dfca;
        }

        /* Header Styles */
        .auth-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .auth-header h1 {
            color: #8b7355;
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: #a08c6c;
            font-size: 14px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #8b7355;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e8dfca;
            border-radius: 12px;
            background: #fffaf0;
            font-size: 15px;
            transition: all 0.3s ease;
            color: #5a4a3a;
        }

        .form-control:focus {
            outline: none;
            border-color: #c8b8a0;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(200, 184, 160, 0.1);
        }

        .form-control::placeholder {
            color: #b8a995;
        }

        /* Button Styles */
        .btn-auth {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #a08c6c 0%, #8b7355 100%);
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

        .btn-auth:active {
            transform: translateY(0);
        }

        /* Link and Prompt Styles */
        .auth-prompt {
            text-align: center;
            margin-top: 20px;
            color: #a08c6c;
            font-size: 14px;
        }

        .auth-prompt a {
            color: #8b7355;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-prompt a:hover {
            text-decoration: underline;
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e8dfca;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .footer-links a {
            color: #a08c6c;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #8b7355;
            text-decoration: underline;
        }

        /* Input Icon Styles */
        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b8a995;
        }

        .input-icon .form-control {
            padding-left: 45px;
        }

        /* Logo Styles */
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #a08c6c 0%, #8b7355 100%);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        /* Error and Helper Text Styles */
        .password-requirements {
            font-size: 12px;
            color: #a08c6c;
            margin-top: 5px;
            margin-left: 5px;
        }

        .error-message {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 5px;
            margin-left: 5px;
            display: none;
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

        /* Responsive Design */
        @media (max-width: 480px) {
            .auth-card {
                padding: 30px 25px;
            }
            
            .auth-header h1 {
                font-size: 24px;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
            
            .form-control {
                padding: 12px 14px;
            }
            
            .btn-auth {
                padding: 12px;
            }
        }

        /* Focus Animations */
        .input-icon {
            transition: transform 0.2s ease;
        }

        .form-control:focus + i,
        .input-icon:hover {
            transform: scale(1.02);
        }
    </style>
    
    <!-- Page-specific CSS -->
    @yield('styles')
</head>
<body>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Page-specific Scripts -->
    @yield('scripts')
</body>
</html>