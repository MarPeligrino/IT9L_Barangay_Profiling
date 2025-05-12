@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-person-plus-fill me-2"></i>Add New Resident</h2>

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

    <form action="{{ route('residents.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="row g-3">
            <!-- 🏠 Address Information -->
            <div class="col-md-4">
                <label class="form-label">Permanent Address <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="household_id" id="household_id" class="form-select" required>
                        @foreach ($households as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->formatted }}
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
                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Current Address <span class="text-danger">*</span></label>
                <select name="current_address_id" id="current_address_id" class="form-select" required>
                    @foreach ($currentaddress as $address)
                        <option value="{{ $address->id }}">
                            {{ $address->formatted }}
                        </option>
                    @endforeach
                </select>
                <div class="form-check mt-1">
                    <input class="form-check-input" type="checkbox" id="sameAddressCheckbox">
                    <input type="hidden" name="current_address_id" id="current_address_hidden">
                    <label class="form-check-label" for="sameAddressCheckbox">
                        Same as Permanent Address
                    </label>
                </div>
            </div>

            <!-- 👤 Personal Info -->
            <div class="col-md-4">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Middle Name</label>
                <input type="text" name="middle_name" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Age <span class="text-danger">*</span></label>
                <input type="number" name="age" class="form-control" min="1" max="200" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Sex <span class="text-danger">*</span></label>
                <select name="sex" class="form-select" required>
                    <option disabled selected>Choose...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Birthday <span class="text-danger">*</span></label>
                <input type="date" name="birthday" class="form-control" id="birthdayInput" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Civil Status <span class="text-danger">*</span></label>
                <select name="civil_status" class="form-select" required>
                    @foreach (\App\Models\Resident::CIVIL_STATUSES as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <!-- ☎ Contact -->
            <div class="col-md-6">
                <label class="form-label">Contact Number</label>
                <input 
                    type="text"
                    name="contact_number"
                    class="form-control"
                    maxlength="11"
                    pattern="09\d{9}"
                    inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                    placeholder="e.g. 09123456789"
                >
                @if ($errors->has('contact_number'))
                    <div class="text-danger small">{{ $errors->first('contact_number') }}</div>
                @endif
                <small class="text-muted">Must be a valid 11-digit mobile number starting with 09</small>
            </div>

            <div class="col-md-6">
                <label class="form-label">Occupation</label>
                <input type="text" name="occupation" class="form-control">
            </div>

            <!-- 🌍 Other -->
            <div class="col-md-6">
                <label class="form-label">Nationality</label>
                <input type="text" name="nationality" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Religion</label>
                <input type="text" name="religion" class="form-control">
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Resident
            </button>
            <a href="{{ route('residents.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('sameAddressCheckbox');
        const householdSelect = document.getElementById('household_id');
        const currentAddressSelect = document.getElementById('current_address_id');
        const currentAddressHidden = document.getElementById('current_address_hidden');

        // Set max date for birthday to today
        const birthdayInput = document.getElementById('birthdayInput');
        const today = new Date().toISOString().split('T')[0];
        birthdayInput.setAttribute('max', today);

        function syncAddresses() {
            if (checkbox.checked) {
                currentAddressSelect.disabled = true;
                currentAddressHidden.value = householdSelect.value;
            } else {
                currentAddressSelect.disabled = false;
                currentAddressHidden.value = '';
            }
        }

        checkbox.addEventListener('change', syncAddresses);
        householdSelect.addEventListener('change', () => {
            if (checkbox.checked) syncAddresses();
        });

        syncAddresses(); // Initial state
    });
</script>
@endsection
