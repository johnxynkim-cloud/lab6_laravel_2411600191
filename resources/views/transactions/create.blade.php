@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Record Inventory Transaction</h1>
            <p class="text-sm text-gray-500 mt-1">Log incoming stock, outgoing items, or manual stock adjustments.</p>
        </div>
        <a href="{{ route('transactions.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition-colors">
            &larr; Back to Transactions
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('transactions.store') }}" class="space-y-6">
            @csrf

            <!-- Product Selection -->
            <div>
                <label for="product_id" class="block text-sm font-semibold text-gray-700 mb-2">Product <span class="text-red-500">*</span></label>
                <select name="product_id" id="product_id" required 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none transition-all">
                    <option value="" disabled selected>Select a product...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} (Current Qty: {{ $product->quantity }})
                        </option>
                    @endforeach
                </select>
                @error('product_id') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Transaction Type -->
            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Transaction Type <span class="text-red-500">*</span></label>
                <select name="type" id="type" required 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none transition-all">
                    <option value="stock_in">Stock In (Addition)</option>
                    <option value="stock_out">Stock Out (Deduction)</option>
                    <option value="adjustment">Adjustment (Set Exact Total)</option>
                </select>
                @error('type') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Quantity & Reference Number Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">Quantity <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1" required 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none transition-all">
                    @error('quantity') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="reference_number" class="block text-sm font-semibold text-gray-700 mb-2">Reference Number <span class="text-gray-400 font-normal">(Optional)</span></label>
                    <input type="text" name="reference_number" id="reference_number" placeholder="e.g. PO-10023" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none transition-all">
                    @error('reference_number') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Notes / Remarks -->
            <div>
                <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes / Remarks <span class="text-gray-400 font-normal">(Optional)</span></label>
                <textarea name="notes" id="notes" rows="3" placeholder="Add any additional details regarding this transaction..." 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none transition-all"></textarea>
                @error('notes') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <a href="{{ route('transactions.index') }}" 
                   class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-800 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-[#00a88f] hover:bg-[#008f7a] text-white font-semibold px-6 py-2.5 rounded-lg shadow-sm transition-colors">
                    Save Transaction
                </button>
            </div>

        </form>
    </div>

</div>
@endsection