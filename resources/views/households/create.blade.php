@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Household</h1>

    <form action="{{ route('households.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Purok</label>
            <input type="text" name="purok" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>House Number</label>
            <input type="text" name="house_number" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Street Name</label>
            <input type="text" name="street_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Village</label>
            <input type="text" name="village" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Barangay</label>
            <input type="text" name="barangay" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Province</label>
            <input type="text" name="province" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Create Household</button>
    </form>
</div>
@endsection
