@extends('layouts.app')

@section('content')
<style>
    .sortable {
        color: inherit;
        text-decoration: none;
    }

    .sortable:hover {
        text-decoration: underline;
    }

    .sorted {
        font-weight: bold;
        color: #0d6efd;
    }

    .sort-icon {
        font-size: 0.75rem;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="bi bi-exclamation-diamond me-2"></i>Incident Reports</h2>
        <a href="{{ route('incidentReports.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Report
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('incidentReports.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by remarks or employee..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- Filter by Status --</option>
                <option value="Open" {{ request('status') == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>

        <div class="col-auto">
            <a href="{{ route('incidentReports.index') }}" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Clear
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-header fw-bold">Incident Report List</div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        @php
                            $currentSort = request('sort_by');
                            $currentOrder = request('order') === 'asc' ? 'desc' : 'asc';

                            function sortLink($field, $label, $currentSort, $currentOrder) {
                                $isSorted = request('sort_by') === $field;
                                $newOrder = $isSorted && request('order') === 'asc' ? 'desc' : 'asc';
                                $icon = $isSorted ? ($newOrder === 'asc' ? 'bi-sort-down' : 'bi-sort-up') : 'bi-chevron-expand';
                                $class = $isSorted ? 'sorted' : '';
                                $params = array_merge(request()->all(), ['sort_by' => $field, 'order' => $newOrder]);
                                $url = request()->url() . '?' . http_build_query($params);

                                return "<a href=\"$url\" class=\"sortable $class\">$label <i class=\"bi $icon sort-icon\"></i></a>";
                            }
                        @endphp

                        <th>{!! sortLink('report_date', 'Date', $currentSort, $currentOrder) !!}</th>
                        <th>Employee</th>
                        <th>{!! sortLink('status', 'Status', $currentSort, $currentOrder) !!}</th>
                        <th>Remarks</th>
                        <th>{!! sortLink('created_at', 'Created At', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('updated_at', 'Modified At', $currentSort, $currentOrder) !!}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incidentReports as $report)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
                            <td>{{ $report->barangayEmployee->first_name ?? '' }} {{ $report->barangayEmployee->last_name ?? '' }}</td>
                            <td>
                                <span class="badge bg-{{ $report->status === 'Open' ? 'warning' : 'success' }}">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($report->remarks, 50) }}</td>
                            <td>{{ $report->created_at->format('M d, Y h:i A') }}</td>
                            <td>{{ $report->updated_at->format('M d, Y h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('incidentReports.edit', $report->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('incidentReports.destroy', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No incident reports found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $incidentReports->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
