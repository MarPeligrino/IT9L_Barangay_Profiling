@extends('layouts.app') {{-- Or whatever your main layout is --}}

@section('content')
<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="mb-4">
        <h2>Welcome, User</h2>
        <p class="text-muted">Today is {{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
    </div>

    <!-- Quick Access Cards -->
    <div class="row g-3">
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Residents</h5>
                    <p class="card-text">Manage and view all registered residents.</p>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('residents.index') }}" class="text-white text-decoration-none">View &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Addresses</h5>
                    <p class="card-text">Browse and update address records.</p>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('addresses.index') }}" class="text-white text-decoration-none">View &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Barangay Employees</h5>
                    <p class="card-text">View and manage barangay staff.</p>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('barangayemployees.index') }}" class="text-white text-decoration-none">View &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Businesses</h5>
                    <p class="card-text">Track local businesses and types.</p>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('businesses.index') }}" class="text-white text-decoration-none">View &rarr;</a>
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
