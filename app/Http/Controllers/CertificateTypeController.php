<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use Illuminate\Http\Request;

class CertificateTypeController extends Controller
{
    /**
     * Display a listing of the resource with search, sort, and pagination.
     */
    public function index(Request $request)
    {
        $query = CertificateType::query();

        // Search
        if ($search = $request->input('search')) {
            $query->where('certificate_name', 'like', "%{$search}%");
        }

        // Sorting
        $sortableFields = ['certificate_name', 'description', 'validity', 'fee', 'created_at', 'updated_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        // Pagination with applied search & sorting
        $certificateTypes = $query->orderBy($sortBy, $order)
                                  ->paginate(10)
                                  ->appends($request->except('page'));

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
            'description' => 'required|string',
            'validity' => 'required|integer|min:1', // Validity in days
            'fee' => 'required|numeric|min:0|max:99999.99'
        ]);

        $certificateType = CertificateType::create($validated);

        log_activity("Certificate Type added: {$certificateType->certificate_name}");

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
            'description' => 'required|string',
            'validity' => 'required|integer|min:1', // Validity in days
            'fee' => 'required|numeric|min:0|max:99999.99'
        ]);

        $certificateType->update($validated);

        log_activity("Certificate Type updated: {$certificateType->certificate_name}");

        return redirect()->route('certificateTypes.index')->with('success', "Certificate updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertificateType $certificateType)
    {
        log_activity("Certificate Type deleted: {$certificateType->certificate_name}");

        $certificateType->delete();

        return redirect()->route('certificateTypes.index')->with('success', "Certificate deleted successfully.");
    }
}
