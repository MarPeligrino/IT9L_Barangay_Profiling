<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Profiling System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            height: 100vh;
            background-color: #0d6efd;
            padding-top: 1rem;
            width: 220px;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link:hover {
            background-color: #0b5ed7;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .collapsed-sidebar {
            width: 0 !important;
            padding: 0 !important;
        }

        .collapsed-content {
            margin-left: 0 !important;
        }

        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 230px;
            z-index: 1051;
            transition: left 0.3s ease;
        }

        .collapsed-sidebar ~ .toggle-btn {
            left: 10px !important;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="text-white text-center mb-4">Barangay Profiling</h4>
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('residents.index') }}">Residents</a>
            <a class="nav-link" href="{{ route('addresses.index') }}">Addresses</a>
            <a class="nav-link" href="{{ route('familyroles.index') }}">FamilyRoles</a>
            <a class="nav-link" href="{{ route('barangaypositions.index') }}">BarangayPosition</a>
            <a class="nav-link" href="{{ route('barangayemployees.index') }}">BarangayEmployee</a>
            <a class="nav-link" href="{{ route('businesses.index') }}">Business</a>
            <a class="nav-link" href="{{ route('businessTypes.index') }}">BusinessType</a>
        </nav>
    </div>

    <!-- Toggle Button -->
    <button class="btn btn-light toggle-btn" id="sidebarToggle">☰</button>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed-sidebar');
            mainContent.classList.toggle('collapsed-content');

            if (sidebar.classList.contains('collapsed-sidebar')) {
                toggleBtn.style.left = '10px';
            } else {
                toggleBtn.style.left = '230px';
            }
        });
    </script>

</body>
</html>
