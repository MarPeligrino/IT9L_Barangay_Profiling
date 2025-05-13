@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Add New Business Permit</h2>

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

    <form action="{{ route('businessPermits.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="row g-3">
            <!-- Business -->
            <div class="col-md-6">
                <label class="form-label">Business <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="business_id" class="form-select" required>
                        <option value="" disabled selected>-- Select Business --</option>
                        @foreach ($businesses as $business)
                            <option value="{{ $business->id }}">{{ $business->business_name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('businesses.create') }}" class="btn btn-success" title="Add New Business">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <!-- Issued By -->
            <div class="col-md-6">
                <label class="form-label">Issued By <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="barangay_employee_id" class="form-select" required>
                        <option value="" disabled selected>-- Select Barangay Employee --</option>
                        @foreach ($barangayEmployees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('barangayemployees.create') }}" class="btn btn-success" title="Add New Barangay Employee">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <!-- Issued Date -->
            <div class="col-md-6">
                <label class="form-label">Issued Date <span class="text-danger">*</span></label>
                <input type="date" name="issued_date" class="form-control" required>
            </div>

            <!-- Expiry Date -->
            <div class="col-md-6">
                <label class="form-label">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control" readonly>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="Active">Active</option>
                    <option value="Expired">Expired</option>
                    <option value="Revoked">Revoked</option>
                </select>
            </div>

            <!-- Transaction Details -->
            <hr class="mt-4">

            <div class="col-md-4">
                <label class="form-label">Amount Paid <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="amount_paid" class="form-control" placeholder="e.g. 100.00" required>
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
                <i class="bi bi-save me-1"></i> Save Permit
            </button>
            <a href="{{ route('businessPermits.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const issuedDateInput = document.querySelector('input[name="issued_date"]');
        const expiryDateInput = document.querySelector('input[name="expiry_date"]');

        function updateExpiryDate() {
            const issuedDate = issuedDateInput.value;
            if (!issuedDate) return;

            const issued = new Date(issuedDate);
            issued.setFullYear(issued.getFullYear() + 1);
            issued.setDate(issued.getDate() - 1);

            const yyyy = issued.getFullYear();
            const mm = String(issued.getMonth() + 1).padStart(2, '0');
            const dd = String(issued.getDate()).padStart(2, '0');

            expiryDateInput.value = `${yyyy}-${mm}-${dd}`;
        }

        issuedDateInput.addEventListener('change', updateExpiryDate);
        updateExpiryDate(); // run once on load
    });
</script>


@endsection
