@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Incident Report</h2>

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

    <form action="{{ route('incidentReports.update', $incidentReport->id) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- 👮 Barangay Employee -->
            <div class="col-md-6">
                <label for="barangay_employee_id" class="form-label">Barangay Employee <span class="text-danger">*</span></label>
                <select name="barangay_employee_id" id="barangay_employee_id" class="form-select" required>
                    <option value="">-- Select Employee --</option>
                    @foreach ($barangayEmployees as $employee)
                        <option value="{{ $employee->id }}" {{ old('barangay_employee_id', $incidentReport->barangay_employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 🗓 Report Date -->
            <div class="col-md-6">
                <label for="report_date" class="form-label">Report Date <span class="text-danger">*</span></label>
                <input type="date" name="report_date" id="report_date" class="form-control" value="{{ old('report_date', $incidentReport->report_date) }}" required>
            </div>

            <!-- 📝 Remarks -->
            <div class="col-md-12">
                <label for="remarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                <textarea name="remarks" id="remarks" class="form-control" rows="3" required>{{ old('remarks', $incidentReport->remarks) }}</textarea>
            </div>

            <!-- 🔖 Status ENUM -->
            <div class="col-md-6">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-select" required>
                    <option value="">-- Select Status --</option>
                    <option value="pending" {{ old('status', $incidentReport->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status', $incidentReport->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ old('status', $incidentReport->status) === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ old('status', $incidentReport->status) === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('incidentReports.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-1"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
