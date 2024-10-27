<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Store a newly created category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
    }

    // Update the specified category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return response()->json(['message' => 'Category updated successfully', 'category' => $category], 200);
    }

    // Remove the specified category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
