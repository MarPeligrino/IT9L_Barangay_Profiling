<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Models\BarangayEmployee;
use App\Models\IncidentReportParty;
use App\Models\Resident; // ✅ Include Resident model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IncidentReportController extends Controller
{
    public function index(Request $request)
    {
        $query = IncidentReport::with('barangayEmployee');

        if ($search = $request->input('search')) {
            $query->whereHas('barangayEmployee', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            })->orWhere('remarks', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
        }

        $sortableFields = ['report_date', 'status', 'created_at', 'updated_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $incidentReports = $query->orderBy($sortBy, $order)
                                 ->paginate(10)
                                 ->appends($request->except('page'));

        return view('incidentReports.index', compact('incidentReports'));
    }

    public function create()
    {
        $barangayEmployees = BarangayEmployee::all();
        $residents = Resident::all(); // ✅ Fix: now passed to the view

        return view('incidentReports.create', compact('barangayEmployees', 'residents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'report_date' => 'required|date',
            'remarks' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,resolved,closed',

            // Nested party validation
            'parties.*.resident_id' => 'required|exists:residents,id',
            'parties.*.role' => 'required|in:complainant,respondent,witness',
        ]);

        // Create Incident Report
        $incidentReport = IncidentReport::create([
            'barangay_employee_id' => $validated['barangay_employee_id'],
            'report_date' => $validated['report_date'],
            'remarks' => $validated['remarks'] ?? null,
            'status' => $validated['status'],
        ]);

        // Save linked parties
        if ($request->has('parties')) {
            foreach ($request->input('parties') as $party) {
                $incidentReport->parties()->create([
                    'resident_id' => $party['resident_id'],
                    'role' => $party['role'],
                ]);
            }
        }

        Log::info('Incident report created with parties.', ['id' => $incidentReport->id]);

        return redirect()->route('incidentReports.index')->with('success', 'Incident Report added successfully.');
    }


    public function edit(IncidentReport $incidentReport)
    {
        $barangayEmployees = BarangayEmployee::all();
        $residents = Resident::all(); // ✅ Add this

        return view('incidentReports.edit', compact('incidentReport', 'barangayEmployees', 'residents'));
    }

    public function update(Request $request, IncidentReport $incidentReport)
    {
        $validated = $request->validate([
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'report_date' => 'required|date',
            'remarks' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,resolved,closed',

            // Validate nested party data
            'parties.*.resident_id' => 'required|exists:residents,id',
            'parties.*.role' => 'required|in:complainant,respondent,witness',
        ]);

        // Update main report
        $incidentReport->update([
            'barangay_employee_id' => $validated['barangay_employee_id'],
            'report_date' => $validated['report_date'],
            'remarks' => $validated['remarks'] ?? null,
            'status' => $validated['status'],
        ]);

        // Track party IDs to keep
        $updatedPartyIds = [];

        if ($request->has('parties')) {
            foreach ($request->input('parties') as $partyData) {
                if (isset($partyData['id'])) {
                    // Update existing party
                    $party = IncidentReportParty::find($partyData['id']);
                    if ($party && $party->incident_report_id == $incidentReport->id) {
                        $party->update([
                            'resident_id' => $partyData['resident_id'],
                            'role' => $partyData['role'],
                        ]);
                        $updatedPartyIds[] = $party->id;
                    }
                } else {
                    // Create new party
                    $newParty = $incidentReport->parties()->create([
                        'resident_id' => $partyData['resident_id'],
                        'role' => $partyData['role'],
                    ]);
                    $updatedPartyIds[] = $newParty->id;
                }
            }
        }

        // Delete removed parties
        $incidentReport->parties()->whereNotIn('id', $updatedPartyIds)->delete();

        Log::info('Incident report updated with parties.', ['id' => $incidentReport->id]);

        return redirect()->route('incidentReports.index')->with('success', 'Incident Report updated successfully.');
    }
    public function destroy(IncidentReport $incidentReport)
    {
        $incidentReport->delete();

        Log::warning('Incident report deleted.', ['id' => $incidentReport->id]);

        return redirect()->route('incidentReports.index')->with('success', 'Incident Report deleted successfully.');
    }
}
