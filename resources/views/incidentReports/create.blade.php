@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Add New Incident Report</h2>

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

    <form action="{{ route('incidentReports.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="row g-3">
            <!-- 👮 Employee -->
            <div class="col-md-6">
                <label class="form-label">Barangay Employee <span class="text-danger">*</span></label>
                <select name="barangay_employee_id" class="form-select" required>
                    <option value="">-- Select Employee --</option>
                    @foreach ($barangayEmployees as $employee)
                        <option value="{{ $employee->id }}" {{ old('barangay_employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 🗓 Report Date -->
            <div class="col-md-6">
                <label class="form-label">Report Date <span class="text-danger">*</span></label>
                <input type="date" name="report_date" class="form-control" value="{{ old('report_date') }}" required>
            </div>

            <!-- 📝 Remarks -->
            <div class="col-md-12">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" class="form-control" rows="3">{{ old('remarks') }}</textarea>
            </div>

            <!-- 🔖 Status -->
            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="">-- Select Status --</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
        </div>

        <hr class="my-4">

        <!-- 👥 Incident Parties -->
        <h5 class="fw-bold mb-2"><i class="bi bi-people-fill me-2"></i>Incident Report Parties</h5>

        <div id="party-container">
            <div class="row g-2 mb-2 party-row">
                <div class="col-md-6">
                    <select name="parties[0][resident_id]" class="form-select" required>
                        <option value="">-- Select Resident --</option>
                        @foreach ($residents as $resident)
                            <option value="{{ $resident->id }}">{{ $resident->first_name }} {{ $resident->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="parties[0][role]" class="form-select" required>
                        <option value="">-- Select Role --</option>
                        <option value="complainant">Complainant</option>
                        <option value="respondent">Respondent</option>
                        <option value="witness">Witness</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-remove-party w-100">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-outline-primary" id="add-party-btn">
                <i class="bi bi-plus-circle me-1"></i> Add Party
            </button>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('incidentReports.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save me-1"></i> Submit
            </button>
        </div>
    </form>
</div>

<!-- Add JS to manage dynamic rows -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let partyIndex = 1;

        document.getElementById('add-party-btn').addEventListener('click', function () {
            const container = document.getElementById('party-container');
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'g-2', 'mb-2', 'party-row');
            newRow.innerHTML = `
                <div class="col-md-6">
                    <select name="parties[${partyIndex}][resident_id]" class="form-select" required>
                        <option value="">-- Select Resident --</option>
                        @foreach ($residents as $resident)
                            <option value="{{ $resident->id }}">{{ $resident->first_name }} {{ $resident->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="parties[${partyIndex}][role]" class="form-select" required>
                        <option value="">-- Select Role --</option>
                        <option value="complainant">Complainant</option>
                        <option value="respondent">Respondent</option>
                        <option value="witness">Witness</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-remove-party w-100">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            partyIndex++;
        });

        document.getElementById('party-container').addEventListener('click', function (e) {
            if (e.target.closest('.btn-remove-party')) {
                e.target.closest('.party-row').remove();
            }
        });
    });
</script>
@endsection
