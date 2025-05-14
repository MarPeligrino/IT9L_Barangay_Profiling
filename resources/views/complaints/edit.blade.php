@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Complaint</h2>

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

    <form action="{{ route('complaints.update', $complaint->id) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Linked Incident Report <span class="text-danger">*</span></label>
                <select name="incident_id" class="form-select" required>
                    <option value="">-- Select Incident --</option>
                    @foreach ($incidentReports as $incident)
                        <option value="{{ $incident->id }}" {{ old('incident_id', $complaint->incident_id) == $incident->id ? 'selected' : '' }}>
                            Incident #{{ $incident->id }} - {{ $incident->report_date }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Barangay Employee <span class="text-danger">*</span></label>
                <select name="barangay_employee_id" class="form-select" required>
                    <option value="">-- Select Employee --</option>
                    @foreach ($barangayEmployees as $employee)
                        <option value="{{ $employee->id }}" {{ old('barangay_employee_id', $complaint->barangay_employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" class="form-control" rows="3">{{ old('remarks', $complaint->remarks) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="">-- Select Status --</option>
                    <option value="pending" {{ old('status', $complaint->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status', $complaint->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ old('status', $complaint->status) === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ old('status', $complaint->status) === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
        </div>

        <hr class="my-4">

        <h5 class="fw-bold mb-2"><i class="bi bi-people-fill me-2"></i>Complaint Parties</h5>

        <div id="party-container">
            @foreach ($complaint->parties as $index => $party)
                <div class="row g-2 mb-2 party-row">
                    <input type="hidden" name="parties[{{ $index }}][id]" value="{{ $party->id }}">
                    <div class="col-md-6">
                        <select name="parties[{{ $index }}][resident_id]" class="form-select" required>
                            <option value="">-- Select Resident --</option>
                            @foreach ($residents as $resident)
                                <option value="{{ $resident->id }}" {{ $resident->id == $party->resident_id ? 'selected' : '' }}>
                                    {{ $resident->first_name }} {{ $resident->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="parties[{{ $index }}][role]" class="form-select" required>
                            <option value="">-- Select Role --</option>
                            <option value="complainant" {{ $party->role == 'complainant' ? 'selected' : '' }}>Complainant</option>
                            <option value="respondent" {{ $party->role == 'respondent' ? 'selected' : '' }}>Respondent</option>
                            <option value="witness" {{ $party->role == 'witness' ? 'selected' : '' }}>Witness</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-remove-party w-100">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-outline-primary" id="add-party-btn">
                <i class="bi bi-plus-circle me-1"></i> Add Party
            </button>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('complaints.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-1"></i> Update
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let partyIndex = {{ $complaint->parties->count() }};

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
