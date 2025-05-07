@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit BarangayEmployee</h1>

    <form action="{{ route('barangayemployees.update', $barangayemployee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Position ID</label>
            <select name="position_id" class="form-control" required>
                @foreach ($barangayPositions as $barangayPosition)
                    <option value="{{ $barangayPosition->id }}" {{ $barangayemployee->position_id == $barangayPosition->id ? 'selected' : '' }}>
                        {{ $barangayPosition->position_name ?? 'No BarangayPosition' }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $barangayemployee->first_name }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control" value="{{ $barangayemployee->middle_name }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ $barangayemployee->last_name }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ $barangayemployee->contact_number }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update BarangayEmployee</button>
    </form>
</div>
@endsection
