@extends('layouts.app')

@section('content')
<style>
    .sortable { color: inherit; text-decoration: none; }
    .sortable:hover { text-decoration: underline; }
    .sorted { font-weight: bold; color: #0d6efd; }
    .sort-icon { font-size: 0.75rem; }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="bi bi-person-badge me-2"></i>Barangay Employees</h2>
        <a href="{{ route('barangayemployees.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Employee
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('barangayemployees.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by first or last name..." value="{{ request('search') }}">
                <button class="btn btn-success"><i class="bi bi-search"></i></button>
            </div>
        </div>

        <div class="col-md-4">
            <select name="position_id" class="form-select">
                <option value="">-- All Positions --</option>
                @foreach ($barangayPositions as $position)
                    <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>
                        {{ $position->position_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <button class="btn btn-primary"><i class="bi bi-funnel"></i> Filter</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('barangayemployees.index') }}" class="btn btn-danger"><i class="bi bi-x-circle"></i> Clear</a>
        </div>
    </form>

    <div class="card">
        <div class="card-header fw-bold">Employee List</div>
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

                        <th>{!! sortLink('first_name', 'First Name', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('last_name', 'Last Name', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('position_id', 'Position', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('start_date', 'Start Date', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('created_at', 'Created At', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('updated_at', 'Modified At', $currentSort, $currentOrder) !!}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->position->position_name ?? 'N/A' }}</td>
                            <td>{{ $employee->start_date ?? 'N/A' }}</td>
                            <td>{{ $employee->created_at->format('M d, Y h:i A') }}</td>
                            <td>{{ $employee->updated_at->format('M d, Y h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('barangayemployees.show', $employee->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('barangayemployees.edit', $employee->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('barangayemployees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">No employees found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $employees->appends(request()->query())->links() }}</div>
    </div>
</div>
@endsection
