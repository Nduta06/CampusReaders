<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Library System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f1e8 0%, #e8dfca 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signup-container {
            background: #fffaf0;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(139, 69, 19, 0.1);
            width: 100%;
            max-width: 450px;
            border: 1px solid #e8dfca;
        }

        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-header h1 {
            color: #8b4513;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .signup-header p {
            color: #a0522d;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #8b4513;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e8dfca;
            border-radius: 8px;
            background: #fffaf0;
            font-size: 14px;
            transition: all 0.3s ease;
            color: #8b4513;
        }

        .form-control:focus {
            outline: none;
            border-color: #d4a574;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        }

        .form-control::placeholder {
            color: #c8b8a0;
        }

        .btn-signup {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #d4a574 0%, #b08968 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-signup:hover {
            background: linear-gradient(135deg, #b08968 0%, #8b4513 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 69, 19, 0.2);
        }

        .btn-signup:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #a0522d;
            font-size: 14px;
        }

        .login-link a {
            color: #8b4513;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #d4a574;
        }

        .password-requirements {
            font-size: 12px;
            color: #a0522d;
            margin-top: 5px;
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        @media (max-width: 480px) {
            .signup-container {
                padding: 30px 20px;
            }
            
            .signup-header h1 {
                font-size: 24px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="signup-container">
        <div class="signup-header">
            <h1>Create Account</h1>
            <p>Join our library community today</p>
        </div>

        <form id="signupForm">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-icon">
                    <input type="text" id="username" class="form-control" placeholder="Enter your username" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="error-message" id="usernameError"></div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-icon">
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <input type="password" id="password" class="form-control" placeholder="Create a password" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="password-requirements">
                    Must be at least 8 characters with letters and numbers
                </div>
                <div class="error-message" id="passwordError"></div>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <div class="input-icon">
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm your password" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="error-message" id="confirmPasswordError"></div>
            </div>

            <button type="submit" class="btn-signup">Create Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.html">Sign in</a>
        </div>
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            let isValid = true;
            
            // Reset error messages
            document.querySelectorAll('.error-message').forEach(el => {
                el.style.display = 'none';
            });
            
            // Username validation
            if (username.length < 3) {
                document.getElementById('usernameError').textContent = 'Username must be at least 3 characters long';
                document.getElementById('usernameError').style.display = 'block';
                isValid = false;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address';
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            }
            
            // Password validation
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d).{8,}$/;
            if (!passwordRegex.test(password)) {
                document.getElementById('passwordError').textContent = 'Password must be at least 8 characters with letters and numbers';
                document.getElementById('passwordError').style.display = 'block';
                isValid = false;
            }
            
            // Confirm password validation
            if (password !== confirmPassword) {
                document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
                document.getElementById('confirmPasswordError').style.display = 'block';
                isValid = false;
            }
            
            if (isValid) {
                // Form is valid, you can submit it here
                alert('Account created successfully!');
                // this.submit(); // Uncomment to actually submit the form
            }
        });

        // Real-time validation
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const errorElement = document.getElementById('confirmPasswordError');
            
            if (password !== confirmPassword && confirmPassword.length > 0) {
                errorElement.textContent = 'Passwords do not match';
                errorElement.style.display = 'block';
            } else {
                errorElement.style.display = 'none';
            }
        });

        // Add focus effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    </script>
</body>
</html>