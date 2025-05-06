@extends('layouts.app')

@section('content')
<div class="container">
    <h1>BarangayPosition</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('barangaypositions.create') }}" class="btn btn-primary mb-3">Add New BarangayPositions</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Position Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangaypositions as $barangayposition)
                <tr>
                    <td>{{ $barangayposition->position_name }}</td>
                    <td>{{ $barangayposition->description }}</td>
                    <td>
                        <a href="{{ route('barangaypositions.show', $barangayposition->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('barangaypositions.edit', $barangayposition->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barangaypositions.destroy', $barangayposition->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No BarangayPositions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
