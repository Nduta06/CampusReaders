@extends('layout')

@section('title', 'Login - CampusReaders')

@section('content')
<div class="container" style="max-width: 500px; margin-top: 60px; margin-bottom: 60px;">
    <div class="page-header" style="text-align: center; margin-bottom: 32px;">
        <h1 class="page-title">Welcome Back</h1>
        <p class="page-subtitle">Sign in to your CampusReaders account</p>
    </div>

    <div class="card">
        <div class="card-body" style="padding: 32px;">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Address -->
                <div class="form-group" style="margin-bottom: px;">
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
                            autofocus
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease;"
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group" style="margin-bottom: 28px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-light); margin-bottom: 8px; display: block;">Password</label>
                    <div style="position: relative;">
                        <i class="fas fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--beige-600);"></i>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Enter your password" 
                            required
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease;"
                        >
                    </div>
                </div>

                <!-- Forgot Password Link -->
                <div style="text-align: right; margin-bottom: 24px;">
                    <a href="#" style="color: var(--beige-600); font-size: 13px; text-decoration: none; transition: color 0.2s ease;">
                        Forgot your password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="btn btn-primary" 
                    style="width: 100%; padding: 14px; font-size: 16px; font-weight: 600; margin-bottom: 20px;"
                >
                    Sign In
                </button>

                <!-- Sign Up Prompt -->
                <div style="text-align: center; padding-top: 20px; border-top: 1px solid #e8dfca;">
                    <p style="color: var(--text-light); font-size: 14px; margin: 0;">
                        Don't have an account? 
                        <a href="{{ route('signup') }}" style="color: var(--beige-600); font-weight: 600; text-decoration: none; margin-left: 4px;">
                            Sign up here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        outline: none;
        border-color: var(--beige-600) !important;
        box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.1);
    }

    a:hover {
        color: var(--beige-700) !important;
        text-decoration: underline !important;
    }
</style>
@endsection