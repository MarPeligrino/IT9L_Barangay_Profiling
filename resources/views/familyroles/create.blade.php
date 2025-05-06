@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New FamilyRole</h1>

    <form action="{{ route('familyroles.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Role</label>
            <input type= "text" name="role" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Relationship</label>
            <input type="text" name="relationship" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Create FamilyRole</button>
    </form>
</div>
@endsection
