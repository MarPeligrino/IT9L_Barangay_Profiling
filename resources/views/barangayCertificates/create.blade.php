@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-file-earmark-plus me-2"></i>Issue Barangay Certificate</h2>

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
            <!-- 🔍 Resident -->
            <div class="col-md-6">
                <label class="form-label">Resident <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="resident_id" class="form-select" required>
                        @foreach ($residents as $resident)
                            <option value="{{ $resident->id }}">{{ $resident->first_name }} {{ $resident->last_name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('residents.create') }}" class="btn btn-success" title="Add New Resident">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <!-- 👨 Employee -->
            <div class="col-md-6">
                <label class="form-label">Barangay Employee <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="barangay_employee_id" class="form-select" required>
                        @foreach ($barangayEmployees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('barangayemployees.create') }}" class="btn btn-success" title="Add New Employee">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <!-- 📜 Certificate Type -->
            <div class="col-md-6">
                <label class="form-label">Certificate Type <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="certificate_type_id" class="form-select" required>
                        @foreach ($certificateTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->certificate_name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('certificateTypes.create') }}" class="btn btn-success" title="Add New Certificate Type">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>

            <!-- 📝 Purpose -->
            <div class="col-md-6">
                <label class="form-label">Purpose <span class="text-danger">*</span></label>
                <input type="text" name="purpose" class="form-control" required>
            </div>

            <!-- 📆 Issued Date -->
            <div class="col-md-3">
                <label class="form-label">Issued Date <span class="text-danger">*</span></label>
                <input type="date" name="issued_date" class="form-control" id="issued_date" required>
            </div>

            <!-- 📌 Status -->
            <div class="col-md-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option disabled selected>Choose...</option>
                    <option value="Active">Active</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Issue Certificate
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
    });
</script>
@endsection
