@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Resident</h2>

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

    <form action="{{ route('residents.update', $resident->id) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- Address Information -->
            <div class="col-md-4">
                <label class="form-label">Permanent Address <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="household_id" id="household_id" class="form-select" required>
                        @foreach ($households as $address)
                            <option value="{{ $address->id }}" {{ $resident->household_id == $address->id ? 'selected' : '' }}>
                                {{ $address->formatted ?? $address->street_name }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('addresses.create') }}" class="btn btn-success" title="Add New Address">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Family Role <span class="text-danger">*</span></label>
                <select name="family_role_id" class="form-select" required>
                    @foreach ($familyroles as $role)
                        <option value="{{ $role->id }}" {{ $resident->family_role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->role }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Current Address <span class="text-danger">*</span></label>
                <select name="current_address_id" id="current_address_id" class="form-select" required>
                    @foreach ($currentaddress as $address)
                        <option value="{{ $address->id }}" {{ $resident->current_address_id == $address->id ? 'selected' : '' }}>
                            {{ $address->formatted ?? $address->street_name }}, {{ $address->purok }}
                        </option>
                    @endforeach
                </select>

                <div class="form-check mt-1">
                    <input class="form-check-input" type="checkbox" id="sameAddressCheckbox">
                    <label class="form-check-label" for="sameAddressCheckbox">
                        Same as Permanent Address
                    </label>
                </div>
            </div>


            <!-- Personal Info -->
            <div class="col-md-4">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" class="form-control" value="{{ $resident->first_name }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Middle Name</label>
                <input type="text" name="middle_name" class="form-control" value="{{ $resident->middle_name }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" class="form-control" value="{{ $resident->last_name }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Age <span class="text-danger">*</span></label>
                <input type="number" name="age" class="form-control" value="{{ $resident->age }}" min="1" max="200" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Sex <span class="text-danger">*</span></label>
                <select name="sex" class="form-select" required>
                    <option value="Male" {{ $resident->sex == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $resident->sex == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Birthday <span class="text-danger">*</span></label>
                <input type="date" name="birthday" class="form-control" id="birthdayInput" value="{{ $resident->birthday }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Civil Status <span class="text-danger">*</span></label>
                <input type="text" name="civil_status" class="form-control" value="{{ $resident->civil_status }}" required>
            </div>

            <!-- Contact -->
            <div class="col-md-6">
                <label class="form-label">Contact Number</label>
                <input 
                    type="text"
                    name="contact_number"
                    class="form-control"
                    value="{{ $resident->contact_number }}"
                    maxlength="11"
                    pattern="09\d{9}"
                    inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                    placeholder="e.g. 09123456789"
                >
                <small class="text-muted">Must be a valid 11-digit mobile number starting with 09</small>
            </div>

            <div class="col-md-6">
                <label class="form-label">Occupation</label>
                <input type="text" name="occupation" class="form-control" value="{{ $resident->occupation }}">
            </div>

            <!-- Other -->
            <div class="col-md-6">
                <label class="form-label">Nationality</label>
                <input type="text" name="nationality" class="form-control" value="{{ $resident->nationality }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Religion</label>
                <input type="text" name="religion" class="form-control" value="{{ $resident->religion }}">
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Update Resident
            </button>
            <a href="{{ route('residents.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('sameAddressCheckbox');
        const householdSelect = document.getElementById('household_id');
        const currentAddressSelect = document.getElementById('current_address_id');

        checkbox.addEventListener('change', function () {
            if (this.checked) {
                // Set current address equal to permanent address (household_id)
                currentAddressSelect.value = householdSelect.value;
            }
        });

        // Optional: Update current address if household changes while checkbox is checked
        householdSelect.addEventListener('change', function () {
            if (checkbox.checked) {
                currentAddressSelect.value = this.value;
            }
        });
    });
</script>


@endsection
