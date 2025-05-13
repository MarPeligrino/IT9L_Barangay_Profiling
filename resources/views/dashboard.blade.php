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

    .quick-actions .btn {
        min-width: 180px;
    }
</style>

<div class="container-fluid">
    <!-- Welcome -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Welcome, User!</h2>
            <p class="text-muted">Today is {{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3">
        <!-- Residents -->
        <x-dashboard.card count="{{ $residentsCount }}" label="Total Residents" icon="person-plus-fill" color="primary" route="residents.index" />

        <!-- Addresses -->
        <x-dashboard.card count="{{ $addressCount }}" label="Total Addresses" icon="geo-alt-fill" color="success" route="addresses.index" />

        <!-- Barangay Employees -->
        <x-dashboard.card count="{{ $employeeCount }}" label="Barangay Employees" icon="person-badge-fill" color="warning" route="barangayemployees.index" />

        <!-- Businesses -->
        <x-dashboard.card count="{{ $businessCount }}" label="Registered Businesses" icon="briefcase-fill" color="danger" route="businesses.index" />

        <!-- Family Roles -->
        <x-dashboard.card count="{{ $roleCount }}" label="Family Roles" icon="people-fill" color="secondary" route="familyroles.index" />

        <!-- Barangay Positions -->
        <x-dashboard.card count="{{ $positionCount }}" label="Barangay Positions" icon="clipboard-data-fill" color="info" route="barangaypositions.index" />

        <!-- Business Types -->
        <x-dashboard.card count="{{ $businessTypeCount }}" label="Business Types" icon="tags-fill" color="dark" route="businessTypes.index" />

        <!-- Business Permits -->
        <x-dashboard.card count="{{ $permitCount }}" label="Permits Issued" icon="file-earmark-text-fill" color="primary" route="businessPermits.index" />

        <!-- Transactions -->
        <x-dashboard.card count="{{ $transactionCount }}" label="Permit Transactions" icon="receipt-cutoff" color="success" route="permitTransactions.index" />
    </div>

    <!-- Quick Actions -->
    <div class="mt-5">
        <h4>Quick Actions</h4>
        <div class="d-flex flex-wrap gap-3 quick-actions">
            <a href="{{ route('residents.create') }}" class="btn btn-outline-primary"><i class="bi bi-person-plus-fill me-1"></i> Add Resident</a>
            <a href="{{ route('businesses.create') }}" class="btn btn-outline-success"><i class="bi bi-building me-1"></i> Add Business</a>
            <a href="{{ route('businessPermits.create') }}" class="btn btn-outline-warning"><i class="bi bi-file-earmark-plus me-1"></i> Issue Permit</a>
            <a href="{{ route('permitTransactions.index') }}" class="btn btn-outline-info"><i class="bi bi-receipt me-1"></i> View Transactions</a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-5" id="recentActivity">
        <h4>Recent Activity</h4>
        @if($recentActivities->isEmpty())
            <p class="text-muted">No recent activity found.</p>
        @else
            <ul class="list-group">
                @foreach($recentActivities as $activity)
                    <li class="list-group-item">
                        {{ $activity->description }}
                        <br>
                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
