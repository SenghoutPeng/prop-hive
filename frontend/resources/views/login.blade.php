@extends('layouts.app')

@section('title', 'Login - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <div class="login-form-container">
                    <h2>Welcome Back</h2>
                    <p>Sign in to your account to continue</p>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="auth-form" method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="form-group">
                            <label for="user_email">Email Address *</label>
                            <input type="email" id="user_email" name="user_email" value="{{ old('user_email') }}" required>
                            @error('user_email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" required>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-options">
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                Remember me
                            </label>
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Log in</button>
                    </form>
                </div>
                
                <div class="login-image">
                    <img src="{{ asset('image/photo_6141044952965170157_y.jpg') }}" alt="Login">
                </div>
            </div>
        </div>
    </section>
@endsection 