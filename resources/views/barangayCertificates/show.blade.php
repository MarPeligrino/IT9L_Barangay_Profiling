@extends('layouts.app')

@section('content')
<div class="container" id="printArea">
    <div class="border p-5 position-relative bg-white">

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
                <h4 class="fw-bold">Barangay {{ $certificate->resident->household->barangay ?? 'YourBarangay' }}</h4>
                <h5 class="text-decoration-underline">{{ $certificate->certificateType->certificate_name }}</h5>
                <p class="mb-0">Certificate No: <strong>#{{ str_pad($certificate->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
            </div>
            <img src="{{ asset('images/municipal_seal.png') }}" alt="Municipal Seal" style="height: 80px;">
        </div>

        <!-- Certificate Body -->
        <div class="mt-4 position-relative" style="z-index: 1; text-align: justify;">
            {!! nl2br($formattedDescription) !!}
        </div>

        <!-- Signature Block -->
        <div class="text-end mt-5 position-relative" style="z-index: 1;">
            <p class="mb-5">Issued this {{ \Carbon\Carbon::parse($certificate->IssuedDate)->format('jS') }} day of {{ \Carbon\Carbon::parse($certificate->IssuedDate)->format('F, Y') }}.</p>
            <p class="fw-bold mb-0">{{ $certificate->barangayEmployee->first_name }} {{ $certificate->barangayEmployee->last_name }}</p>
            <p class="mb-0">Barangay Official</p>
        </div>
    </div>

    <div class="mt-4 text-end">
        <button onclick="window.print()" class="btn btn-outline-primary">
            <i class="bi bi-printer"></i> Print Certificate
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
