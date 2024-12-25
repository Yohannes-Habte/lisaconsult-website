<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    // ========================================================================
    // Display the form for creating a new product.
    // ========================================================================

    public function showCreateForm()
    {
        return view('create');
    }

    // ========================================================================
    // Create a new product in the database.
    // ========================================================================

    public function createProduct(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Log the validated data to check
        Log::info('Validated Data:', $validatedData);

        // Sanitize user input to prevent XSS
        $validatedData['title'] = strip_tags($validatedData['title']);
        $validatedData['description'] = strip_tags($validatedData['description']);

        // Ensure the user is authenticated
        $user = Auth::user();
        if (!$user) {
            throw ValidationException::withMessages(['error' => 'You must be logged in to create a product.']);
        }

        // Associate the product with the logged-in user
        $validatedData['user_id'] = $user->id;

        // Store the image securely and get its path
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        } else {
            throw ValidationException::withMessages(['error' => 'Product image is required.']);
        }

        // Log data before saving to database
        Log::info('Product data being saved: ', $validatedData);

        // Create the product in the database
        Product::create($validatedData);

        // Redirect to the product index page with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    // ===========================================================================================================
    // Edit product
    // ===========================================================================================================
    public function showEditScreen(Product $product)
    {
        // Ensure the user is authorized to edit the product (check user_id)
        if (Auth::user()->id !== $product->user_id) {
            return redirect("/");
        }

        // Return the edit view with the product
        return view("editProduct", ["product" => $product]);
    }

    public function actuallyUpdateProduct(Product $product, Request $request)
    {

        // Ensure the user is authorized to edit the product (check user_id)
        if (Auth::user()->id !== $product->user_id) {
            return redirect("/");
        }

        // Validate the incoming request
        $validatedProduct = $request->validate([
            'title' => ['string', 'max:255'],
            'description' => ['string'],
        ]);

        // Sanitize user input to prevent XSS
        $validatedProduct['title'] = strip_tags($validatedProduct['title']);
        $validatedProduct['description'] = strip_tags($validatedProduct['description']);

        $product->update($validatedProduct);

        return redirect("/");
    }

    // ===========================================================================================================
    // Delete a product
    // ===========================================================================================================

    public function deleteProduct(Product $product)
    {
        // Ensure the user is authorized to edit the product (check user_id)
        if (Auth::user()->id === $product->user_id) {
            $product->delete();
        }

        return redirect("/");
    }
}
