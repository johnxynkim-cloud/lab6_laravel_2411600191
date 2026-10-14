<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
    {
        $query = InventoryTransaction::with(['product', 'user'])->latest();

        // Optional filtering by type or product if requested
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $transactions = $query->paginate(20);
        $products = Product::all();

        return view('transactions.index', compact('transactions', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'type' => 'required|in:stock_in,stock_out,adjustment',
        'quantity' => 'required|integer|min:1',
        'reference_number' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ]);

    \DB::beginTransaction();
    try {
        $validated['user_id'] = auth()->id();
        InventoryTransaction::create($validated);

        \DB::commit();
        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    } catch (\Exception $e) {
        \DB::rollBack();
        return back()->withErrors(['error' => $e->getMessage()])->withInput();
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryTransaction $transaction)
    {
       $transaction->load(['product', 'user']);
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryTransaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
