<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <!-- Vite -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light vh-100">

    <section class="container">
        <h1 class="text-center my-5">Welcome to LISAConsult Cars Online Store</h1>

        <!-- Product Listing -->
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            @foreach ($products as $product)
                <!-- Car Product Card -->
                <div class="col">
                    <div class="card h-100">
                        <!-- Correct way to display the image -->
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->title }}">

                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }} </h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <small class="card-text">For more information, contact {{ $product->user->name }}:
                                <strong> {{ $product->user->email }}</strong></small>
                        </div>
                        <div class="card-footer text-center">
                            <!-- Edit Button -->
                            <a href="{{ url('/editProduct/' . $product->id) }}" class="btn btn-info btn-sm"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this product">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ url('/delete-product/' . $product->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Delete this product">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>

                            <!-- View Details Button -->
                            <a href="{{ url('/productDetails/' . $product->id) }}"
                                class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="View details of this product">
                                <i class="bi bi-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>