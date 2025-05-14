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
        <h2><i class="bi bi-file-earmark-text-fill me-2"></i>Barangay Certificates</h2>
        <a href="{{ route('barangayCertificates.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Issue New Certificate
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('barangayCertificates.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by resident name..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <select name="certificate_type_id" class="form-select">
                <option value="">-- Filter by Certificate Type --</option>
                @foreach ($certificateTypes as $type)
                    <option value="{{ $type->id }}" {{ request('certificate_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->certificate_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="date" name="issued_date" class="form-control" value="{{ request('issued_date') }}">
        </div>

        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">-- Status --</option>
                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Filter</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('barangayCertificates.index') }}" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Clear
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-header fw-bold">Certificate List</div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
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
                    <tr>
                        <th>Resident</th>
                        <th>Issued By</th>
                        <th>{!! sortLink('issued_date', 'Issued Date', $currentSort, $currentOrder) !!}</th>
                        <th>Type</th>
                        <th>Purpose</th>
                        <th>{!! sortLink('status', 'Status', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('created_at', 'Created At', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('updated_at', 'Modified At', $currentSort, $currentOrder) !!}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangayCertificates as $certificate)
                        <tr>
                            <td>{{ $certificate->resident->first_name ?? '' }} {{ $certificate->resident->last_name ?? '' }}</td>
                            <td>{{ $certificate->barangayEmployee->first_name ?? '' }} {{ $certificate->barangayEmployee->last_name ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($certificate->issued_date)->format('M d, Y') }}</td>
                            <td>{{ $certificate->certificateType->certificate_name ?? 'N/A' }}</td>
                            <td>{{ $certificate->purpose }}</td>
                            <td>
                                <span class="badge bg-{{ $certificate->status === 'Active' ? 'success' : 'secondary' }}">
                                    {{ $certificate->status }}
                                </span>
                            </td>
                            <td>{{ $certificate->created_at->format('M d, Y h:i A') }}</td>
                            <td>{{ $certificate->updated_at->format('M d, Y h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('barangayCertificates.show', $certificate->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('barangayCertificates.edit', $certificate->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('barangayCertificates.destroy', $certificate->id) }}" method="POST" style="display:inline;">
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
                            <td colspan="9" class="text-center">No certificates found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $barangayCertificates->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
