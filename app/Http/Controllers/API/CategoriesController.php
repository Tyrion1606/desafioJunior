<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Method to list all categories
    public function index()
    {
        // Fetch all categories from the database
        $categories = Category::all();
        // Return the collection of categories as JSON resources
        return CategoryResource::collection($categories);
    }

    // Method to display a single category
    public function show(Category $category)
    {
        // Return the category as a JSON resource
        return new CategoryResource($category);
    }

    // Method to create a new category
    public function store(Request $request)
    {
        // Validate the data received in the request
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        // Create a new category with the validated data
        $category = Category::create($validatedData);
        // Return the newly created category as a JSON resource
        return new CategoryResource($category);
    }

    // Method to update an existing category
    public function update(Request $request, Category $category)
    {
        // Validate the data received in the request, checking if the slug is unique except for the category itself
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        // Update the category with the validated data
        $category->update($validatedData);
        // Return the updated category as a JSON resource
        return new CategoryResource($category);
    }

    // Method to delete a category
    public function destroy(Category $category)
    {
        // Delete the category
        $category->delete();
        // Return an empty JSON response with the 204 status code (No Content)
        return response()->json(null, 204);
    }
}
