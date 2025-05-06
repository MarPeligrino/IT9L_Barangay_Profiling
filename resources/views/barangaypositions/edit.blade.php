@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit BarangayPosition</h1>

    <form action="{{ route('barangaypositions.update', $barangayposition->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Position Name</label>
            <input type="text" name="position_name" class="form-control" value="{{ $barangayposition->position_name }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $barangayposition->description }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update BarangayPosition</button>
    </form>
</div>
@endsection
