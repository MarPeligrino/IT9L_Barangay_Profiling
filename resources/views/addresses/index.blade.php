@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Addresses</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-3">Add New Address</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Purok</th>
                <th>House Number</th>
                <th>Street Name</th>
                <th>Village</th>
                <th>Barangay</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($addresses as $address)
                <tr>
                    <td>{{ $address->purok }}</td>
                    <td>{{ $address->house_number }}</td>
                    <td>{{ $address->street_name }}</td>
                    <td>{{ $address->village }}</td>
                    <td>{{ $address->barangay }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->province }}</td>
                    <td>{{ $address->postal_code }}</td>
                    <td>
                        <a href="{{ route('addresses.show', $address->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No addresses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
