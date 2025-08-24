@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2 rounded">
            @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">SKU</label>
            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full border p-2 rounded">
            @error('sku')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Price</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" class="w-full border p-2 rounded">
            @error('price')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full border p-2 rounded">
            @error('quantity')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Category</label>
            <input type="text" name="category" value="{{ old('category', $product->category) }}" class="w-full border p-2 rounded">
            @error('category')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="active" @if(old('status', $product->status)=='active') selected @endif>Active</option>
                <option value="inactive" @if(old('status', $product->status)=='inactive') selected @endif>Inactive</option>
            </select>
            @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Description</label>
            <textarea name="description" class="w-full border p-2 rounded" rows="4">{{ old('description', $product->description) }}</textarea>
            @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update Product</button>
    </form>
</div>
@endsection
