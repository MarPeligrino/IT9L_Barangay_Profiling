@extends('layouts.app')

@section('content')
<div class="container">
    <h1>BusinessType</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('businessTypes.create') }}" class="btn btn-primary mb-3">Add New BusinessType</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($businessTypes as $businessType)
                <tr>
                    <td>{{ $businessType->name }}</td>
                    <td>{{ $businessType->description }}</td>
                    <td>
                        <a href="{{ route('businessTypes.show', $businessType->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('businessTypes.edit', $businessType->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('businessTypes.destroy', $businessType->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No BusinessType found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
