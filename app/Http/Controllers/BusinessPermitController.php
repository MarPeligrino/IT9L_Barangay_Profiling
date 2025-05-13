<?php

namespace App\Http\Controllers;

use App\Models\BarangayEmployee;
use App\Models\Business;
use App\Models\BusinessPermit;
use Illuminate\Http\Request;

class BusinessPermitController extends Controller
{
    public function index(Request $request)
    {
        $query = BusinessPermit::with(['business', 'barangayEmployee']);

        // Search by business name
        if ($search = $request->input('search')) {
            $query->whereHas('business', function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Sorting
        $sortableFields = ['issued_date', 'expiry_date', 'status', 'created_at', 'updated_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $businessPermits = $query->orderBy($sortBy, $order)
                                ->paginate(10)
                                ->appends($request->except('page'));

        return view('businessPermits.index', compact('businessPermits'));
    }


    public function create()
    {
        $businesses = Business::all();
        $barangayEmployees = BarangayEmployee::all();

        return view('businessPermits.create', compact('businesses', 'barangayEmployees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        $permit = BusinessPermit::create($validated);

        // 🔔 Log activity
        log_activity("Business Permit issued to business ID {$permit->business_id} by employee ID {$permit->barangay_employee_id}");

        return redirect()->route('businessPermits.index')->with('success', 'Business Permit added.');
    }

    public function show(BusinessPermit $businessPermit)
    {
        return view('businessPermits.show', compact('businessPermit'));
    }

    public function edit(BusinessPermit $businessPermit)
    {
        $businesses = Business::all();
        $barangayEmployees = BarangayEmployee::all();

        return view('businessPermits.edit', compact('businesses', 'barangayEmployees', 'businessPermit'));
    }

    public function update(Request $request, BusinessPermit $businessPermit)
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        $businessPermit->update($validated);

        // 🔔 Log activity
        log_activity("Business Permit updated for business ID {$businessPermit->business_id}");

        return redirect()->route('businessPermits.index')->with('success', 'Business Permit updated successfully.');
    }

    public function destroy(BusinessPermit $businessPermit)
    {
        // 🔔 Log activity
        log_activity("Business Permit deleted for business ID {$businessPermit->business_id}");

        $businessPermit->delete();

        return redirect()->route('businessPermits.index')->with('success', 'Business Permit deleted successfully.');
    }
}
