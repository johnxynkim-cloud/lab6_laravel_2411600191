@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Page Header & Action Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Inventory Transactions</h1>
            <p class="text-sm text-gray-500 mt-1">Track and manage all incoming and outgoing stock movements.</p>
        </div>
        <a href="{{ route('transactions.create') }}" 
           class="inline-flex items-center justify-center bg-[#00a88f] hover:bg-[#008f7a] text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm transition-colors">
            + Record New Transaction
        </a>
    </div>

    <!-- Alert Message -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg text-sm flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filter Card -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-wrap items-center gap-4">
            <span class="text-sm font-semibold text-gray-700">Filter by Type:</span>
            <select name="type" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-[#00a88f] focus:border-[#00a88f] outline-none">
                <option value="">All Types</option>
                <option value="stock_in" {{ request('type') == 'stock_in' ? 'selected' : '' }}>Stock In</option>
                <option value="stock_out" {{ request('type') == 'stock_out' ? 'selected' : '' }}>Stock Out</option>
                <option value="adjustment" {{ request('type') == 'adjustment' ? 'selected' : '' }}>Adjustment</option>
            </select>
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium px-4 py-1.5 rounded-lg transition-colors">
                Filter
            </button>
            <a href="{{ route('transactions.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium">
                Reset
            </a>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase font-semibold text-gray-600 tracking-wider">
                        <th class="p-4">Date/Time</th>
                        <th class="p-4">Product Name</th>
                        <th class="p-4">Type</th>
                        <th class="p-4">Quantity</th>
                        <th class="p-4">Reference No.</th>
                        <th class="p-4">User</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-4 whitespace-nowrap text-gray-500">
                                {{ $transaction->created_at ? $transaction->created_at->format('Y-m-d H:i') : 'N/A' }}
                            </td>
                            <td class="p-4 font-semibold text-gray-900">
                                {{ $transaction->product->name ?? 'N/A' }}
                            </td>
                            <td class="p-4">
                                @if($transaction->type === 'stock_in')
                                    <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                        Stock In
                                    </span>
                                @elseif($transaction->type === 'stock_out')
                                    <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-800">
                                        Stock Out
                                    </span>
                                @else
                                    <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                        Adjustment
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 font-bold text-gray-800">
                                {{ $transaction->quantity }}
                            </td>
                            <td class="p-4 text-gray-500 font-mono text-xs">
                                {{ $transaction->reference_number ?? '-' }}
                            </td>
                            <td class="p-4 text-gray-600 font-medium">
                                {{ $transaction->user->name ?? 'System' }}
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('transactions.show', $transaction->id) }}" 
                                   class="text-[#00a88f] hover:underline font-semibold text-xs">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400">
                                No inventory transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection