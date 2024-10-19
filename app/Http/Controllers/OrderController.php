<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);

        if ($product->quantity < $validated['quantity']) {
            return response()->json(['error' => 'Not enough stock'], 400);
        }

        // Reduce stock quantity
        DB::transaction(function () use ($product, $validated) {
            $product->decrement('quantity', $validated['quantity']);
        });

        return response()->json(['message' => 'Order placed successfully'], 201);
    }
}
