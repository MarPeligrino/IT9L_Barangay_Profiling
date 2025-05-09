<?php

namespace App\Http\Controllers;

use App\Models\BarangayEmployee;
use App\Models\IncidentReport;
use Illuminate\Http\Request;

class IncidentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidentReports = IncidentReport::all();

        return view('incidentReports.index', compact('incidentReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangayEmployees = BarangayEmployee::all();
        return view('incidentReports.create', compact('barangayEmployees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'report_date' => 'required|date',
            'remarks' => 'required|string' ,
            'status' => 'required|string|max:50' ,
        ]);

        IncidentReport::create($validated);
        return redirect()->route('incidentReports.index')->with('success', 'IncidentReport Added');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(IncidentReport $incidentReport)
    {
        return view('incidentReports.show', compact('incidentReport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncidentReport $incidentReport)
    {
        $barangayEmployees = BarangayEmployee::all();
        return view('incidentReports.edit', compact('barangayEmployees', 'incidentReport'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncidentReport $incidentReport)
    {
        $validated = $request->validate([
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'report_date' => 'required|date',
            'remarks' => 'required|string' ,
            'status' => 'required|string|max:50' ,
        ]);

        $incidentReport->update($validated);

        return redirect()->route('incidentReports.index')->with('success', "IncidentReport updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncidentReport $incidentReport)
    {
        $incidentReport->delete();

        return redirect()->route('incidentReports.index')->with('success', 'IncidentReport deleted successfully.');
    
    
    }
}
