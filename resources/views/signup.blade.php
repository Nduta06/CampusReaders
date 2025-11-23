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

        {{-- NEW: Display General Errors (like Database connection issues) --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded border border-red-300">
                <strong>Something went wrong:</strong>
                <ul class="list-disc pl-5 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="signupForm" method="POST" action="/signup">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input-icon">
                    {{-- ADDED: value="{{ old('name') }}" to keep text after error --}}
                    <input type="text" id="name" name="name" class="form-control" 
                           placeholder="Enter your full name" 
                           value="{{ old('name') }}" required>
                    <i>側</i>
                </div>
                {{-- ADDED: Server-side error message --}}
                @error('name')
                    <div class="error-message" style="display:block">{{ $message }}</div>
                @enderror
                <div class="error-message" id="nameError"></div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-icon">
                    <input type="email" id="email" name="email" class="form-control" 
                           placeholder="Enter your email" 
                           value="{{ old('email') }}" required>
                    <i>透</i>
                </div>
                {{-- ADDED: Server-side error message --}}
                @error('email')
                    <div class="error-message" style="display:block">{{ $message }}</div>
                @enderror
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                    <i>白</i>
                </div>
                <div class="password-requirements">
                    Must be at least 8 characters with letters and numbers
                </div>
                {{-- ADDED: Server-side error message --}}
                @error('password')
                    <div class="error-message" style="display:block">{{ $message }}</div>
                @enderror
                <div class="error-message" id="passwordError"></div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-icon">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                    <i>白</i>
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
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        let isValid = true;
        
        // Reset JS error messages
        document.querySelectorAll('.error-message').forEach(el => {
             // Only hide if it's NOT a server error (server errors have specific text)
             if(!el.textContent.includes('taken') && !el.textContent.includes('match')) {
                 el.style.display = 'none';
             }
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
        // NOTE: Ensure this regex matches your own password requirements!
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
        
        if (!isValid) {
            e.preventDefault(); // Stop submission ONLY if JS validation fails
        }
        // If isValid is true, we let the form submit naturally to the server
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