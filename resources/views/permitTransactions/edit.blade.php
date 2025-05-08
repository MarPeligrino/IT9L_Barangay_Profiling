@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit BusinessType</h1>

    <form action="{{ route('businessTypes.update', $businessType->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $businessType->name }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $businessType->description }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update BusinessType</button>
    </form>
</div>
@endsection
