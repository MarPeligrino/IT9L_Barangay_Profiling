<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Address;
use App\Models\FamilyRole;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residents = Resident::with('household')->get();
        return view('residents.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $addresses = Address::all();
        $familyroles = FamilyRole::all();

        return view('residents.create', [
            'households' => $addresses,
            'currentaddress' => $addresses,
            'familyroles' => $familyroles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'household_id' => 'required|exists:addresses,id',
            'family_role_id' => 'required|exists:family_roles,id',
            'current_address_id' => 'required|exists:addresses,id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'sex' => 'required|string',
            'birthday' => 'required|date',
            'civil_status' => 'required|string|max:50',
            'contact_number' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255'
        ]);

        Resident::create($validated);

        return redirect()->route('residents.index')->with('success', 'Resident added!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Resident $resident)
    {
        return view('residents.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resident $resident)
    {
        $addresses = Address::all();
        $familyroles = FamilyRole::all();

        return view('residents.edit', [
            'resident' => $resident,               
            'households' => $addresses,
            'currentaddress' => $addresses,
            'familyroles' => $familyroles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'household_id' => 'required|exists:addresses,id',
            'family_role_id' => 'required|exists:family_roles,id',
            'current_address_id' => 'required|exists:addresses,id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'sex' => 'required|string',
            'birthday' => 'required|date',
            'civil_status' => 'required|string|max:50',
            'contact_number' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255'
        ]);
        $resident->update($validated);

        return redirect()->route('residents.index')->with('success', 'Resident updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resident $resident)
    {
        $resident->delete();

        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully.');
    }
}
