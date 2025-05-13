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
        <h2><i class="bi bi-geo-alt-fill me-2"></i>Addresses</h2>
        <a href="{{ route('addresses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Address
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('addresses.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by street, barangay, city..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <select name="barangay" class="form-select">
                <option value="">-- Filter by Barangay --</option>
                @foreach ($allBarangays as $brgy)
                    <option value="{{ $brgy }}" {{ request('barangay') == $brgy ? 'selected' : '' }}>{{ $brgy }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="city" class="form-select">
                <option value="">-- Filter by City --</option>
                @foreach ($allCities as $city)
                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="province" class="form-select">
                <option value="">-- Filter by Province --</option>
                @foreach ($allProvinces as $province)
                    <option value="{{ $province }}" {{ request('province') == $province ? 'selected' : '' }}>{{ $province }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>

        <div class="col-auto">
            <a href="{{ route('addresses.index') }}" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Clear
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-header fw-bold">Address List</div>
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
                        <th>{!! sortLink('purok', 'Purok', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('house_number', 'House #', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('street_name', 'Street', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('barangay', 'Barangay', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('city', 'City', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('province', 'Province', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('postal_code', 'Postal Code', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('created_at', 'Created At', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('updated_at', 'Modified At', $currentSort, $currentOrder) !!}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($addresses as $address)
                        <tr>
                            <td>{{ $address->purok }}</td>
                            <td>{{ $address->house_number }}</td>
                            <td>{{ $address->street_name }}</td>
                            <td>{{ $address->barangay }}</td>
                            <td>{{ $address->city }}</td>
                            <td>{{ $address->province }}</td>
                            <td>{{ $address->postal_code }}</td>
                            <td>{{ $address->created_at->format('M d, Y h:i A') }}</td>
                            <td>{{ $address->updated_at->format('M d, Y h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('addresses.show', $address->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" style="display:inline;">
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
                            <td colspan="10" class="text-center">No addresses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $addresses->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
