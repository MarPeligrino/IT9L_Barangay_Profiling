<?php

namespace App\Http\Controllers;

use App\Models\BarangayCertificate;
use App\Models\BarangayEmployee;
use App\Models\CertificateTransaction;
use App\Models\CertificateType;
use App\Models\Resident;
use Illuminate\Http\Request;

class BarangayCertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangayCertificate::with(['resident', 'barangayEmployee', 'certificateType']);

        // 🔍 Search by resident name
        if ($search = $request->input('search')) {
            $query->whereHas('resident', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        // 🗂️ Filter by certificate type
        if ($type = $request->input('certificate_type_id')) {
            $query->where('certificate_type_id', $type);
        }

        // 🗂️ Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // 🗂️ Filter by issued date
        if ($issuedDate = $request->input('issued_date')) {
            $query->whereDate('issued_date', $issuedDate);
        }

        // ⬆️ Sorting
        $sortableFields = ['issued_date', 'status', 'created_at', 'updated_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'issued_date';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $barangayCertificates = $query->orderBy($sortBy, $order)
                                      ->paginate(10)
                                      ->appends($request->except('page'));

        $certificateTypes = CertificateType::all();

        return view('barangayCertificates.index', compact('barangayCertificates', 'certificateTypes'));
    }

    public function create()
    {
        $residents = Resident::all();
        $barangayEmployees = BarangayEmployee::all();
        $certificateTypes = CertificateType::all();

        return view('barangayCertificates.create', compact('residents', 'barangayEmployees', 'certificateTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'certificate_type_id' => 'required|exists:certificate_types,id',
            'purpose' => 'required|string|max:1000',
            'issued_date' => 'required|date',
            'status' => 'required|string|max:50',

            // Transaction fields
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_status' => 'required|string|max:50',
        ]);

        // Create Barangay Certificate
        $certificate = BarangayCertificate::create([
            'resident_id' => $validated['resident_id'],
            'barangay_employee_id' => $validated['barangay_employee_id'],
            'certificate_type_id' => $validated['certificate_type_id'],
            'purpose' => $validated['purpose'],
            'issued_date' => $validated['issued_date'],
            'status' => $validated['status'],
        ]);

        // Log Activity
        log_activity("Barangay Certificate issued for Resident ID {$certificate->resident_id}");

        // Create Certificate Transaction using user-provided values
        CertificateTransaction::create([
            'certificate_id' => $certificate->id,
            'amount_paid' => $validated['amount_paid'],
            'payment_date' => $validated['payment_date'],
            'payment_status' => $validated['payment_status'],
        ]);

        return redirect()->route('barangayCertificates.index')->with('success', 'Certificate issued and transaction recorded.');
    }


    public function show(BarangayCertificate $barangayCertificate)
    {
        return view('barangayCertificates.show', compact('barangayCertificate'));
    }

    public function edit(BarangayCertificate $barangayCertificate)
    {
        $residents = Resident::all();
        $barangayEmployees = BarangayEmployee::all();
        $certificateTypes = CertificateType::all();

        return view('barangayCertificates.edit', compact('residents', 'barangayEmployees', 'certificateTypes', 'barangayCertificate'));
    }

    public function update(Request $request, BarangayCertificate $barangayCertificate)
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'certificate_type_id' => 'required|exists:certificate_types,id',
            'purpose' => 'required|string|max:1000',
            'issued_date' => 'required|date',
            'status' => 'required|string|max:50',

            // Transaction fields
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_status' => 'required|string|max:50',
        ]);

        // Update the certificate
        $barangayCertificate->update([
            'resident_id' => $validated['resident_id'],
            'barangay_employee_id' => $validated['barangay_employee_id'],
            'certificate_type_id' => $validated['certificate_type_id'],
            'purpose' => $validated['purpose'],
            'issued_date' => $validated['issued_date'],
            'status' => $validated['status'],
        ]);

        // Log activity
        log_activity("Barangay Certificate updated for Resident ID {$barangayCertificate->resident_id}");

        // Update or create the associated certificate transaction
        $transaction = CertificateTransaction::firstOrNew(['certificate_id' => $barangayCertificate->id]);

        $transaction->fill([
            'amount_paid' => $validated['amount_paid'],
            'payment_date' => $validated['payment_date'],
            'payment_status' => $validated['payment_status'],
        ])->save();

        return redirect()->route('barangayCertificates.index')->with('success', 'Barangay Certificate and transaction updated successfully.');
    }


    public function destroy(BarangayCertificate $barangayCertificate)
    {
        log_activity("Barangay Certificate deleted for Resident ID {$barangayCertificate->resident_id}");

        $barangayCertificate->delete();

        return redirect()->route('barangayCertificates.index')->with('success', 'Barangay Certificate deleted successfully.');
    }
}
