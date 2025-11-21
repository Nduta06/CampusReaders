<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Library System</title>
    
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

// 