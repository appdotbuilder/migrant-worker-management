<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinancialTransactionRequest;
use App\Http\Requests\UpdateFinancialTransactionRequest;
use App\Models\FinancialTransaction;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FinancialTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = FinancialTransaction::with(['member', 'creator'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $summary = [
            'total_income' => FinancialTransaction::income()->sum('amount'),
            'total_expense' => FinancialTransaction::expense()->sum('amount'),
        ];
        $summary['balance'] = $summary['total_income'] - $summary['total_expense'];
        
        return Inertia::render('financial-transactions/index', [
            'transactions' => $transactions,
            'summary' => $summary
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::select('id', 'member_number', 'full_name')
            ->orderBy('full_name')
            ->get();
            
        return Inertia::render('financial-transactions/create', [
            'members' => $members
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFinancialTransactionRequest $request)
    {
        $data = $request->validated();
        $data['transaction_number'] = FinancialTransaction::generateTransactionNumber($data['type']);
        $data['created_by'] = Auth::id();
        
        $transaction = FinancialTransaction::create($data);

        return redirect()->route('financial-transactions.show', $transaction)
            ->with('success', 'Transaksi keuangan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialTransaction $financialTransaction)
    {
        $financialTransaction->load(['member', 'creator']);
        
        return Inertia::render('financial-transactions/show', [
            'transaction' => $financialTransaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialTransaction $financialTransaction)
    {
        $members = Member::select('id', 'member_number', 'full_name')
            ->orderBy('full_name')
            ->get();
            
        return Inertia::render('financial-transactions/edit', [
            'transaction' => $financialTransaction,
            'members' => $members
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinancialTransactionRequest $request, FinancialTransaction $financialTransaction)
    {
        $financialTransaction->update($request->validated());

        return redirect()->route('financial-transactions.show', $financialTransaction)
            ->with('success', 'Transaksi keuangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialTransaction $financialTransaction)
    {
        $financialTransaction->delete();

        return redirect()->route('financial-transactions.index')
            ->with('success', 'Transaksi keuangan berhasil dihapus.');
    }
}