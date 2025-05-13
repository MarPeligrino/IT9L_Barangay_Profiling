@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-people-fill me-2"></i>Add New Family Role</h2>

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

    <form action="{{ route('familyroles.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Role <span class="text-danger">*</span></label>
                <input type="text" name="role" class="form-control" placeholder="e.g. Father, Mother" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Relationship <span class="text-danger">*</span></label>
                <input type="text" name="relationship" class="form-control" placeholder="e.g. Head, Spouse, Child" required>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Role
            </button>
            <a href="{{ route('familyroles.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
