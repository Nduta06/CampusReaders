@extends('layout')

@section('title', 'Sign Up - CampusReaders')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Create Account</h1>
            <p>Join CampusReaders today</p>
        </div>

        <form method="POST" action="{{ route('signup') }}">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                </div>
            </div>

            <button type="submit" class="btn-auth">Create Account</button>

            <div class="auth-prompt">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </form>
    </div>
</div>
@endsection