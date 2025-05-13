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
        <h2><i class="bi bi-people-fill me-2"></i>Residents</h2>
        <a href="{{ route('residents.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Resident
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('residents.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <select name="sex" class="form-select">
                <option value="">-- Filter by Sex --</option>
                <option value="Male" {{ request('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ request('sex') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>

        <div class="col-auto">
            <a href="{{ route('residents.index') }}" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Clear
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-header fw-bold">Resident List</div>
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
                        <th>{!! sortLink('sex', 'Sex', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('age', 'Age', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('birthday', 'Birthday', $currentSort, $currentOrder) !!}</th>
                        <th>Address</th>
                        <th>{!! sortLink('created_at', 'Created At', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('updated_at', 'Modified At', $currentSort, $currentOrder) !!}</th>
                        
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($residents as $resident)
                        <tr>
                            <td>{{ $resident->first_name }}</td>
                            <td>{{ $resident->last_name }}</td>
                            <td>
                                <span class="badge bg-{{ $resident->sex === 'Male' ? 'primary' : 'danger' }}">
                                    {{ $resident->sex }}
                                </span>
                            </td>
                            <td>{{ $resident->age }}</td>
                            <td>{{ \Carbon\Carbon::parse($resident->birthday)->format('M d, Y') }}</td>
                            <td>
                                {{ optional($resident->household)->house_number }},
                                {{ optional($resident->household)->street_name }},
                                {{ optional($resident->household)->barangay }}
                            </td>
                            <td>{{ $resident->created_at->format('M d, Y h:i A') }}</td>
                            <td>{{ $resident->updated_at->format('M d, Y h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('residents.show', $resident->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" style="display:inline;">
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
                            <td colspan="9" class="text-center">No residents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $residents->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
