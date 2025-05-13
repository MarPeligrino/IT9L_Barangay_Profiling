@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-tags me-2"></i>Add New Business Type</h2>

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

    <form action="{{ route('businessTypes.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Retail, Manufacturing" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <input type="text" name="description" class="form-control" placeholder="Short description" required>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Type
            </button>
            <a href="{{ route('businessTypes.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
