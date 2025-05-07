@extends('layouts.app')

@section('content')
<div class="container">
    <h1>BarangayEmployee</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('barangayemployees.create') }}" class="btn btn-primary mb-3">Add New BarangayEmployee</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Position Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangayemployees as $barangayemployee)
                <tr>
                    <td>{{ $barangayemployee->position_id }}</td>
                    <td>{{ $barangayemployee->first_name }}</td>
                    <td>{{ $barangayemployee->middle_name }}</td>
                    <td>{{ $barangayemployee->last_name }}</td>
                    <td>{{ $barangayemployee->contact_number }}</td>
                    <td>
                        <a href="{{ route('barangayemployees.show', $barangayemployee->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('barangayemployees.edit', $barangayemployee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barangayemployees.destroy', $barangayemployee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No BarangayEmployee found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
