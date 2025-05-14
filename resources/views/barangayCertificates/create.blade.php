@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Issue Barangay Certificate</h2>

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

    <form action="{{ route('barangayCertificates.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="row g-3">
            <!-- Resident -->
            <div class="col-md-6">
                <label class="form-label">Resident <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="resident_id" class="form-select" required>
                        <option value="" disabled selected>-- Select Resident --</option>
                        @foreach ($residents as $resident)
                            <option value="{{ $resident->id }}">{{ $resident->first_name }} {{ $resident->last_name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('residents.create') }}" class="btn btn-success" title="Add New Resident">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <!-- Barangay Employee -->
            <div class="col-md-6">
                <label class="form-label">Issued By <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="barangay_employee_id" class="form-select" required>
                        <option value="" disabled selected>-- Select Barangay Employee --</option>
                        @foreach ($barangayEmployees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('barangayemployees.create') }}" class="btn btn-success" title="Add New Employee">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <!-- Certificate Type -->
            <div class="col-md-6">
                <label class="form-label">Certificate Type <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="certificate_type_id" class="form-select" id="certificate_type_id" required>
                        <option value="" disabled selected>-- Select Type --</option>
                        @foreach ($certificateTypes as $type)
                            <option value="{{ $type->id }}" data-fee="{{ $type->fee }}">
                                {{ $type->certificate_name }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('certificateTypes.create') }}" class="btn btn-success" title="Add New Type">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
                <small id="feeDisplay" class="text-muted mt-1 d-block">Fee: ₱0.00</small>
            </div>

            <!-- Purpose -->
            <div class="col-md-6">
                <label class="form-label">Purpose <span class="text-danger">*</span></label>
                <input type="text" name="purpose" class="form-control" required>
            </div>

            <!-- Issued Date -->
            <div class="col-md-6">
                <label class="form-label">Issued Date <span class="text-danger">*</span></label>
                <input type="date" name="issued_date" id="issued_date" class="form-control" required>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="Active" selected>Active</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Transaction Details -->
            <hr class="mt-4">

            <div class="col-md-4">
                <label class="form-label">Amount Paid <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="amount_paid" class="form-control" id="amount_paid" placeholder="e.g. 50.00" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                <input type="date" name="payment_date" class="form-control" value="{{ now()->toDateString() }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                <select name="payment_status" class="form-select" required>
                    <option value="Paid" selected>Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Failed">Failed</option>
                </select>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Certificate
            </button>
            <a href="{{ route('barangayCertificates.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const issuedDateInput = document.getElementById('issued_date');
        const today = new Date().toISOString().split('T')[0];
        issuedDateInput.value = today;
        issuedDateInput.setAttribute('max', today);

        const certTypeSelect = document.getElementById('certificate_type_id');
        const amountInput = document.getElementById('amount_paid');
        const feeDisplay = document.getElementById('feeDisplay');

        certTypeSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const fee = selected.getAttribute('data-fee');
            if (fee) {
                amountInput.value = parseFloat(fee).toFixed(2);
                feeDisplay.textContent = `Fee: ₱${parseFloat(fee).toFixed(2)}`;
            } else {
                amountInput.value = '';
                feeDisplay.textContent = 'Fee: ₱0.00';
            }
        });
    });
</script>
@endsection
