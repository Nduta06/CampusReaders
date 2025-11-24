<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f1e6 0%, #e8dfca 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: #fffaf0;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(175, 150, 120, 0.15);
            width: 100%;
            max-width: 420px;
            border: 1px solid #e8dfca;
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header h1 {
            color: #8b7355;
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #a08c6c;
            font-size: 14px;
        }

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

        .btn-login {
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

        .btn-login:hover {
            background: linear-gradient(135deg, #8b7355 0%, #756045 100%);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(139, 115, 85, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e8dfca;
        }

        .login-footer a {
            color: #a08c6c;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
            margin: 0 10px;
        }

        .login-footer a:hover {
            color: #8b7355;
            text-decoration: underline;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

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

        .signup-prompt {
            text-align: center;
            margin-top: 20px;
            color: #a08c6c;
            font-size: 14px;
        }

        .signup-prompt a {
            color: #8b7355;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-prompt a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 25px;
            }
            
            .login-header h1 {
                font-size: 24px;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <div class="logo-circle">L</div>
        </div>
        
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Sign in to your library account</p>
        </div>

        <form action="/login" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-icon">
                    <i>👤</i>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           class="form-control" 
                           placeholder="Enter your username" 
                           required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <i>🔒</i>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Enter your password" 
                           required>
                </div>
            </div>

            <button type="submit" class="btn-login">Sign In</button>
        </form>

        <!-- ADDED: Sign up prompt -->
        <div class="signup-prompt">
            Don't have an account? <a href="/signup">Sign up here</a>
        </div>

        <div class="login-footer">
            <div class="footer-links">
                <a href="#">Forgot your password?</a>
            </div>
        </div>
    </div>

    <script>
        // Simple form validation and interaction
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = document.querySelectorAll('.form-control');
            
            // Add focus effects
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
            
            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                
                // Basic validation
                if (username.trim() === '' || password.trim() === '') {
                    alert('Please fill in all fields');
                    return;
                }
                
                // Here you would typically send the data to your server
                console.log('Login attempt:', { username, password });
                
                // Simulate login process
                const button = document.querySelector('.btn-login');
                button.textContent = 'Signing In...';
                button.disabled = true;
                
                setTimeout(() => {
                    button.textContent = 'Sign In';
                    button.disabled = false;
                    alert('Login functionality would be implemented here');
                }, 1500);
            });
        });
    </script>
</body>
</html>
