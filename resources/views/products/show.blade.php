@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>

    <div class="mb-2"><strong>SKU:</strong> {{ $product->sku }}</div>
    <div class="mb-2"><strong>Category:</strong> {{ $product->category }}</div>
    <div class="mb-2"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</div>
    <div class="mb-2"><strong>Quantity:</strong> {{ $product->quantity }}</div>
    <div class="mb-2"><strong>Status:</strong> {{ ucfirst($product->status) }}</div>
    <div class="mb-2"><strong>Description:</strong> {{ $product->description }}</div>
    <div class="mt-4 flex gap-2">
        <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection
