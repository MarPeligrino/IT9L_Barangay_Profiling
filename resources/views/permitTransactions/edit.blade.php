@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit BusinessType</h1>

    <form action="{{ route('permitTransactions.update', $permitTransaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Business Permit ID</label>
            <select name="business_permit_id" class="form-control" required>
                @foreach ($owners as $owner)
                    <option value="{{ $owner->id }}">{{ $owner->first_name ?? 'N/A' }} {{ $owner->last_name ?? 'N/A' }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $permitTransaction->description }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update BusinessType</button>
    </form>
</div>
@endsection
