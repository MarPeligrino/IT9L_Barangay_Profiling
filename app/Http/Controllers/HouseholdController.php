<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Household;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $households = Household::all();
        return view('households.index', compact('households'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('households.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purok' => 'required|string|max:255',
            'street_number' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'apartment_unit' => 'nullable|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'country' => 'required|string|max:255'
        ]);

        Household::create($validated);

        return redirect()->route('households.index')->with('success', 'Household added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Household $household)
    {
        return view('households.show', compact('household'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Household $household)
    {
        return view('households.edit', compact('household'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Household $household)
    {
        $validated = $request->validate([
            'purok' => 'required|string|max:255',
            'street_number' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'apartment_unit' => 'nullable|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'country' => 'required|string|max:255'
        ]);

        $household->update($validated);

        return redirect()->route('households.index')->with('success', "Household updated successfully.");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Household $household)
    {
        $household->delete();

        return redirect()->route('households.index')->with('success', "Household deleted successfully.");
    }
}
