<?php

namespace App\Http\Controllers;

use App\Models\BarangayEmployee;
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
        return view('barangayemployees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'position_name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        BarangayPosition::create($validated);
        return redirect()->route('barangaypositions.index')->with('sucess', 'BarangayPosition Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
