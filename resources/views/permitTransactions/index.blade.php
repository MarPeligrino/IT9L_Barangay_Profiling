@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Permit Transactions</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('permitTransactions.create') }}" class="btn btn-primary mb-3">Add New Permit Transaction</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Business Permit ID</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permitTransactions as $permitTransaction)
                <tr>
                    <td>{{ $permitTransaction->business_permit_id }}</td>
                    <td>{{ $permitTransaction->amount_paid }}</td>
                    <td>{{ $permitTransaction->payment_date }}</td>
                    <td>{{ $permitTransaction->payment_status }}</td>
                    <td>
                        <a href="{{ route('permitTransactions.show', $permitTransaction->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('permitTransactions.edit', $permitTransaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('permitTransactions.destroy', $permitTransaction->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No PermitTransaction found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
