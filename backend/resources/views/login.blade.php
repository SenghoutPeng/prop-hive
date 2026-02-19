@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 400px; margin: 40px auto;">
    <h2 class="mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus value="{{ old('email') }}">
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group mb-3">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection 