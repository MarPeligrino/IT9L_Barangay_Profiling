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
        <h2><i class="bi bi-card-heading me-2"></i>Certificate Types</h2>
        <a href="{{ route('certificateTypes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Type
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('certificateTypes.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by certificate name..." value="{{ request('search') }}">
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
            <a href="{{ route('certificateTypes.index') }}" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Clear
            </a>
        </div>
    </form>


    <div class="card">
        <div class="card-header fw-bold">Type List</div>
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
                        <th>{!! sortLink('certificate_name', 'Certificate Name', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('description', 'Description', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('validity', 'Validity', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('fee', 'Fee (₱)', $currentSort, $currentOrder) !!}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($certificateTypes as $type)
                        <tr>
                            <td>{{ $type->certificate_name }}</td>
                            <td>{{ $type->description }}</td>
                            <td>{{ $type->validity }} day{{ $type->validity > 1 ? 's' : '' }}</td>
                            <td>₱{{ number_format($type->fee, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('certificateTypes.show', $type->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('certificateTypes.edit', $type->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('certificateTypes.destroy', $type->id) }}" method="POST" style="display:inline;">
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
                            <td colspan="5" class="text-center">No certificate types found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
