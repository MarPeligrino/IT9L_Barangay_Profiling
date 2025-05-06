<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Profiling System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Barangay Profiling</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('residents.index') }}">Residents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('households.index') }}">Households</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('familyroles.index') }}">FamilyRoles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('barangaypositions.index') }}">BarangayPosition</a>
                    </li>
                    
                    <!-- Add more nav links here if needed -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
