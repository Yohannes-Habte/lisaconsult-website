<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Retrieve up to 6 products from the database
    $products = Product::take(6)->get();

    // Pass products to the 'home' view
    return view('home', ["products" => $products]);
})->name('home');



// Show the registration form
Route::get('/register', function () {
    return view('register');
});

// Handle register form submission
Route::post('/register', [UserController::class, 'register'])->name('register');

// Show the login form
Route::get('/login', function () {
    return view('login');
});

// Handle login from submission
Route::post('/login', [UserController::class, 'login'])->name('login');



// Handle logout form submission
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// Public route to show all products page
Route::get('/products', function () {
    $products =  Product::all();
    return view('products', ["products" => $products]);  // This should be the page showing all products
})->name('products.index');




// Public route to show 6 products only using limit
/** 
Route::get('/products', function () {
    $products = Product::limit(6)->get();
    return view('products', ["products" => $products]);
})->name('products.index');

 */

// Public route to show all products of a specific user who is logged in
Route::get('/userProducts', function () {
    // Use the Auth facade to get the authenticated user's ID
    $products = [];

    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to view your products.');
    }

    $products = Product::where('user_id', Auth::id())->get();
    // $userProducts = Auth::user()->usersProducts()->latest()->get();

    return view('userProducts', ["products" => $products]);
})->name('userProducts');

// Route to edit a product
Route::get("/editProduct/{product}", [ProductController::class, "showEditScreen"]);
Route::put("/editProduct/{product}", [ProductController::class, "actuallyUpdateProduct"]);


// Route to delete a product
Route::delete("/delete-product/{product}", [ProductController::class, "deleteProduct"]);


// Route to display a single product's details
Route::get('/productDetails/{id}', function ($id) {
    // Fetch the product by its ID
    $product = Product::findOrFail($id);

    // Return the product details view with the product data
    return view('productDetails', ['product' => $product]);
})->name('productDetails');


// Route to show the form to create a new product
Route::get('/create', [ProductController::class, 'showCreateForm'])->name('create');

// Route to handle the form submission for creating a new product
Route::post('/create', [ProductController::class, 'createProduct'])->name('create');
