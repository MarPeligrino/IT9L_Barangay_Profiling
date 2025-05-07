@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New BarangayEmployee</h1>

    <form action="{{ route('barangayemployees.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Position ID</label>
            <select name="position_id" class="form-control" required>
                @foreach ($barangayPositions as $barangayPosition)
                    <option value="{{ $barangayPosition->id }}">{{ $barangayPosition->position_name ?? 'No Position' }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Create BarangayEmployee</button>
    </form>
</div>
@endsection




