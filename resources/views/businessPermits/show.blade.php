@extends('layouts.app')

@section('content')
<div class="container" id="printArea">
    <div class="border p-5 position-relative bg-white" style="background: white;">

        <!-- Watermark -->
        <img src="{{ asset('images/watermark.png') }}" 
             class="position-absolute top-50 start-50 translate-middle opacity-25"
             style="width: 300px; z-index: 0;" alt="Watermark">

        <!-- Header with logos -->
        <div class="d-flex justify-content-between align-items-center mb-4 position-relative" style="z-index: 1;">
            <img src="{{ asset('images/barangay_logo.png') }}" alt="Barangay Logo" style="height: 80px;">
            <div class="text-center flex-grow-1">
                <h5 class="mb-1">Republic of the Philippines</h5>
                <h6 class="mb-1">Province of Davao Del Sur</h6>
                <h6 class="mb-1">Municipality of Davao City</h6>
                <h4 class="fw-bold">Barangay {{ $businessPermit->barangayEmployee->barangay ?? 'Cabantian' }}</h4>
                <h5 class="text-decoration-underline">Business Permit</h5>
                <p class="mb-0">Permit No: <strong>#{{ str_pad($businessPermit->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
            </div>
            <img src="{{ asset('images/municipal_seal.png') }}" alt="Municipal Seal" style="height: 80px;">
        </div>

        <!-- Business Info Table -->
        <table class="table table-bordered position-relative" style="z-index: 1;">
            <tbody>
                <tr>
                    <th width="30%">Business Name</th>
                    <td>{{ $businessPermit->business->business_name }}</td>
                </tr>
                <tr>
                    <th>Owner</th>
                    <td>{{ $businessPermit->business->owner->first_name }} {{ $businessPermit->business->owner->last_name }}</td>
                </tr>
                <tr>
                    <th>Business Type</th>
                    <td>{{ $businessPermit->business->type->name }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $businessPermit->business->address->formatted ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Issued Date</th>
                    <td>{{ \Carbon\Carbon::parse($businessPermit->issued_date)->format('F d, Y') }}</td>
                </tr>
                <tr>
                    <th>Expiry Date</th>
                    <td>{{ \Carbon\Carbon::parse($businessPermit->expiry_date)->format('F d, Y') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $businessPermit->status }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Signature Block -->
        <div class="text-end mt-5 position-relative" style="z-index: 1;">
            <p class="mb-5">Issued this {{ \Carbon\Carbon::parse($businessPermit->issued_date)->format('jS') }} day of {{ \Carbon\Carbon::parse($businessPermit->issued_date)->format('F, Y') }}.</p>
            <p class="fw-bold mb-0">{{ $businessPermit->barangayEmployee->first_name }} {{ $businessPermit->barangayEmployee->last_name }}</p>
            <p class="mb-0">Barangay Official</p>
        </div>
    </div>

    <div class="mt-4 text-end">
        <button onclick="window.print()" class="btn btn-outline-primary">
            <i class="bi bi-printer"></i> Print Permit
        </button>
    </div>
</div>

<!-- Print Styling -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #printArea, #printArea * {
            visibility: visible;
        }

        #printArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .btn {
            display: none !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000 !important;
        }
    }

    .opacity-25 {
        opacity: 0.08 !important;
    }
</style>
@endsection
