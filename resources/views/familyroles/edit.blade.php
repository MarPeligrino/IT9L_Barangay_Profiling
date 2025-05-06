@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit FamilyRole</h1>

    <form action="{{ route('familyroles.update', $familyrole->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Role</label>
            <input type="text" name="role" class="form-control" value="{{ $familyrole->role }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Relationship</label>
            <input type="text" name="relationship" class="form-control" value="{{ $familyrole->relationship }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update FamilyRole</button>
    </form>
</div>
@endsection
