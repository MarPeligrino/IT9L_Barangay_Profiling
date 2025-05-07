<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\Business;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = Business::with(['owner', 'type'])->get();
        return view('businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = Resident::all();
        $businesstypes = BusinessType::all();

        return view('businesses.create', compact('owners', 'businesstypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:residents,id',
            'business_type_id' => 'required|exists:business_types,id',
            'business_name' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
        ]);

        Business::create($validated);
        return redirect()->route('barangayemployees.index')->with('sucess', 'Business Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        return view('businesses.show', compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        $owners = Resident::all();
        $businesstypes = BusinessType::all();

        return view('households.edit', compact('household', 'owners', 'businesstypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:residents,id',
            'business_type_id' => 'required|exists:business_types,id',
            'business_name' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
        ]);

        $business->update($validated);

        return redirect()->route('businesses.index')->with('success', "Business updated successfully.");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $business->delete();

        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully.');

    }
}
