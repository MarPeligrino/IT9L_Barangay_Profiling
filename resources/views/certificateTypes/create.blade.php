@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-file-earmark-plus me-2"></i>Add Certificate Type</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('certificateTypes.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Certificate Name <span class="text-danger">*</span></label>
                <input type="text" name="certificate_name" class="form-control" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="validity" class="form-label">Validity (in days) <span class="text-danger">*</span></label>
                <input type="number" name="validity" class="form-control" required min="1" placeholder="Ex: 30">
            </div>

            <div class="col-12">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="3" required></textarea>

                <div class="form-text mt-1">
                    Please include the following placeholders in your description:
                </div>

                <div class="alert alert-info small mt-2" role="alert">
                    <strong>Example:</strong><br>
                    This is to certify that <code>[Name]</code>, of legal age, <code>[civil status]</code>, and a bonafide resident of <code>[complete address]</code>, Barangay <code>[Barangay]</code>, Municipality of <code>[Municipality]</code>, Province of <code>[Province]</code>, is known to this office to be a person of good moral character and has no derogatory record or pending case filed in this barangay as of this date. This certification is being issued upon the request of the above-named person for the purpose of <code>[purpose]</code>.
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Fee (₱) <span class="text-danger">*</span></label>
                <input type="number" name="fee" class="form-control" step="0.01" min="0" max="99999.99" required>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Type
            </button>
            <a href="{{ route('certificateTypes.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
