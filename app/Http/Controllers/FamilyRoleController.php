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
        <h2><i class="bi bi-people-fill me-2"></i>Family Roles</h2>
        <a href="{{ route('familyroles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Family Role
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('familyroles.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by role or relationship..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>

        <div class="col-auto">
            <a href="{{ route('familyroles.index') }}" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Clear
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-header fw-bold">Family Role List</div>
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

                        <th>{!! sortLink('role', 'Role', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('relationship', 'Relationship', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('created_at', 'Created At', $currentSort, $currentOrder) !!}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($familyroles as $familyrole)
                        <tr>
                            <td>{{ $familyrole->role }}</td>
                            <td>{{ $familyrole->relationship }}</td>
                            <td>{{ $familyrole->created_at->format('M d, Y h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('familyroles.show', $familyrole->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('familyroles.edit', $familyrole->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('familyroles.destroy', $familyrole->id) }}" method="POST" style="display:inline;">
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
                            <td colspan="4" class="text-center">No family roles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $familyroles->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
