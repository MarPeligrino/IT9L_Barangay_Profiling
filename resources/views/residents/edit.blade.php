@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Resident</h1>

    <form action="{{ route('residents.update', $resident->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Household</label>
            <select name="household_id" class="form-control" required>
                @foreach ($households as $household)
                    <option value="{{ $household->id }}" {{ $resident->household_id == $household->id ? 'selected' : '' }}>
                        {{ $household->street_name ?? 'No Street' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Family Role</label>
            <select name="family_role_id" class="form-control" required>
                @foreach ($familyroles as $role)
                    <option value="{{ $role->id }}" {{ $resident->family_role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->role }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Current Address</label>
            <select name="current_address_id" class="form-control" required>
                @foreach ($currentaddress as $address)
                    <option value="{{ $address->id }}" {{ $resident->current_address_id == $address->id ? 'selected' : '' }}>
                        {{ $address->street_name ?? '' }}, {{ $address->purok ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $resident->first_name }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control" value="{{ $resident->middle_name }}">
        </div>

        <div class="form-group mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ $resident->last_name }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="{{ $resident->age }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Sex</label>
            <select name="sex" class="form-control" required>
                <option value="Male" {{ $resident->sex == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $resident->sex == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" value="{{ $resident->birthday }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Civil Status</label>
            <input type="text" name="civil_status" class="form-control" value="{{ $resident->civil_status }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ $resident->contact_number }}">
        </div>

        <div class="form-group mb-3">
            <label>Occupation</label>
            <input type="text" name="occupation" class="form-control" value="{{ $resident->occupation }}">
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Resident</button>
    </form>
</div>
@endsection
