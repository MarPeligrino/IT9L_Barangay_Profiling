<?php

namespace App\Http\Controllers;

use App\Models\BarangayEmployee;
use App\Models\BarangayPosition;
use Illuminate\Http\Request;

class BarangayEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BarangayEmployee::query();

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhereHas('position', function ($subQuery) use ($search) {
                    $subQuery->where('position_name', 'like', "%{$search}%");
                });
            });
        }

        // Filter by Position
        if ($request->filled('position_id')) {
            $query->where('position_id', $request->position_id);
        }

        // Sort
        $sortableFields = ['first_name', 'last_name', 'start_date', 'created_at', 'updated_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields)
            ? $request->input('sort_by')
            : 'created_at';

        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        // Paginate
        $employees = $query->orderBy($sortBy, $order)
                        ->paginate(10)
                        ->appends($request->except('page'));

        // Get all positions for the filter dropdown
        $barangayPositions = BarangayPosition::all();

        return view('barangayemployees.index', compact('employees', 'barangayPositions'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangayPositions = BarangayPosition::all();

        return view('barangayemployees.create', compact('barangayPositions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:barangay_positions,id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'start_date' => 'required|date'
        ]);

        BarangayEmployee::create($validated);
        return redirect()->route('barangayemployees.index')->with('success', 'Barangay Employee Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangayEmployee $barangayemployee)
    {
        return view('barangayemployees.show', compact('barangayemployee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangayEmployee $barangayemployee)
    {
        $barangayPositions = BarangayPosition::all();

        return view('barangayemployees.edit', compact('barangayemployee', 'barangayPositions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangayEmployee $barangayemployee)
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:barangay_positions,id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'start_date' => 'required|date'
        ]);

        $barangayemployee->update($validated);

        return redirect()->route('barangayemployees.index')->with('success', "Barangay Employee updated successfully.");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangayEmployee $barangayemployee)
    {
        $barangayemployee->delete();

        return redirect()->route('barangayemployees.index')->with('success', 'Barangay Employee deleted successfully.');
    }
}
