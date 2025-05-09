<?php

namespace App\Http\Controllers;

use App\Models\BarangayEmployee;
use App\Models\Business;
use App\Models\BusinessPermit;
use Illuminate\Http\Request;

class BusinessPermitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businessPermits = BusinessPermit::all();

        return view('businessPermits.index', compact('businessPermits'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $businesses = Business::all();
        $barangayEmployees = BarangayEmployee::all();
        return view('businessPermits.create', compact('businesses', 'barangayEmployees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|string|max:50' ,
        ]);

        BusinessPermit::create($validated);
        return redirect()->route('businessPermits.index')->with('success', 'BusinessPermit Added');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessPermit $businessPermit)
    {
        return view('businessPermits.show', compact('businessPermit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessPermit $businessPermit)
    {
        $businesses = Business::all();
        $barangayEmployees = BarangayEmployee::all();

        return view('businessPermits.edit', compact('businesses', 'barangayEmployees', 'businessPermit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusinessPermit $businessPermit)
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'issued_date' => 'required|date',
            'exiry_date' => 'required|date',
            'status' => 'required|string|max:50' ,
        ]);

        $businessPermit->update($validated);

        return redirect()->route('businessPermits.index')->with('success', "BusinessPermit updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessPermit $businessPermit)
    {
        $businessPermit->delete();

        return redirect()->route('businessPermits.index')->with('success', 'BusinessPermit deleted successfully.');
    
    }
}
