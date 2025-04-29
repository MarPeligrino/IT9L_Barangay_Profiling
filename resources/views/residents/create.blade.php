@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Resident</h1>

    <form action="{{ route('residents.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Household</label>
            <select name="household_id" class="form-control" required>
                @foreach ($households as $household)
                    <option value="{{ $household->id }}">{{ $household->street_name ?? 'No Street' }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Family Role</label>
            <select name="family_role_id" class="form-control" required>
                @foreach ($familyroles as $role)
                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Current Address</label>
            <select name="current_address_id" class="form-control" required>
                @foreach ($currentaddress as $address)
                    <option value="{{ $address->id }}">
                        {{ $address->street_name ?? '' }}, {{ $address->purok ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Sex</label>
            <select name="sex" class="form-control" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Civil Status</label>
            <input type="text" name="civil_status" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Occupation</label>
            <input type="text" name="occupation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Resident</button>
    </form>
</div>
@endsection
