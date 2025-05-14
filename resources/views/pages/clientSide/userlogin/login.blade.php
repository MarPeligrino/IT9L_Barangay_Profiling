@extends('layouts.auth')

@section('title', 'Sign In - Barangay Profiling System')

@section('page-title', 'Brgy. Profiling Cat Grande')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group checkbox-group">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Remember Me!</label>
        </div>
        <button type="submit" class="btn-action">LOG IN</button>
        <a href="{{ route('password.request') }}" class="link">Forgot Password?</a>
        <a href="{{ route('register') }}" class="link">Don't have an account? Sign up</a>
    </form>
@endsection