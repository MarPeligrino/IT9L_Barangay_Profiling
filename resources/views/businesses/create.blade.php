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
            <label>Address</label>
            <select name="business_address_id" class="form-control" required>
                @foreach ($addresses as $address)
                    <option value="{{ $address->id }}">{{ $address->house_number ?? 'N/A' }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label>Business Name</label>
            <input type="text" name="business_name" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Create Business</button>
    </form>
</div>
@endsection




