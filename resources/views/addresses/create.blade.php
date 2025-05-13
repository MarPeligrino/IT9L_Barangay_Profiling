@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Add New Address</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following issues:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('addresses.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">House Number <span class="text-danger">*</span></label>
                <input type="text" name="house_number" class="form-control" value="{{ old('house_number') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Street Name <span class="text-danger">*</span></label>
                <input type="text" name="street_name" class="form-control" value="{{ old('street_name') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Purok <span class="text-danger">*</span></label>
                <input type="text" name="purok" class="form-control" value="{{ old('purok') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Barangay <span class="text-danger">*</span></label>
                <input type="text" name="barangay" class="form-control" value="{{ old('barangay') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">City <span class="text-danger">*</span></label>
                <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Province <span class="text-danger">*</span></label>
                <input type="text" name="province" class="form-control" value="{{ old('province') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}" required>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Address
            </button>
            <a href="{{ route('addresses.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
