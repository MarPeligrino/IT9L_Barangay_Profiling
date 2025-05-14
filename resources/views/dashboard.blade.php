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

    #trendChart {
        max-height: 300px;
    }
</style>

<div class="container-fluid">
    <!-- Welcome -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Welcome, {{ Auth::user()->name ?? 'User' }}!</h2>
            <p class="text-muted">Today is {{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
        </div>
    </div>

    <!-- 👥 Population -->
    <h4 class="mt-4">👥 Population</h4>
    <div class="row g-3">
        <x-dashboard.card count="{{ $residentsCount }}" label="Total Residents" icon="person-plus-fill" color="primary" route="residents.index" />
        <x-dashboard.card count="{{ $addressCount }}" label="Total Addresses" icon="geo-alt-fill" color="success" route="addresses.index" />
        <x-dashboard.card count="{{ $roleCount }}" label="Family Roles" icon="people-fill" color="secondary" route="familyroles.index" />
    </div>

    <!-- 🏢 Business -->
    <h4 class="mt-5">🏢 Business</h4>
    <div class="row g-3">
        <x-dashboard.card count="{{ $businessCount }}" label="Registered Businesses" icon="briefcase-fill" color="danger" route="businesses.index" />
        <x-dashboard.card count="{{ $businessTypeCount }}" label="Business Types" icon="tags-fill" color="dark" route="businessTypes.index" />
    </div>

    <!-- 📜 Certificates & Permits -->
    <h4 class="mt-5">📜 Certificates & Permits</h4>
    <div class="row g-3">
        <x-dashboard.card count="{{ $permitCount }}" label="Permits Issued" icon="file-earmark-text-fill" color="primary" route="businessPermits.index" />
        <x-dashboard.card count="{{ $transactionCount }}" label="Permit Transactions" icon="receipt-cutoff" color="info" route="permitTransactions.index" />
    </div>

    <!-- 🧾 Reports & Complaints -->
    <h4 class="mt-5">🧾 Reports & Complaints</h4>
    <div class="row g-3">
        <x-dashboard.card count="{{ $incidentReportsCount }}" label="Incident Reports" icon="exclamation-triangle-fill" color="danger" route="incidentReports.index" />
        <x-dashboard.card count="{{ $complaintsCount }}" label="Filed Complaints" icon="file-earmark-excel-fill" color="warning" route="complaints.index" />
        <x-dashboard.card count="{{ $certificatesCount }}" label="Certificates Issued" icon="file-earmark-check-fill" color="info" route="barangayCertificates.index" />
    </div>

    <!-- 👔 Governance -->
    <h4 class="mt-5">👔 Governance</h4>
    <div class="row g-3">
        <x-dashboard.card count="{{ $employeeCount }}" label="Barangay Employees" icon="person-badge-fill" color="warning" route="barangayemployees.index" />
        <x-dashboard.card count="{{ $positionCount }}" label="Barangay Positions" icon="clipboard-data-fill" color="info" route="barangaypositions.index" />
    </div>

    <!-- ⚡ Quick Actions -->
    <h4 class="mt-5">⚡ Quick Actions</h4>
    <div class="d-flex flex-wrap gap-3 mb-4">
        <a href="{{ route('residents.create') }}" class="btn btn-outline-primary"><i class="bi bi-person-plus-fill me-1"></i> Add Resident</a>
        <a href="{{ route('businesses.create') }}" class="btn btn-outline-success"><i class="bi bi-building me-1"></i> Add Business</a>
        <a href="{{ route('businessPermits.create') }}" class="btn btn-outline-warning"><i class="bi bi-file-earmark-plus me-1"></i> Issue Permit</a>
        <a href="{{ route('permitTransactions.index') }}" class="btn btn-outline-info"><i class="bi bi-receipt me-1"></i> View Transactions</a>
        <a href="{{ route('incidentReports.create') }}" class="btn btn-outline-danger"><i class="bi bi-exclamation-triangle-fill me-1"></i> File Incident Report</a>
        <a href="{{ route('complaints.create') }}" class="btn btn-outline-warning"><i class="bi bi-file-earmark-text me-1"></i> Lodge Complaint</a>
        <a href="{{ route('barangayCertificates.create') }}" class="btn btn-outline-info"><i class="bi bi-file-earmark-check me-1"></i> Issue Certificate</a>
    </div>

    <!-- 📈 Monthly Trends -->
    <h4>📈 Monthly Trends</h4>
    <div class="card shadow-sm p-3">
        <canvas id="trendChart"></canvas>
    </div>

    <!-- 🕘 Recent Activity -->
    <div class="mt-5" id="recentActivity">
        <h4>🕘 Recent Activity</h4>
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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('trendChart').getContext('2d');
    const months = {!! json_encode($residentTrends->pluck('month')) !!};
    const residents = {!! json_encode($residentTrends->pluck('count')) !!};
    const permits = {!! json_encode($permitTrends->pluck('count')) !!};

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'New Residents',
                    data: residents,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'New Permits',
                    data: permits,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
