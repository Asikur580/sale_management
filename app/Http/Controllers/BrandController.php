<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
     // Store a newly created brand
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
         ]);
 
         $brand = new Brand;
         $brand->name = $request->name;
         $brand->save();
 
         return response()->json(['message' => 'Brand created successfully', 'brand' => $brand], 201);
     }
 
     // Update the specified brand
     public function update(Request $request, $id)
     {
         $request->validate([
             'name' => 'required|string|max:255',
         ]);
 
         $brand = Brand::findOrFail($id);
         $brand->name = $request->name;
         $brand->save();
 
         return response()->json(['message' => 'Brand updated successfully', 'brand' => $brand], 200);
     }
 
     // Remove the specified brand
     public function destroy($id)
     {
         $brand = Brand::findOrFail($id);
         $brand->delete();
 
         return response()->json(['message' => 'Brand deleted successfully'], 200);
     }
}
