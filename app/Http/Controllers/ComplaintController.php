<?php

namespace App\Http\Controllers;

use App\Models\BarangayEmployee;
use App\Models\Complaint;
use App\Models\IncidentReport;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::all();

        return view('complaints.index', compact('complaints'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $incidentReports = IncidentReport::all();
        $barangayEmployees = BarangayEmployee::all();
        return view('complaints.create', compact('incidentReports', 'barangayEmployees'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'incident_id' => 'required|exists:incident_reports,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'remarks' => 'required|string' ,
            'status' => 'required|string|max:50' ,
        ]);

        Complaint::create($validated);
        return redirect()->route('complaints.index')->with('success', 'Complaint Added');
   
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        $incidentReports = IncidentReport::all();
        $barangayEmployees = BarangayEmployee::all();
        return view('complaints.edit', compact('incidentReports', 'barangayEmployees', 'complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'incident_id' => 'required|exists:incident_reports,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'remarks' => 'required|string' ,
            'status' => 'required|string|max:50' ,
        ]);

        $complaint->update($validated);

        return redirect()->route('complaints.index')->with('success', "Complaint updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully.');
    }
}
