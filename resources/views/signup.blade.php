@extends('layout')

@section('title', 'Sign Up - CampusReaders')

@section('content')
<div class="auth-container">
    <div class="auth-card">

        <div class="auth-header">
            <h1>Create Account</h1>
            <p>Join CampusReaders today</p>
        </div>

        <form method="POST" action="{{ route('signup') }}" id="signupForm">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required autofocus>
                </div>
                <div class="error-message" id="nameError"></div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>
                <div class="error-message" id="emailError"></div>
            </div>

            <!-- Role Selection -->
            <div class="form-group">
                <label for="role">Account Type</label>
                <div class="role-selection">
                    <div class="role-option">
                        <input type="radio" id="role_student" name="role" value="student" {{ old('role') == 'student' ? 'checked' : '' }} required>
                        <label for="role_student" class="role-label">
                            <div class="role-icon">🎓</div>
                            <div class="role-info">
                                <div class="role-title">Student</div>
                                <div class="role-desc">Borrow books, make reservations</div>
                            </div>
                        </label>
                    </div>
                    <div class="role-option">
                        <input type="radio" id="role_staff" name="role" value="staff" {{ old('role') == 'staff' ? 'checked' : '' }} required>
                        <label for="role_staff" class="role-label">
                            <div class="role-icon">👨‍💼</div>
                            <div class="role-info">
                                <div class="role-title">Staff</div>
                                <div class="role-desc">Manage books and library operations</div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="error-message" id="roleError"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                </div>
                <div class="error-message" id="passwordError"></div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                </div>
                <div class="error-message" id="confirmPasswordError"></div>
            </div>

            <button type="submit" class="btn-auth">Create Account</button>

            <div class="auth-prompt">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('signupForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const roleSelected = document.querySelector('input[name="role"]:checked');
        
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
        
        // Role validation
        if (!roleSelected) {
            document.getElementById('roleError').textContent = 'Please select an account type';
            document.getElementById('roleError').style.display = 'block';
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

    // Real-time validation for password confirmation
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

    // Real-time password strength validation
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const errorElement = document.getElementById('passwordError');
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d).{8,}$/;
        
        if (!passwordRegex.test(password) && password.length > 0) {
            errorElement.textContent = 'Password must be at least 8 characters with letters and numbers';
            errorElement.style.display = 'block';
        } else {
            errorElement.style.display = 'none';
        }
    });

    // Role selection styling and validation
    document.querySelectorAll('.role-option input').forEach(radio => {
        // Set initial selected state based on checked status
        if (radio.checked) {
            radio.closest('.role-option').classList.add('selected');
        }
        
        radio.addEventListener('change', function() {
            // Remove selected class from all options
            document.querySelectorAll('.role-option').forEach(option => {
                option.classList.remove('selected');
            });
            // Add selected class to current option
            this.closest('.role-option').classList.add('selected');
            // Clear role error
            document.getElementById('roleError').style.display = 'none';
        });
    });
</script>
@endsection

@section('styles')
<style>
    .role-selection {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .role-option {
        position: relative;
    }

    .role-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .role-label {
        display: flex;
        align-items: center;
        padding: 16px;
        border: 2px solid #e8dfca;
        border-radius: 12px;
        background: #fffaf0;
        cursor: pointer;
        transition: all 0.3s ease;
        gap: 15px;
    }

    .role-label:hover {
        border-color: #c8b8a0;
        background: #fff;
        transform: translateY(-1px);
    }

    .role-option.selected .role-label {
        border-color: #8b7355;
        background: #f9f5eb;
        box-shadow: 0 4px 12px rgba(139, 115, 85, 0.15);
    }

    .role-icon {
        font-size: 24px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #a08c6c 0%, #8b7355 100%);
        border-radius: 10px;
        color: white;
    }

    .role-info {
        flex: 1;
    }

    .role-title {
        font-weight: 600;
        color: #8b7355;
        margin-bottom: 4px;
        font-size: 15px;
    }

    .role-desc {
        font-size: 13px;
        color: #a08c6c;
        line-height: 1.4;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
        display: none;
    }

    /* Responsive design for role selection */
    @media (max-width: 480px) {
        .role-label {
            padding: 14px;
            gap: 12px;
        }

        .role-icon {
            font-size: 20px;
            width: 36px;
            height: 36px;
        }

        .role-title {
            font-size: 14px;
        }

        .role-desc {
            font-size: 12px;
        }
    }
</style>
@endsection