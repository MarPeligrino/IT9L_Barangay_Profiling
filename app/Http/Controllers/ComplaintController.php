<?php

namespace App\Http\Controllers;

use App\Models\BarangayEmployee;
use App\Models\Complaint;
use App\Models\ComplaintReportParties;
use App\Models\IncidentReport;
use App\Models\Resident;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with(['incident', 'barangayEmployee']);

        // Search
        if ($search = $request->input('search')) {
            $query->whereHas('barangayEmployee', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            })->orWhere('remarks', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
        }

        // Filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Sorting
        $sortableFields = ['created_at', 'updated_at', 'status'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $complaints = $query->orderBy($sortBy, $order)
                            ->paginate(10)
                            ->appends($request->except('page'));

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        $incidentReports = IncidentReport::all();
        $barangayEmployees = BarangayEmployee::all();
        $residents = Resident::all();

        return view('complaints.create', compact('incidentReports', 'barangayEmployees', 'residents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'incident_id' => 'required|exists:incident_reports,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'remarks' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'parties.*.resident_id' => 'required|exists:residents,id',
            'parties.*.role' => 'required|in:complainant,respondent,witness',
        ]);

        $complaint = Complaint::create([
            'incident_id' => $validated['incident_id'],
            'barangay_employee_id' => $validated['barangay_employee_id'],
            'remarks' => $validated['remarks'] ?? null,
            'status' => $validated['status'],
        ]);

        foreach ($request->input('parties', []) as $party) {
            $complaint->parties()->create([
                'resident_id' => $party['resident_id'],
                'role' => $party['role'],
            ]);
        }

        log_activity("New complaint added: Linked to Incident ID {$complaint->incident_id} by Employee ID {$complaint->barangay_employee_id}");

        return redirect()->route('complaints.index')->with('success', 'Complaint added successfully.');
    }

    public function show(Complaint $complaint)
    {
        $complaint->load(['parties', 'incident', 'barangayEmployee']);
        return view('complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        $incidentReports = IncidentReport::all();
        $barangayEmployees = BarangayEmployee::all();
        $residents = Resident::all();
        $complaint->load('parties');

        return view('complaints.edit', compact('complaint', 'incidentReports', 'barangayEmployees', 'residents'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'incident_id' => 'required|exists:incident_reports,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'remarks' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'parties.*.resident_id' => 'required|exists:residents,id',
            'parties.*.role' => 'required|in:complainant,respondent,witness',
        ]);

        $complaint->update([
            'incident_id' => $validated['incident_id'],
            'barangay_employee_id' => $validated['barangay_employee_id'],
            'remarks' => $validated['remarks'] ?? null,
            'status' => $validated['status'],
        ]);

        $updatedPartyIds = [];

        foreach ($request->input('parties', []) as $partyData) {
            if (isset($partyData['id'])) {
                $party = ComplaintReportParties::find($partyData['id']);
                if ($party && $party->complaint_id == $complaint->id) {
                    $party->update([
                        'resident_id' => $partyData['resident_id'],
                        'role' => $partyData['role'],
                    ]);
                    $updatedPartyIds[] = $party->id;
                }
            } else {
                $newParty = $complaint->parties()->create([
                    'resident_id' => $partyData['resident_id'],
                    'role' => $partyData['role'],
                ]);
                $updatedPartyIds[] = $newParty->id;
            }
        }

        $complaint->parties()->whereNotIn('id', $updatedPartyIds)->delete();

        log_activity("Complaint updated: ID {$complaint->id}");

        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully.');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();

        log_activity("Complaint deleted: ID {$complaint->id}");

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully.');
    }
}
