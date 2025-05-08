<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::all();
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addresses.create');
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

        Address::create($validated);

        return redirect()->route('addresses.index')->with('success', 'Address added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
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

        $address->update($validated);

        return redirect()->route('addresses.index')->with('success', "Address updated successfully.");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('addresses.index')->with('success', "Address deleted successfully.");
    }
}
