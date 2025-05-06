@extends('layouts.app')

@section('content')
<div class="container">
    <h1>FamilyRole</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('familyroles.create') }}" class="btn btn-primary mb-3">Add New FamilyRole</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role</th>
                <th>Relationship</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($familyroles as $familyrole)
                <tr>
                    <td>{{ $familyrole->role }}</td>
                    <td>{{ $familyrole->relationship }}</td>
                    <td>
                        <a href="{{ route('familyroles.show', $familyrole->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('familyroles.edit', $familyrole->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('familyroles.destroy', $familyrole->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No familyroles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
