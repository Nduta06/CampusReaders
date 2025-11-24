@extends('layout')

@section('title', 'Login - CampusReaders')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Welcome Back</h1>
            <p>Sign in to your CampusReaders account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>

            <button type="submit" class="btn-auth">Sign In</button>

        <!-- ADDED: Sign up prompt -->
        <div class="signup-prompt">
            Don't have an account? <a href="/signup">Sign up here</a>
        </div>

        <div class="login-footer">
            <div class="footer-links">
                <a href="#">Forgot your password?</a>
            </div>
        </form>
    </div>
</div>
@endsection