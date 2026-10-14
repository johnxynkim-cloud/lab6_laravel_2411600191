@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-between items-center mb-2">
    <div>
        <h1 class="text-3xl font-bold text-[#1e7e34]">Inventory Analytics & Management</h1>
        <p class="text-gray-500 text-sm mt-1">Real-time dynamic stock monitoring and data visualization</p>
    </div>
    <a href="{{ route('products.index') }}" class="tf-btn-primary">View All Products</a>
</div>

<!-- Low Stock Warning Alert -->
@if($lowStockProducts->count() > 0)
    <div class="bg-[#fef3c7] border border-[#f59e0b] text-[#92400e] px-4 py-3 rounded-lg my-6 flex items-center space-x-3 text-sm shadow-sm">
        <span class="text-amber-500 font-bold text-lg">⚠️</span>
        <div>
            <strong class="font-bold text-amber-900">Attention Required!</strong> 
            There are <span class="font-semibold">{{ $lowStockProducts->count() }}</span> products at or below reorder levels ({{ $lowStockProducts->pluck('name')->implode(', ') }}).
        </div>
    </div>
@endif

<!-- Summary Metrics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 mt-4">
    <div class="tf-card p-6">
        <span class="tf-card-title">Total Products</span>
        <div class="tf-card-value mt-2">{{ $totalProducts }}</div>
    </div>
    <div class="tf-card p-6">
        <span class="tf-card-title">Total Stock Value</span>
        <div class="tf-card-value mt-2">${{ number_format($totalValue, 2) }}</div>
    </div>
    <div class="tf-card p-6">
        <span class="tf-card-title">Low Stock Items</span>
        <div class="tf-card-value mt-2 text-amber-500">{{ $lowStockCount }}</div>
    </div>
</div>

<!-- Recently Added Products Table -->
<div class="tf-table-container">
    <div class="p-4 bg-gray-50 border-b border-gray-200">
        <h2 class="text-lg font-bold text-[#1e7e34]">Recently Added Products</h2>
    </div>
    <table class="w-full text-left tf-table">
        <thead>
            <tr>
                <th class="p-3">SKU</th>
                <th class="p-3">Name</th>
                <th class="p-3">Category</th>
                <th class="p-3">Price</th>
                <th class="p-3">Qty</th>
                <th class="p-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentProducts as $product)
            <tr class="{{ $product->quantity <= $product->reorder_level ? 'low-stock-row' : 'border-b hover:bg-gray-50' }}">
                <td class="p-3 font-mono text-sm">{{ $product->sku }}</td>
                <td class="p-3 font-medium">{{ $product->name }}</td>
                <td class="p-3">{{ $product->category }}</td>
                <td class="p-3">${{ number_format($product->unit_price, 2) }}</td>
                <td class="p-3">{{ $product->quantity }}</td>
                <td class="p-3">
                    @if($product->quantity == 0)
                        <span class="tf-badge tf-badge-danger">out of stock</span>
                    @elseif($product->quantity <= $product->reorder_level)
                        <span class="tf-badge tf-badge-warning">warning</span>
                    @else
                        <span class="tf-badge tf-badge-success">success</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-4 text-center text-gray-500">No products available.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- AJAX Polling Script for Real-Time Updates -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function fetchDashboardStats() {
            fetch('/api/dashboard/stats')
                .then(response => response.json())
                .then(data => {
                    // Update metric cards if IDs exist
                    const totalProductsEl = document.getElementById('total-products');
                    const lowStockEl = document.getElementById('low-stock-count');
                    
                    if (totalProductsEl) totalProductsEl.innerText = data.total_products;
                    if (lowStockEl) lowStockEl.innerText = data.low_stock_count;

                    // Update recent transactions table if it exists
                    const tbody = document.querySelector('#recent-transactions-table tbody');
                    if (tbody && data.recent_transactions) {
                        tbody.innerHTML = '';

                        if (data.recent_transactions.length > 0) {
                            data.recent_transactions.forEach(tx => {
                                const badgeClass = tx.type === 'stock_in' ? 'success' : (tx.type === 'stock_out' ? 'danger' : 'warning');
                                const formattedType = tx.type.replace('_', ' ').toUpperCase();
                                const dateStr = new Date(tx.created_at).toLocaleString();

                                const row = `<tr>
                                    <td>${dateStr}</td>
                                    <td>${tx.product ? tx.product.name : 'N/A'}</td>
                                    <td><span class="badge bg-${badgeClass}">${formattedType}</span></td>
                                    <td>${tx.quantity}</td>
                                    <td>${tx.user ? tx.user.name : 'System'}</td>
                                </tr>`;
                                tbody.innerHTML += row;
                            });
                        } else {
                            tbody.innerHTML = `<tr><td colspan="5" class="text-center">No recent transactions found.</td></tr>`;
                        }
                    }
                })
                .catch(error => console.error('Error fetching dashboard stats:', error));
        }

        // Fetch immediately on load, then every 30 seconds
        fetchDashboardStats();
        setInterval(fetchDashboardStats, 30000);
    });
</script>
@endsection