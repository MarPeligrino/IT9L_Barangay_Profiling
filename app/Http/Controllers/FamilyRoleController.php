<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyRole;


class FamilyRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FamilyRole::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('role', 'like', "%{$search}%")
                ->orWhere('relationship', 'like', "%{$search}%");
            });
        }

        if ($relationship = $request->input('relationship')) {
            $query->where('relationship', $relationship);
        }

        $sortableFields = ['role', 'relationship', 'created_at', 'updated_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $familyroles = $query->orderBy($sortBy, $order)
                            ->paginate(10)
                            ->appends($request->except('page'));

        // For filter dropdown
        $allRelationships = FamilyRole::select('relationship')->distinct()->pluck('relationship');

        return view('familyroles.index', compact('familyroles', 'allRelationships'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('familyroles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|string|max:255',
            'relationship' => 'required|string|max:255'
        ]);

        FamilyRole::create($validated);
        return redirect()->route('familyroles.index')->with('success', 'FamilyRole Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(FamilyRole $familyRole)
    {
        return view('familyroles.show', compact('familyRole'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FamilyRole $familyrole)
    {
        return view('familyroles.edit', compact('familyrole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyRole $familyrole)
    {
        $validated = $request->validate([
            'role' => 'required|string|max:255',
            'relationship' => 'required|string|max:255'
        ]);

        $familyrole->update($validated);

        return redirect()->route('familyroles.index')->with('success', "FamilyRole updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyRole $familyrole)
    {
        $familyrole->delete();

        return redirect()->route('familyroles.index')->with('success', "FamilyRole deleted successfully.");
    }
}
