<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q');
        $category = $request->string('category');
        $status = $request->string('status');
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');

        $query = Product::query();

        if ($q->isNotEmpty()) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%' . $q . '%')
                    ->orWhere('sku', 'like', '%' . $q . '%')
                    ->orWhere('description', 'like', '%' . $q . '%');
            });
        }

        if ($category->isNotEmpty()) {
            $query->where('category', $category);
        }

        if ($status->isNotEmpty()) {
            $query->where('status', $status);
        }

        if ($priceMin !== null && $priceMin !== '') {
            $query->where('price', '>=', (float)$priceMin);
        }

        if ($priceMax !== null && $priceMax !== '') {
            $query->where('price', '<=', (float)$priceMax);
        }

        $allowedSorts = ['name', 'price', 'quantity', 'created_at'];
        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'created_at';
        }
        $direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';

        $products = $query->orderBy($sort, $direction)->paginate(10)->withQueryString();
        $categories = Product::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('products.index', compact(
            'products', 'categories', 'sort', 'direction', 'q', 'category', 'status', 'priceMin', 'priceMax'
        ));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted');
    }
}
