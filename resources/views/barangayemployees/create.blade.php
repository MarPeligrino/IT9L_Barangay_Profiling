@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Add Barangay Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong>
            <ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('barangayemployees.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Middle Name</label>
                <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Position <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="position_id" class="form-select" required>
                        <option value="">-- Select Position --</option>
                        @foreach ($barangayPositions as $position)
                            <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                {{ $position->position_name }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('barangaypositions.create') }}" class="btn btn-success" title="Add New Position">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
            </div>


            <div class="col-md-4">
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

            <div class="col-md-4">
                <label class="form-label">Start Date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Save</button>
            <a href="{{ route('barangayemployees.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
