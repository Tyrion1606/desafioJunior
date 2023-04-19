<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // Method to list all active products
    public function index()
    {
        // Fetch all active products from the database
        $products = Product::where('is_active', 1)->get();  // ONLY ACTIVE PRODUCTS!
        // Return the collection of products as JSON resources
        return ProductResource::collection($products);
    }

    // Method to display a single product by slug
    public function show($slug)
    {
        // Return the product as a JSON resource
        $product = Product::where('slug', $slug)->firstOrFail();
        return new ProductResource($product);
    }

    // Method to create a new product
    public function store(Request $request)
    {
        // Validate the data received in the request
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:products|max:255',
            'price' => 'required|numeric|min:0',
            'special_price' => 'nullable',
            'special_price_from' => 'nullable',
            'special_price_to' => 'nullable',
            'is_active' => 'nullable',
            'categories' => 'nullable'
        ]);

        // Create a new product with the validated data
        $product = Product::create($validatedData);
        // Return the newly created product as a JSON resource
        return new ProductResource($product);
    }

    // Method to update an existing product
    public function update(Request $request, Product $product)
    {
        // Validate the data received in the request, checking if the slug is unique except for the product itself
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:products|max:255',
            'price' => 'required|numeric|min:0',
            'special_price' => 'nullable',
            'special_price_from' => 'nullable',
            'special_price_to' => 'nullable',
            'is_active' => 'nullable',
            'categories' => 'nullable'
        ]);

        // Update the product with the validated data
        $product->update($validatedData);
        // Return the updated product as a JSON resource
        return new ProductResource($product);
    }

    // Method to SOFT delete a product
    public function destroy(Product $product)
    {
        // Retrieve the product and mark it as inactive
        $product = Product::findOrFail($product->id);
        $product->is_active = 0;
        $product->save();
        // Return a JSON response with a 204 status code (No Content)
        return response()->json(null, 204);
    }
}
