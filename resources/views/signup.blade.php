@extends('layout')

@section('title', 'Sign Up - CampusReaders')

@section('content')
<div class="container" style="max-width: 600px; margin-top: 40px; margin-bottom: 60px;">
    <div class="page-header" style="text-align: center; margin-bottom: 32px;">
        <h1 class="page-title">Create Account</h1>
        <p class="page-subtitle">Join CampusReaders today</p>
    </div>

    <div class="card">
        <div class="card-body" style="padding: 32px;">
            <form method="POST" action="{{ route('signup') }}" id="signupForm">
                @csrf
                
                <!-- Full Name -->
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-light); margin-bottom: 8px; display: block;">Full Name</label>
                    <div style="position: relative;">
                        <i class="fas fa-user" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--beige-600);"></i>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-control" 
                            placeholder="Enter your full name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease;"
                        >
                    </div>
                    <div class="error-message" id="nameError" style="color: #dc3545; font-size: 12px; margin-top: 5px; display: none;"></div>
                </div>

                <!-- Email -->
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-light); margin-bottom: 8px; display: block;">Email Address</label>
                    <div style="position: relative;">
                        <i class="fas fa-envelope" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--beige-600);"></i>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="Enter your email" 
                            value="{{ old('email') }}" 
                            required
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease;"
                        >
                    </div>
                    <div class="error-message" id="emailError" style="color: #dc3545; font-size: 12px; margin-top: 5px; display: none;"></div>
                </div>

                <!-- Role Selection -->
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-light); margin-bottom: 8px; display: block;">Account Type</label>
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
                        <div class="role-option">
                            <input type="radio" id="role_admin" name="role" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }} required>
                            <label for="role_admin" class="role-label">
                                <div class="role-icon">⚙</div>
                                <div class="role-info">
                                    <div class="role-title">Administrator</div>
                                    <div class="role-desc">Full system access and management</div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="error-message" id="roleError" style="color: #dc3545; font-size: 12px; margin-top: 5px; display: none;"></div>
                </div>

                <!-- Password -->
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-light); margin-bottom: 8px; display: block;">Password</label>
                    <div style="position: relative;">
                        <i class="fas fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--beige-600);"></i>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Create a password" 
                            required
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease;"
                        >
                    </div>
                    <div class="error-message" id="passwordError" style="color: #dc3545; font-size: 12px; margin-top: 5px; display: none;"></div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group" style="margin-bottom: 28px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-light); margin-bottom: 8px; display: block;">Confirm Password</label>
                    <div style="position: relative;">
                        <i class="fas fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--beige-600);"></i>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-control" 
                            placeholder="Confirm your password" 
                            required
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease;"
                        >
                    </div>
                    <div class="error-message" id="confirmPasswordError" style="color: #dc3545; font-size: 12px; margin-top: 5px; display: none;"></div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="btn btn-primary" 
                    style="width: 100%; padding: 14px; font-size: 16px; font-weight: 600; margin-bottom: 20px;"
                >
                    Create Account
                </button>

                <!-- Login Prompt -->
                <div style="text-align: center; padding-top: 20px; border-top: 1px solid #e8dfca;">
                    <p style="color: var(--text-light); font-size: 14px; margin: 0;">
                        Already have an account? 
                        <a href="{{ route('login') }}" style="color: var(--beige-600); font-weight: 600; text-decoration: none; margin-left: 4px;">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
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

<style>
    .form-control:focus {
        outline: none;
        border-color: var(--beige-600) !important;
        box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.1);
    }

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
        border-radius: 8px;
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
        border-color: var(--beige-600);
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
        border-radius: 8px;
        color: white;
    }

    .role-info {
        flex: 1;
    }

    .role-title {
        font-weight: 600;
        color: var(--beige-600);
        margin-bottom: 4px;
        font-size: 15px;
    }

    .role-desc {
        font-size: 13px;
        color: var(--text-light);
        line-height: 1.4;
    }

    a:hover {
        color: var(--beige-700) !important;
        text-decoration: underline !important;
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