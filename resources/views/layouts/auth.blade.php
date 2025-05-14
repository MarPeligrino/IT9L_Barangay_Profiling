<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barangay Profiling System')</title>
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
        .auth-container {
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
        .form-group input[type="password"],
        .form-group input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        .checkbox-group label {
            margin: 0;
        }
        .btn-action {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-action:hover {
            background-color: #218838;
        }
        .link {
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        .text-danger {
            color: #dc3545;
            font-size: 0.875em;
        }
        .alert {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <img src="/images/catgrandelogo.jpg" alt="Barangay Logo" class="logo">
        <div class="title">@yield('page-title', 'Brgy. Profiling Cat Grande')</div>
        @yield('content')
    </div>
</body>
</html>