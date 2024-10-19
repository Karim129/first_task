<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('category')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'cat_id' => 'required|exists:categories,id',
        ]);

        return Product::create($validated);
    }

    public function show(Product $product)
    {
        return $product->load('category');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'cat_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
