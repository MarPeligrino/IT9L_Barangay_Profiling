@extends('layouts.app')

@section('content')
<style>
    .sortable {
        color: inherit;
        text-decoration: none;
    }

    .sortable:hover {
        text-decoration: underline;
    }

    .sorted {
        font-weight: bold;
        color: #0d6efd;
    }

    .sort-icon {
        font-size: 0.75rem;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="bi bi-receipt me-2"></i>Permit Transactions</h2>
        <a href="{{ route('permitTransactions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Transaction
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('permitTransactions.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by business name..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <select name="payment_status" class="form-select">
                <option value="">-- Filter by Payment Status --</option>
                <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                <option value="Pending" {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Failed" {{ request('payment_status') == 'Failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>

        <div class="col-auto">
            <a href="{{ route('permitTransactions.index') }}" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Clear
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-header fw-bold">Transaction List</div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    @php
                        $currentSort = request('sort_by');
                        $currentOrder = request('order') === 'asc' ? 'desc' : 'asc';

                        function sortLink($field, $label, $currentSort, $currentOrder) {
                            $isSorted = request('sort_by') === $field;
                            $newOrder = $isSorted && request('order') === 'asc' ? 'desc' : 'asc';
                            $icon = $isSorted ? ($newOrder === 'asc' ? 'bi-sort-down' : 'bi-sort-up') : 'bi-chevron-expand';
                            $class = $isSorted ? 'sorted' : '';
                            $params = array_merge(request()->all(), ['sort_by' => $field, 'order' => $newOrder]);
                            $url = request()->url() . '?' . http_build_query($params);
                            return "<a href=\"$url\" class=\"sortable $class\">$label <i class=\"bi $icon sort-icon\"></i></a>";
                        }
                    @endphp

                    <tr>
                        <th>Business</th>
                        <th>{!! sortLink('amount_paid', 'Amount Paid', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('payment_date', 'Payment Date', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('payment_status', 'Payment Status', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('created_at', 'Created At', $currentSort, $currentOrder) !!}</th>
                        <th>{!! sortLink('updated_at', 'Modified At', $currentSort, $currentOrder) !!}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permitTransactions as $transaction)
                        <tr>
                            <td>{{ $transaction->businessPermit->business->business_name ?? 'N/A' }}</td>
                            <td>₱{{ number_format($transaction->amount_paid, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->payment_date)->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $transaction->payment_status === 'Paid' ? 'success' : ($transaction->payment_status === 'Pending' ? 'warning' : 'danger') }}">
                                    {{ $transaction->payment_status }}
                                </span>
                            </td>
                            <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                            <td>{{ $transaction->updated_at->format('M d, Y h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('permitTransactions.show', $transaction->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('permitTransactions.edit', $transaction->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('permitTransactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $permitTransactions->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
