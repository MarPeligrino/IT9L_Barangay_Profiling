@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Address</h1>

    <form action="{{ route('addresses.update', $address->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Purok</label>
            <input type="text" name="purok" class="form-control" value="{{ $address->purok }}" required>
        </div>

        <div class="form-group mb-3">
            <label>House Number</label>
            <input type="text" name="house_number" class="form-control" value="{{ $address->house_number }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Street Name</label>
            <input type="text" name="street_name" class="form-control" value="{{ $address->street_name }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Village</label>
            <input type="text" name="village" class="form-control" value="{{ $address->village }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Barangay</label>
            <input type="text" name="barangay" class="form-control" value="{{ $address->barangay }}">
        </div>

        <div class="form-group mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{ $address->city }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Province</label>
            <input type="text" name="province" class="form-control" value="{{ $address->province }}">
        </div>

        <div class="form-group mb-3">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control" value="{{ $address->postal_code }}" required>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Update Address</button>
    </form>
</div>
@endsection
