<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Resident;
use App\Models\BusinessType;
use App\Models\Address;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $query = Business::with(['owner', 'type', 'address']);

        if ($search = $request->input('search')) {
            $query->where('business_name', 'like', "%{$search}%");
        }

        if ($type = $request->input('type')) {
            $query->where('business_type_id', $type);
        }

        $sortableFields = ['business_name', 'created_at', 'updated_at'];
        $sortBy = in_array($request->input('sort_by'), $sortableFields) ? $request->input('sort_by') : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $businesses = $query->orderBy($sortBy, $order)
                            ->paginate(10)
                            ->appends($request->except('page'));

        $businesstypes = BusinessType::all();

        return view('businesses.index', compact('businesses', 'businesstypes'));
    }

    public function create()
    {
        $owners = Resident::all();
        $businesstypes = BusinessType::all();
        $addresses = Address::all();

        return view('businesses.create', compact('owners', 'businesstypes', 'addresses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:residents,id',
            'business_type_id' => 'required|exists:business_types,id',
            'business_address_id' => 'required|exists:addresses,id',
            'business_name' => 'required|string|max:255'
        ]);

        $business = Business::create($validated);

        // 🔔 Log activity
        log_activity("New business added: {$business->business_name}");

        return redirect()->route('businesses.index')->with('success', 'Business added!');
    }

    public function show(Business $business)
    {
        return view('businesses.show', compact('business'));
    }

    public function edit(Business $business)
    {
        $owners = Resident::all();
        $businesstypes = BusinessType::all();
        $addresses = Address::all();

        return view('businesses.edit', compact('business', 'owners', 'businesstypes', 'addresses'));
    }

    public function update(Request $request, Business $business)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:residents,id',
            'business_type_id' => 'required|exists:business_types,id',
            'business_address_id' => 'required|exists:addresses,id',
            'business_name' => 'required|string|max:255'
        ]);

        $business->update($validated);

        // 🔔 Log activity
        log_activity("Business updated: {$business->business_name}");

        return redirect()->route('businesses.index')->with('success', 'Business updated successfully.');
    }

    public function destroy(Business $business)
    {
        // 🔔 Log activity
        log_activity("Business deleted: {$business->business_name}");

        $business->delete();

        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully.');
    }
}
