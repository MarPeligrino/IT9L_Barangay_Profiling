<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Barangay Profiling System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>

  <style>
    body {
      overflow-x: hidden;
    }

    #sidebarToggle {
      background-color: #0d6efd;
      color: white;
      border: none;
      font-size: 1.25rem;
      transition: transform 0.3s ease;
    }

    #sidebarToggle.rotated {
      transform: rotate(90deg);
    }

    .sidebar {
      height: 100vh;
      background-color: #0d6efd;
      padding-top: 1rem;
      width: 220px;
      transition: all 0.3s ease;
      position: fixed;
      top: 56px;
      left: 0;
      z-index: 1000;
      overflow-x: hidden;
    }

    .sidebar .nav-link {
      color: white;
      padding: 0.5rem 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      white-space: nowrap;
    }

    .sidebar .nav-link span {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .sidebar .nav-link:hover {
      background-color: #0b5ed7;
    }

    .sidebar .nav-link.active {
      background-color: #084cd9;
      font-weight: bold;
    }

    .sidebar .section-title {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.75rem;
      padding: 0.5rem 1rem;
      text-transform: uppercase;
    }

    .main-content {
      margin-left: 220px;
      padding: 20px;
      margin-top: 56px;
      transition: all 0.3s ease;
    }

    .collapsed-sidebar {
      width: 0 !important;
      padding: 0 !important;
      overflow: hidden;
      pointer-events: none;
      opacity: 0;
    }

    .collapsed-content {
      margin-left: 0 !important;
    }

    .arrow-icon {
      transition: transform 0.3s ease;
    }

    .nav-link[aria-expanded="true"] .arrow-icon {
      transform: rotate(90deg);
    }

    .submenu .nav-link {
      padding-left: 2.5rem;
      justify-content: flex-start;
    }

    .submenu .nav-link span {
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>
</head>
<body>
  <!-- Top Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-3 fixed-top">
    <button class="btn me-2" id="sidebarToggle">☰</button>
    <a class="navbar-brand mb-0 h1" href="{{ route('dashboard') }}">Barangay Profiling</a>

    <div class="ms-auto d-flex align-items-center">
      <span class="text-white me-3">Welcome User</span>
      <div class="dropdown">
        <a href="#" class="text-white dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-gear-fill fs-5"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
          <li><a class="dropdown-item" href="#">Open Profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <nav class="nav flex-column">
      <!-- Dashboard Section -->
      <div class="section-title">Dashboard</div>
      <a class="nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <span><i class="bi bi-house-door-fill"></i> Home</span>
      </a>

      <!-- Barangay Info -->
      @php
        $barangayActive = Request::is('residents*') || Request::is('addresses*') || Request::is('familyroles*');
      @endphp
      <a class="nav-link {{ $barangayActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#barangayInfoMenu" role="button" aria-expanded="{{ $barangayActive ? 'true' : 'false' }}" aria-controls="barangayInfoMenu">
        <span><i class="bi bi-info-circle-fill"></i> Barangay Info</span>
        <i class="bi bi-chevron-right arrow-icon"></i>
      </a>
      <div class="collapse submenu {{ $barangayActive ? 'show' : '' }}" id="barangayInfoMenu">
        <a class="nav-link {{ Request::is('residents*') ? 'active' : '' }}" href="{{ route('residents.index') }}"><span>Residents</span></a>
        <a class="nav-link {{ Request::is('addresses*') ? 'active' : '' }}" href="{{ route('addresses.index') }}"><span>Addresses</span></a>
        <a class="nav-link {{ Request::is('familyroles*') ? 'active' : '' }}" href="{{ route('familyroles.index') }}"><span>Family Roles</span></a>
      </div>

      <!-- Barangay Officials -->
      @php
        $officialsActive = Request::is('barangaypositions*') || Request::is('barangayemployees*');
      @endphp
      <a class="nav-link {{ $officialsActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#officialsMenu" role="button" aria-expanded="{{ $officialsActive ? 'true' : 'false' }}" aria-controls="officialsMenu">
        <span><i class="bi bi-person-badge-fill"></i> Barangay Officials</span>
        <i class="bi bi-chevron-right arrow-icon"></i>
      </a>
      <div class="collapse submenu {{ $officialsActive ? 'show' : '' }}" id="officialsMenu">
        <a class="nav-link {{ Request::is('barangaypositions*') ? 'active' : '' }}" href="{{ route('barangaypositions.index') }}"><span>Positions</span></a>
        <a class="nav-link {{ Request::is('barangayemployees*') ? 'active' : '' }}" href="{{ route('barangayemployees.index') }}"><span>Employees</span></a>
      </div>

      <!-- Business Section -->
      <div class="section-title mt-3">Business</div>
      <a class="nav-link {{ Request::is('businesses*') ? 'active' : '' }}" href="{{ route('businesses.index') }}">
        <span><i class="bi bi-building"></i> Business</span>
      </a>
      <a class="nav-link {{ Request::is('businessTypes*') ? 'active' : '' }}" href="{{ route('businessTypes.index') }}">
        <span><i class="bi bi-tags-fill"></i> Business Types</span>
      </a>
    </nav>
  </div>

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
      toggleBtn.classList.toggle('rotated');
    });
  </script>
</body>
</html>
