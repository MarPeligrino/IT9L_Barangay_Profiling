@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Business</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('businesses.create') }}" class="btn btn-primary mb-3">Add New Business</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Business Owner</th>
                <th>Business Type</th>
                <th>Business Name</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($businesses as $business)
                <tr>
                    <td>{{ $business->owner->first_name ?? 'N/A' }}  {{ $business->owner->last_name ?? 'N/A' }}</td>
                    <td>{{ $business->type->name }}</td>
                    <td>{{ $business->business_name }}</td>
                    <td>{{ $business->address->house_number ?? 'N/A'}} {{ $business->address->street_name ?? 'N/A'}} {{ $business->address->village ?? 'N/A'}} {{ $business->address->barangay ?? 'N/A'}} {{ $business->address->city ?? 'N/A'}} {{ $business->address->province ?? 'N/A'}} {{ $business->address->postal_code ?? 'N/A'}}</td>
                    <td>
                        <a href="{{ route('businesses.show', $business->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('businesses.edit', $business->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('businesses.destroy', $business->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Businesses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
