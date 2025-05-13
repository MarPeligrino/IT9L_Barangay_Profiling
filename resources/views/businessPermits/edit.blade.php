@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Business Permit</h2>

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

    <form action="{{ route('businessPermits.update', $businessPermit->id) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- Business -->
            <div class="col-md-6">
                <label class="form-label">Business <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="business_id" class="form-select" required>
                        @foreach ($businesses as $business)
                            <option value="{{ $business->id }}" {{ $businessPermit->business_id == $business->id ? 'selected' : '' }}>
                                {{ $business->business_name }}
                            </option>
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
                        @foreach ($barangayEmployees as $employee)
                            <option value="{{ $employee->id }}" {{ $businessPermit->barangay_employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->first_name }} {{ $employee->last_name }}
                            </option>
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
                <input type="date" name="issued_date" class="form-control" value="{{ $businessPermit->issued_date }}" required>
            </div>

            <!-- Expiry Date -->
            <div class="col-md-6">
                <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                <input type="date" name="expiry_date" class="form-control" value="{{ $businessPermit->expiry_date }}" required>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="Active" {{ $businessPermit->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Expired" {{ $businessPermit->status == 'Expired' ? 'selected' : '' }}>Expired</option>
                    <option value="Revoked" {{ $businessPermit->status == 'Revoked' ? 'selected' : '' }}>Revoked</option>
                </select>
            </div>

            <!-- Transaction Details -->
            <hr class="mt-4">

            <div class="col-md-4">
                <label class="form-label">Amount Paid <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="amount_paid" class="form-control" value="{{ $transaction->amount_paid ?? '' }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                <input type="date" name="payment_date" class="form-control" value="{{ $transaction->payment_date ?? now()->toDateString() }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                <select name="payment_status" class="form-select" required>
                    <option value="Paid" {{ $transaction->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Pending" {{ $transaction->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Failed" {{ $transaction->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>

        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Update Permit
            </button>
            <a href="{{ route('businessPermits.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
