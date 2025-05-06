@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Households</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('households.create') }}" class="btn btn-primary mb-3">Add New Household</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Purok</th>
                <th>Street Number</th>
                <th>Street Name</th>
                <th>Province</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($households as $household)
                <tr>
                    <td>{{ $household->purok }}</td>
                    <td>{{ $household->street_number }}</td>
                    <td>{{ $household->street_name }}</td>
                    <td>{{ $household->province }}</td>
                    <td>{{ $household->country }}</td>
                    <td>
                        <a href="{{ route('households.show', $household->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('households.edit', $household->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('households.destroy', $household->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No households found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
