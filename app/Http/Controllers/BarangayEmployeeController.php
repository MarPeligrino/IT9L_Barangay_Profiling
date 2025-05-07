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
    public function index()
    {
        $barangayemployees = BarangayEmployee::all();
        return view('barangayemployees.index', compact('barangayemployees'));
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
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255'
        ]);

        BarangayEmployee::create($validated);
        return redirect()->route('barangayemployees.index')->with('sucess', 'BarangayEmployee Added');
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
            'middle_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'contact_number' => 'required|string|max:255',
        ]);

        $barangayemployee->update($validated);

        return redirect()->route('barangayemployees.index')->with('success', "BarangayEmployee updated successfully.");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangayEmployee $barangayemployee)
    {
        $barangayemployee->delete();

        return redirect()->route('barangayemployees.index')->with('success', 'BarangayEmployee deleted successfully.');
    }
}
