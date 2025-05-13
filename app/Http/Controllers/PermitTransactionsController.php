<?php

namespace App\Http\Controllers;

use App\Models\PermitTransaction;
use App\Models\BusinessPermit;
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
            'business_id' => 'required|exists:businesses,id',
            'barangay_employee_id' => 'required|exists:barangay_employees,id',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        $permit = BusinessPermit::create($validated);

        // 🔔 Log activity
        log_activity("Business Permit issued to business ID {$permit->business_id} by employee ID {$permit->barangay_employee_id}");

        // ✅ Automatically create a Permit Transaction
        PermitTransaction::create([
            'business_permit_id' => $permit->id,
            'amount_paid' => 0.00,
            'payment_date' => now(),
            'payment_status' => 'Paid'
        ]);

        return redirect()->route('businessPermits.index')->with('success', 'Business Permit added and transaction logged.');
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
