<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Store a newly created product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'cat_id' => $request->cat_id,
            'brand_id' => $request->brand_id,
            'model' => $request->model,
            'serial' => $request->serial,
            'warranty' => $request->warranty,
            'purchase_form' => $request->purchase_form,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    // Update the specified product
    public function update(Request $request, $id)
    {        
        $request->validate([
            'name' => 'required|string|max:255',
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'cat_id' => $request->cat_id,
            'brand_id' => $request->brand_id,
            'model' => $request->model,
            'serial' => $request->serial,
            'warranty' => $request->warranty,
            'purchase_form' => $request->purchase_form,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }

    // Remove the specified product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
