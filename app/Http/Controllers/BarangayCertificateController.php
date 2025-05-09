<?php

namespace App\Http\Controllers;

use App\Models\BarangayCertificate;
use App\Models\BarangayEmployee;
use App\Models\CertificateType;
use App\Models\Resident;
use Illuminate\Http\Request;

class BarangayCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangayCertificates = BarangayCertificate::all();

        return view('barangayCertificates.index', compact('barangayCertificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $residents = Resident::all();
        $barangayEmployees = BarangayEmployee::all();
        $certificateTypes = CertificateType::all();
        return view('barangayCertificates.create', compact('residents', 'barangayEmployees', 'certificateTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'certificate_type_id' => 'required|exists:certificate_types,id',
            'purpose' => 'required|string',
            'issued_date' => 'required|date',
            'status' => 'required|string|max:50' ,
        ]);

        BarangayCertificate::create($validated);
        return redirect()->route('barangayCertificates.index')->with('success', 'Barangay Certificate Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangayCertificate $barangayCertificate)
    {
        return view('barangayCertificates.show', compact('barangayCertificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangayCertificate $barangayCertificate)
    {
        $residents = Resident::all();
        $barangayEmployees = BarangayEmployee::all();
        $certificateTypes = CertificateType::all();
        return view('barangayCertificates.edit', compact('residents', 'barangayEmployees', 'certificateTypes', 'barangayCertificate'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangayCertificate $barangayCertificate)
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'certificate_type_id' => 'required|exists:certificate_types,id',
            'purpose' => 'required|string',
            'issued_date' => 'required|date',
            'status' => 'required|string|max:50' ,
        ]);
        
        $barangayCertificate->update($validated);

        return redirect()->route('barangayCertificates.index')->with('success', "Barangay Certificate updated successfully.");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangayCertificate $barangayCertificate)
    {
        $barangayCertificate->delete();

        return redirect()->route('barangayCertificates.index')->with('success', 'Barangay Certificate deleted successfully.');
    }
}
