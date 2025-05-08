@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Business</h1>

    <form action="{{ route('businesses.update', $business->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Owner</label>
            <select name="owner_id" class="form-control" required>
                @foreach ($owners as $owner)
                    <option value="{{ $owner->id }}" {{ $business->owner_id == $owner->id ? 'selected' : '' }}>
                        {{ $owner->first_name ?? 'N/A' }} {{ $owner->last_name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Business Type</label>
            <select name="business_type_id" class="form-control" required>
                @foreach ($businesstypes as $businesstype)
                    <option value="{{ $businesstype->id }}" {{ $business->business_type_id == $businesstype->id ? 'selected' : '' }}>
                        {{ $businesstype->name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label>Address</label>
            <select name="business_address_id" class="form-control" required>
                @foreach ($addresses as $address)
                    <option value="{{ $address->id }}" {{ $business->business_type_id == $address->id ? 'selected' : '' }}>
                        {{ $address->house_number ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Business Name</label>
            <input type="text" name="business_name" class="form-control" value="{{ $business->business_name }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Business</button>
    </form>
</div>
@endsection
