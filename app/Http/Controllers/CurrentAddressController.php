<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrentAddress;

class CurrentAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentAddresses = CurrentAddress::all();
        return view('currentAddresses.index', compact('currentAddresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('currentAddresses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purok' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'village' => 'nullable|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255'
        ]);

        CurrentAddress::create($validated);

        return redirect()->route('households.index')->with('success', 'Household added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CurrentAddress $household)
    {
        return view('households.show', compact('household'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CurrentAddress $household)
    {
        return view('households.edit', compact('household'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CurrentAddress $household)
    {
        $validated = $request->validate([
            'purok' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'village' => 'nullable|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255'
        ]);

        $household->update($validated);

        return redirect()->route('households.index')->with('success', "Household updated successfully.");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurrentAddress $household)
    {
        $household->delete();

        return redirect()->route('households.index')->with('success', "Household deleted successfully.");
    }
}
