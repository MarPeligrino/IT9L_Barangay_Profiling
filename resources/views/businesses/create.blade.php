@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Business</h1>

    <form action="{{ route('businesses.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Owner</label>
            <select name="owner_id" class="form-control" required>
                @foreach ($owners as $owner)
                    <option value="{{ $owner->id }}">{{ $owner->first_name ?? 'N/A' }} {{ $owner->last_name ?? 'N/A' }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Business Type</label>
            <select name="business_type_id" class="form-control" required>
                @foreach ($businesstypes as $businesstype)
                    <option value="{{ $businesstype->id }}">{{ $businesstype->name ?? 'N/A' }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label>Business Name</label>
            <input type="text" name="business_name" class="form-control" required>
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
            <input type="text" name="village" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Barangay</label>
            <input type="text" name="barangay" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Province</label>
            <input type="text" name="province" class="form-control" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Create BarangayEmployee</button>
    </form>
</div>
@endsection




