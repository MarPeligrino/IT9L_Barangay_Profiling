@extends('layouts.auth')

@section('title', 'Forgot Password - Barangay Profiling System')

@section('page-title', 'Forgot Password')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <p>Enter your email address and we'll send you a link to reset your password.</p>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn-action">Send Password Reset Link</button>
    </form>
@endsection