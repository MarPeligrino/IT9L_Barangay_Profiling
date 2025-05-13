<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Barangay Profiling System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('/images/barangaycatgrande.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .reset-container {
            background: rgba(0, 0, 0, 0.98);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .logo {
            max-width: 100px; 
            height: 100px; 
            border-radius: 50%; 
            object-fit: cover; 
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #007bff;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .btn-reset {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-reset:hover {
            background-color: #218838;
        }
        .text-danger {
            color: #dc3545;
            font-size: 0.875em;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <img src="/images/catgrandelogo.jpg" alt="Barangay Logo" class="logo">
        <div class="title">Reset Password</div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <button type="submit" class="btn-reset">Reset Password</button>
        </form>
    </div>
</body>
</html>