<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve search parameters from the request
        $name = $request->input('name');
        $description = $request->input('description');

        // Query categories based on search parameters
        $categories = Category::query();

        if ($name) {
            $categories->where('name', 'like', "%$name%");
        }

        if ($description) {
            $categories->where('description', 'like', "%$description%");
        }

        // Get the results
        $categories = $categories->get();

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        // Validate the request.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $category = Category::create($validatedData);
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $id)
    {
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $id)
    {
        $request->headers->set('Accept', 'application/json');

        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Validate the request.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $category->update($validatedData);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(null, 204);
    }
}
