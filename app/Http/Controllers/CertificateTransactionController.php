<?php

namespace App\Http\Controllers;

use App\Models\CertificateTransaction;
use Illuminate\Http\Request;

class CertificateTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificateTransactions = CertificateTransaction::all();

        return view('certificateTransactions.index', compact('certificateTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('certificateTransactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'certificate_id' => 'required|exists:barangay_certificates,id',
            'amount_paid' => 'required|numeric|min:0|max:99999.99',
            'payment_date' => 'required|date',
            'payment_status' => 'required|in:Paid,Pending,Failed'
        ]);

        CertificateTransaction::create($validated);
        return redirect()->route('certificateTransactions.index')->with('success', 'Certificate Transaction Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(CertificateTransaction $certificateTransaction)
    {
        return view('certificateTransactions.show', compact('certificateTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CertificateTransaction $certificateTransaction)
    {
        return view('certificateTransactions.edit', compact('certificateTransaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CertificateTransaction $certificateTransaction)
    {
        $validated = $request->validate([
            'certificate_id' => 'required|exists:barangay_certificates,id',
            'amount_paid' => 'required|numeric|min:0|max:99999.99',
            'payment_date' => 'required|date',
            'payment_status' => 'required|in:Paid,Pending,Failed'
        ]);

        $certificateTransaction->update($validated);

        return redirect()->route('certificateTransactions.index')->with('success', "Certificate updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertificateTransaction $certificateTransaction)
    {
        $certificateTransaction->delete();

        return redirect()->route('certificateTransactions.index')->with('success', "Certificate deleted successfully.");
    }
}
