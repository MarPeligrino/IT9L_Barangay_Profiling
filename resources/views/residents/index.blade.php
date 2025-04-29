@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Residents</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('residents.create') }}" class="btn btn-primary mb-3">Add New Resident</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Sex</th>
                <th>Birthday</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($residents as $resident)
                <tr>
                    <td>{{ $resident->first_name }}</td>
                    <td>{{ $resident->last_name }}</td>
                    <td>{{ $resident->sex }}</td>
                    <td>{{ $resident->birthday }}</td>
                    <td>
                        <a href="{{ route('residents.show', $resident->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No residents found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
