@extends('layouts.app')

@section('content')
<style>
    .dashboard-btn:hover {
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 4px;
        transition: background-color 0.2s ease;
    }

    .card-footer {
        background-color: transparent;
        border-top: none;
    }
</style>

<div class="container-fluid">
    <div class="mb-4">
        <h2>Welcome, User!</h2>
        <p class="text-muted">Today is {{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
    </div>

    <div class="row g-3">
        <!-- Residents -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold">{{ $residentsCount }}</h2>
                        <p class="mb-0">Total Residents</p>
                    </div>
                    <i class="bi bi-person-plus-fill fs-1 text-white-50"></i>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('residents.index') }}" class="text-white text-decoration-none px-2 py-1 dashboard-btn">
                        More info <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Addresses -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold">{{ $addressCount }}</h2>
                        <p class="mb-0">Total Addresses</p>
                    </div>
                    <i class="bi bi-geo-alt-fill fs-1 text-white-50"></i>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('addresses.index') }}" class="text-white text-decoration-none px-2 py-1 dashboard-btn">
                        More info <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Employees -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold">{{ $employeeCount }}</h2>
                        <p class="mb-0">Barangay Employees</p>
                    </div>
                    <i class="bi bi-person-badge-fill fs-1 text-white-50"></i>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('barangayemployees.index') }}" class="text-white text-decoration-none px-2 py-1 dashboard-btn">
                        More info <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Businesses -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold">{{ $businessCount }}</h2>
                        <p class="mb-0">Registered Businesses</p>
                    </div>
                    <i class="bi bi-briefcase-fill fs-1 text-white-50"></i>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('businesses.index') }}" class="text-white text-decoration-none px-2 py-1 dashboard-btn">
                        More info <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-5">
        <h4>Recent Activity</h4>
        <ul class="list-group">
            <li class="list-group-item">John Doe was added as a resident on May 10, 2025</li>
            <li class="list-group-item">New business registered: Sari-Sari Store</li>
            <li class="list-group-item">Address record updated for Purok 5, Zone 2</li>
        </ul>
    </div>
</div>
@endsection
