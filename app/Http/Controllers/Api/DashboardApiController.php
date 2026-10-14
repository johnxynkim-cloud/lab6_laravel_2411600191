<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class DashboardApiController extends Controller
{
    public function getStats(): JsonResponse
    {
        return response()->json([
            'totalProducts' => Product::count(),
            'lowStockCount' => Product::lowStock()->count(),
            'outOfStockCount' => Product::outOfStock()->count(),
            'totalInventoryValue' => (float) Product::selectRaw('SUM(quantity * unit_price) as total')->value('total') ?? 0,
            'timestamp' => now()->format('Y-m-d H:i:s'),
        ]);
    }

    public function getLowStockProducts(): JsonResponse
    {
        $products = Product::lowStock()->select('id', 'name', 'sku', 'quantity', 'reorder_level')->get();
        return response()->json($products);
    }

    public function getRecentTransactions(): JsonResponse
    {
        $transactions = InventoryTransaction::with(['product:id,name', 'user:id,name'])
            ->recent()
            ->take(5)
            ->get();

        return response()->json($transactions);
    }
}