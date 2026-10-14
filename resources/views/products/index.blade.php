@extends('layouts.app')

@section('title', 'Product Inventory')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Product Inventory</h1>
    <div class="space-x-2">
        <a href="{{ route('dashboard') }}" class="tf-btn-secondary">Back to Dashboard</a>
        <a href="{{ route('products.create') }}" class="tf-btn-primary">+ Add Product</a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="tf-table-container">
    <table class="w-full text-left tf-table">
        <thead>
            <tr>
                <th class="p-3">SKU</th>
                <th class="p-3">Name</th>
                <th class="p-3">Category</th>
                <th class="p-3">Price</th>
                <th class="p-3">Qty</th>
                <th class="p-3">Status</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="{{ $product->quantity <= $product->reorder_level ? 'low-stock-row' : 'border-b hover:bg-gray-50' }}">
                <td class="p-3 font-mono text-sm">{{ $product->sku }}</td>
                <td class="p-3 font-medium">{{ $product->name }}</td>
                <td class="p-3">{{ $product->category }}</td>
                <td class="p-3">${{ number_format($product->unit_price, 2) }}</td>
                <td class="p-3">{{ $product->quantity }}</td>
                <td class="p-3">
                    @if($product->quantity == 0)
                        <span class="tf-badge tf-badge-danger">Out of Stock</span>
                    @elseif($product->quantity <= $product->reorder_level)
                        <span class="tf-badge tf-badge-warning">Low Stock</span>
                    @else
                        <span class="tf-badge tf-badge-success">In Stock</span>
                    @endif
                </td>
                <td class="p-3 flex space-x-2">
                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="p-4 text-center text-gray-500">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection