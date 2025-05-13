<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use Illuminate\Http\Request;

class CertificateTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificateTypes = CertificateType::all();

        return view('certificateTypes.index', compact('certificateTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('certificateTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'certificate_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'validity' => 'required|date',
            'fee' => 'required|numeric|min:0|max:99999.99'
        ]);

        CertificateType::create($validated);
        return redirect()->route('certificateTypes.index')->with('success', 'Certificate Type Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(CertificateType $certificateType)
    {
        return view('certificateTypes.show', compact('certificateType'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CertificateType $certificateType)
    {
        return view('certificateTypes.edit', compact('certificateType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CertificateType $certificateType)
    {
        $validated = $request->validate([
            'certificate_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'validity' => 'required|date',
            'fee' => 'required|numeric|min:0|max:99999.99'
        ]);
        $certificateType->update($validated);

        return redirect()->route('certificateTypes.index')->with('success', "Certificate updated successfully.");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertificateType $certificateType)
    {
        $certificateType->delete();

        return redirect()->route('certificateTypes.index')->with('success', "Certificate deleted successfully.");
    }
}
