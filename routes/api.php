<?php
use App\Models\Product;
use App\Models\InventoryTransaction;

Route::get('/dashboard/stats', function () {
    return response()->json([
        'total_products' => Product::count(),
        'low_stock_count' => Product::whereColumn('quantity', '<=', 'reorder_level')->count(),
        'recent_transactions' => InventoryTransaction::with(['product', 'user'])->latest()->take(5)->get(),
    ]);
});