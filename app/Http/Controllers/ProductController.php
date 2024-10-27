<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\StockInOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    // Method to handle the stock in operation
    public function stockIn(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'purpose' => 'required|string',
                'taken_by' => 'required|string',
                'in_out_date' => 'required|date',
            ]);

            $stockIn = StockInOut::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'in_out' => 'in', // Specify 'in' for stock in
                'purpose' => $request->purpose,
                'taken_by' => $request->taken_by,
                'in_out_date' => $request->in_out_date,
            ]);

            // Update the product's quantity
            $product = Product::find($request->product_id);
            $product->quantity += $request->quantity; // Increase the product quantity
            $product->save(); // Save the changes to the database

            DB::commit();
            
            return response()->json([
                'message' => 'Stock added successfully.',
                'data' => $stockIn,
                'updated_product' => $product
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }

    // Method to handle the stock out operation
    public function stockOut(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'purpose' => 'required|string',
                'taken_by' => 'required|string',
                'in_out_date' => 'required|date',
            ]);

            $stockOut = StockInOut::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'in_out' => 'out',
                'purpose' => $request->purpose,
                'taken_by' => $request->taken_by,
                'in_out_date' => $request->in_out_date,
            ]);

            // Update the product's quantity (for stock out)
            $product = Product::find($request->product_id);
            $product->quantity -= $request->quantity; // Decrease the product quantity
            $product->save(); // Save the changes to the database

            DB::commit();

            return response()->json([
                'message' => 'Stock removed successfully.',
                'data' => $stockOut,
                'updated_product' => $product             
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }
}
