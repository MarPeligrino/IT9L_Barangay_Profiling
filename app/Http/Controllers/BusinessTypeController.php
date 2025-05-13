<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = BusinessType::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $sortableFields = ['name', 'description', 'created_at', 'updated_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $businessTypes = $query->orderBy($sortBy, $order)
                               ->paginate(10)
                               ->appends($request->except('page'));

        return view('businessTypes.index', compact('businessTypes'));
    }

    public function create()
    {
        return view('businessTypes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $type = BusinessType::create($validated);

        // 🔔 Log activity
        log_activity("BusinessType created: {$type->name}");

        return redirect()->route('businessTypes.index')->with('success', 'Business Type added!');
    }

    public function show(BusinessType $businessType)
    {
        return view('businessTypes.show', compact('businessType'));
    }

    public function edit(BusinessType $businessType)
    {
        return view('businessTypes.edit', compact('businessType'));
    }

    public function update(Request $request, BusinessType $businessType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $businessType->update($validated);

        // 🔔 Log activity
        log_activity("BusinessType updated: {$businessType->name}");

        return redirect()->route('businessTypes.index')->with('success', "Business Type updated successfully.");
    }

    public function destroy(BusinessType $businessType)
    {
        // 🔔 Log activity
        log_activity("BusinessType deleted: {$businessType->name}");

        $businessType->delete();

        return redirect()->route('businessTypes.index')->with('success', "Business Type deleted successfully.");
    }
}
