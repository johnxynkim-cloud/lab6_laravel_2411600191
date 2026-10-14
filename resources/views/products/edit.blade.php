<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackFit - Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
            <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium mb-1">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Category</label>
                <select name="category" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="Cardio" {{ $product->category == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                    <option value="Strength" {{ $product->category == 'Strength' ? 'selected' : '' }}>Strength</option>
                    <option value="Free Weights" {{ $product->category == 'Free Weights' ? 'selected' : '' }}>Free Weights</option>
                    <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                </select>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Unit Price ($)</label>
                    <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price', $product->unit_price) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Reorder Level</label>
                    <input type="number" name="reorder_level" value="{{ old('reorder_level', $product->reorder_level) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-semibold">Update Product</button>
        </form>
    </div>
</body>
</html>