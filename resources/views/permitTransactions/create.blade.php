@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New BusinessType</h1>

    <form action="{{ route('businessTypes.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Name</label>
            <input type= "text" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Create BusinessType</button>
    </form>
</div>
@endsection
