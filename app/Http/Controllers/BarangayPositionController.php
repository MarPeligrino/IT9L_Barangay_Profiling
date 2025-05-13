<?php

namespace App\Http\Controllers;

use App\Models\BarangayPosition;
use Illuminate\Http\Request;

class BarangayPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BarangayPosition::query();

        // Search by name or description
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sortable fields
        $sortableFields = ['name', 'description', 'created_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        // Pagination with query string persistence
        $barangaypositions = $query->orderBy($sortBy, $order)
                        ->paginate(10)
                        ->appends($request->except('page'));

        return view('barangaypositions.index', compact('barangaypositions'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barangaypositions.create');
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
    public function show(BarangayPosition $barangayposition)
    {
        return view('barangaypositions.show', compact('barangayposition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangayPosition $barangayposition)
    {
        return view('barangaypositions.edit', compact('barangayposition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangayPosition $barangayposition)
    {
        $validated = $request->validate([
            'position_name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $barangayposition->update($validated);

        return redirect()->route('barangaypositions.index')->with('success', "BarangayPosition updated successfully.");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangayPosition $barangayposition)
    {
        $barangayposition->delete();

        return redirect()->route('barangaypositions.index')->with('success', "BarangayPosition deleted successfully.");
    }
}
