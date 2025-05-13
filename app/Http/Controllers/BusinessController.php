<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BusinessType;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\Business;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Business::with(['owner', 'type', 'address']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%");
            });
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = Resident::all();
        $businesstypes = BusinessType::all();
        $addresses = Address::all();

        return view('businesses.create', compact('owners', 'businesstypes', 'addresses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:residents,id',
            'business_type_id' => 'required|exists:business_types,id',
            'business_address_id' => 'required|exists:addresses,id',
            'business_name' => 'required|string|max:255'
        ]);

        Business::create($validated);
        return redirect()->route('businesses.index')->with('success', 'Business Added');
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
        $addresses = Address::all();

        return view('businesses.edit', compact('business', 'owners', 'businesstypes', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:residents,id',
            'business_type_id' => 'required|exists:business_types,id',
            'business_address_id' => 'required|exists:addresses,id',
            'business_name' => 'required|string|max:255'
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
