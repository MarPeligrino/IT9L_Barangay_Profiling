@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-shop-window me-2"></i>Add New Business</h2>

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

    <form action="{{ route('businesses.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="row g-3">
            <!-- 🧑‍💼 Owner -->
            <div class="col-md-4">
                <label class="form-label">Owner <span class="text-danger">*</span></label>
                <select name="owner_id" class="form-select" required>
                    <option value="" disabled selected>-- Select Owner --</option>
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}">{{ $owner->first_name }} {{ $owner->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 🏷️ Business Type -->
            <div class="col-md-4">
                <label class="form-label">Business Type <span class="text-danger">*</span></label>
                <select name="business_type_id" class="form-select" required>
                    <option value="" disabled selected>-- Select Type --</option>
                    @foreach ($businesstypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 📍 Address -->
            <div class="col-md-4">
                <label class="form-label">Business Address <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="business_address_id" class="form-select" required>
                        <option value="" disabled selected>-- Select Address --</option>
                        @foreach ($addresses as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->house_number }} {{ $address->street_name }},
                                {{ $address->barangay }}, {{ $address->city }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('addresses.create') }}" class="btn btn-success" title="Add New Address">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <!-- 📝 Business Name -->
            <div class="col-md-12">
                <label class="form-label">Business Name <span class="text-danger">*</span></label>
                <input type="text" name="business_name" class="form-control" placeholder="Enter business name" required>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Business
            </button>
            <a href="{{ route('businesses.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
