<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businessTypes = BusinessType::all();

        return view('businessTypes.index', compact('businessTypes'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('businessTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        BusinessType::create($validated);
        return redirect()->route('businessTypes.index')->with('success', 'BusinessType Added');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessType $businessType)
    {
        return view('businessTypes.show', compact('businessType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessType $businessType)
    {
        return view('businessTypes.edit', compact('businessType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusinessType $businessType)
    {
        $validated = $request->validate([
            'role' => 'required|string|max:255',
            'relationship' => 'required|string|max:255'
        ]);

        $businessType->update($validated);

        return redirect()->route('businessTypes.index')->with('success', "BusinessType updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessType $businessType)
    {
        $businessType->delete();

        return redirect()->route('businessTypes.index')->with('success', "BusinessType deleted successfully.");
    }
}
