<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalValue = Product::selectRaw('SUM(unit_price * quantity) as total_val')->value('total_val') ?? 0;
        
        // Fetch low-stock products
        $lowStockProducts = Product::whereColumn('quantity', '<=', 'reorder_level')->get();
        $lowStockCount = $lowStockProducts->count();

        $recentProducts = Product::latest()->take(7)->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalValue',
            'lowStockCount',
            'lowStockProducts',
            'recentProducts'
        ));
    }
}