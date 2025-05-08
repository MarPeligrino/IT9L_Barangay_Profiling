<?php

namespace App\Http\Controllers;

use App\Models\PermitTransaction;
use Illuminate\Http\Request;

class PermitTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permitTransactions = PermitTransaction::all();

        return view('permitTransactions.index', compact('permitTransactions'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permitTransactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_permit_id' => 'required|exists:business_permits,id',
            'amount_paid' => 'required|numeric|min:0|max:99999.99',
            'payment_date' => 'required|date',
            'payment_status' => 'required|in:Paid,Pending,Failed'
        ]);

        PermitTransaction::create($validated);
        return redirect()->route('permitTransactions.index')->with('success', 'PermitTransaction Added');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(PermitTransaction $permitTransaction)
    {
        return view('permitTransactions.show', compact('permitTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermitTransaction $permitTransaction)
    {
        return view('permitTransactions.edit', compact('permitTransaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PermitTransaction $permitTransaction)
    {
        $validated = $request->validate([
            'business_permit_id' => 'required|exists:business_permits,id',
            'amount_paid' => 'required|numeric|min:0|max:99999.99',
            'payment_date' => 'required|date',
            'payment_status' => 'required|in:Paid,Pending,Failed'
        ]);

        $permitTransaction->update($validated);

        return redirect()->route('permitTransactions.index')->with('success', "PermitTransaction updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PermitTransaction $permitTransaction)
    {
        $permitTransaction->delete();

        return redirect()->route('permitTransactions.index')->with('success', "PermitTransaction deleted successfully.");
    }
}
