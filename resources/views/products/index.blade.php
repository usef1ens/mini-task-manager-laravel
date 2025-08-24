@extends('layouts.app')

@section('title', 'Products List')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Products</h1>

    <!-- Search & Filters -->
    <form method="GET" class="mb-4 flex flex-wrap gap-2 items-end">
        <div>
            <label class="block text-sm font-medium">Search</label>
            <input type="text" name="q" value="{{ $q }}" class="border p-2 rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">Category</label>
            <select name="category" class="border p-2 rounded">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" @if($cat == $category) selected @endif>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Status</label>
            <select name="status" class="border p-2 rounded">
                <option value="">All</option>
                <option value="active" @if($status=='active') selected @endif>Active</option>
                <option value="inactive" @if($status=='inactive') selected @endif>Inactive</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Min Price</label>
            <input type="number" name="price_min" value="{{ $priceMin }}" class="border p-2 rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">Max Price</label>
            <input type="number" name="price_max" value="{{ $priceMax }}" class="border p-2 rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
    </form>

    <!-- Products Table -->
    <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">SKU</th>
                <th class="px-4 py-2 border">Category</th>
                <th class="px-4 py-2 border">Price</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border">{{ $product->name }}</td>
                <td class="px-4 py-2 border">{{ $product->sku }}</td>
                <td class="px-4 py-2 border">{{ $product->category }}</td>
                <td class="px-4 py-2 border">${{ number_format($product->price, 2) }}</td>
                <td class="px-4 py-2 border">{{ ucfirst($product->status) }}</td>
                <td class="px-4 py-2 border flex gap-2">
                    <a href="{{ route('products.show', $product) }}" class="text-blue-500 hover:underline">View</a>
                    <a href="{{ route('products.edit', $product) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
