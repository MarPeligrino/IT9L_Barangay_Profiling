<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Models\IncidentReportParty;
use App\Models\Resident;
use Illuminate\Http\Request;

class IncidentReportPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidentParties = IncidentReportParty::with(['resident', 'incidentReport'])->get();

        return view('incidentParties.index', compact('incidentParties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $residents = Resident::all();
        $incidentReports = IncidentReport::all();
        return view('incidentParties.create', compact('residents', 'incidentReports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'incident_report_id' => 'required|exists:incident_reports,id',
            'resident_id' => 'required|exists:residents,id',
            'role' => 'required|string|max:50' ,
        ]);

        IncidentReportParty::create($validated);
        return redirect()->route('incidentParties.index')->with('success', 'Incident Party Added');
    
    
    }

    /**
     * Display the specified resource.
     */
    public function show(IncidentReportParty $incidentReportParty)
    {
        return view('incidentParties.show', compact('incidentReportParty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncidentReportParty $incidentReportParty)
    {
        $residents = Resident::all();
        $incidentReports = IncidentReport::all();
        return view('incidentParties.edit', compact('residents', 'incidentReports', 'incidentReportParty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncidentReportParty $incidentReportParty)
    {
        $validated = $request->validate([
            'incident_report_id' => 'required|exists:incident_reports,id',
            'resident_id' => 'required|exists:residents,id',
            'role' => 'required|string|max:50' ,
        ]);
        
        $incidentReportParty->update($validated);

        return redirect()->route('incidentParties.index')->with('success', "Incident Party updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncidentReportParty $incidentReportParty)
    {
        $incidentReportParty->delete();

        return redirect()->route('incidentParties.index')->with('success', 'Incident Party deleted successfully.');
    
    }
}
