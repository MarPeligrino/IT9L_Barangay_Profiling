@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Barangay Position</h2>

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

    <form action="{{ route('barangaypositions.update', $barangayposition->id) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Position Name <span class="text-danger">*</span></label>
                <input type="text" name="position_name" class="form-control" value="{{ old('name', $barangayposition->position_name) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <input type="text" name="description" class="form-control" value="{{ old('description', $barangayposition->description) }}" required>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Update Position
            </button>
            <a href="{{ route('barangaypositions.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
