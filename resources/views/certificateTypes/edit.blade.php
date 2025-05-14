@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Certificate Type</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('certificateTypes.update', $certificateType->id) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="certificate_name" class="form-label">Certificate Name <span class="text-danger">*</span></label>
                <input type="text" name="certificate_name" class="form-control" value="{{ old('certificate_name', $certificateType->certificate_name) }}" required>
            </div>

            <div class="col-md-6">
                <label for="fee" class="form-label">Fee (₱) <span class="text-danger">*</span></label>
                <input type="number" name="fee" class="form-control" value="{{ old('fee', $certificateType->fee) }}" step="0.01" min="0" required>
            </div>

            <div class="col-md-12">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $certificateType->description) }}</textarea>

                <div class="form-text mt-1">
                    Please include the following placeholders in your description:
                </div>

                <div class="alert alert-info small mt-2" role="alert">
                    <strong>Example:</strong><br>
                    This is to certify that <code>[Name]</code>, of legal age, <code>[civil status]</code>, and a bonafide resident of <code>[complete address]</code>, Barangay <code>[Barangay]</code>, Municipality of <code>[Municipality]</code>, Province of <code>[Province]</code>, is known to this office to be a person of good moral character and has no derogatory record or pending case filed in this barangay as of this date. This certification is being issued upon the request of the above-named person for the purpose of <code>[purpose]</code>.
                </div>
            </div>

            <div class="col-md-6">
                <label for="validity" class="form-label">Validity (in days) <span class="text-danger">*</span></label>
                <input type="number" name="validity" class="form-control" value="{{ old('validity', $certificateType->validity) }}" min="1" required placeholder="Ex: 30">
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('certificateTypes.index') }}" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Update Type
            </button>
        </div>
    </form>
</div>
@endsection
