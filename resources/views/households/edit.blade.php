@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Household</h1>

    <form action="{{ route('households.update', $household->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Purok</label>
            <input type="text" name="purok" class="form-control" value="{{ $household->purok }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Street Number</label>
            <input type="text" name="street_number" class="form-control" value="{{ $household->street_number }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Street Name</label>
            <input type="text" name="street_name" class="form-control" value="{{ $household->street_name }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Apartment/Unit</label>
            <input type="text" name="apartment_unit" class="form-control" value="{{ $household->apartment_unit }}">
        </div>

        <div class="form-group mb-3">
            <label>Province</label>
            <input type="text" name="province" class="form-control" value="{{ $household->province }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control" value="{{ $household->postal_code }}">
        </div>

        <div class="form-group mb-3">
            <label>Country</label>
            <input type="text" name="country" class="form-control" value="{{ $household->country }}" required>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Update Household</button>
    </form>
</div>
@endsection
