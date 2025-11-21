@extends('layout')

@section('title', 'Sign Up - Library System')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="logo">
            <div class="logo-circle">L</div>
        </div>
        
        <div class="auth-header">
            <h1>Create Account</h1>
            <p>Join our library community today</p>
        </div>

        <form id="signupForm" method="POST" action="/signup">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input-icon">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                    <i>👤</i>
                </div>
                <div class="error-message" id="nameError"></div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-icon">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                    <i>📧</i>
                </div>
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                    <i>🔒</i>
                </div>
                <div class="password-requirements">
                    Must be at least 8 characters with letters and numbers
                </div>
                <div class="error-message" id="passwordError"></div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-icon">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                    <i>🔒</i>
                </div>
                <div class="error-message" id="confirmPasswordError"></div>
            </div>

            <button type="submit" class="btn-auth">Create Account</button>
        </form>

        <div class="auth-prompt">
            Already have an account? <a href="/login">Sign in</a>
        </div>
    </div>
</div>

<script>
    document.getElementById('signupForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        let isValid = true;
        
        // Reset error messages
        document.querySelectorAll('.error-message').forEach(el => {
            el.style.display = 'none';
        });
        
        // Name validation
        if (name.length < 3) {
            document.getElementById('nameError').textContent = 'Name must be at least 3 characters long';
            document.getElementById('nameError').style.display = 'block';
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
            // Form is valid, submit it
            this.submit();
        }
    });

    // Real-time validation
    document.getElementById('password_confirmation').addEventListener('input', function() {
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
</script>
@endsection