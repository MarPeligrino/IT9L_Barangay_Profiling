<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintReportParty;
use App\Models\Resident;
use Illuminate\Http\Request;

class ComplaintPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaintReportParty = ComplaintReportParty::with(['resident', 'complaintReport'])->get();

        return view('complaintParty.index', compact('complaintReportParty'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $residents = Resident::all();
        $complaintReports = Complaint::all();
        return view('complaintParty.create', compact('residents', 'complaintReports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'resident_id' => 'required|exists:residents,id',
            'role' => 'required|string|max:50' ,
        ]);

        ComplaintReportParty::create($validated);
        return redirect()->route('complaintParty.index')->with('success', 'Complaint Party Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplaintReportParty $complaintReportParty)
    {
        return view('complaintParty.show', compact('complaintReportParty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplaintReportParty $complaintReportParty)
    {
        $residents = Resident::all();
        $complaintReports = Complaint::all();
        return view('complaintParty.edit', compact('residents', 'complaintReports', 'complaintReportParty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplaintReportParty $complaintReportParty)
    {
        $validated = $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'resident_id' => 'required|exists:residents,id',
            'role' => 'required|string|max:50' ,
        ]);
        $complaintReportParty->update($validated);

        return redirect()->route('complaintParty.index')->with('success', "Complaint Party updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplaintReportParty $complaintReportParty)
    {
        $complaintReportParty->delete();

        return redirect()->route('complaintParty.index')->with('success', 'Complaint Party deleted successfully.');
    }
}
