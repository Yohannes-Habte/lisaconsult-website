<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - {{ $product->title }}</title>

    <!-- Vite -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <header class="bg-info-subtle py-4">
        <div class="container">
            <h1 class="text-center">{{ $product->title }}</h1>
        </div>
    </header>

    <main class="container my-5 vh-100">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                        alt="{{ $product->title }}">
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">{{ $product->title }}</h2>
                        <p class="text-muted mb-4">Posted on: {{ $product->created_at->format('F j, Y') }}</p>

                        <p class="card-text">
                            <strong>Description:</strong>
                            <br>
                            {{ $product->description }}
                        </p>

                        <hr>
                        <p class="text-success fw-bold fs-4">Price: ${{ $product->price }}</p>
                    </div>

                    <div class="card-footer text-center">
                        <!-- Edit Button -->
                        <a href="{{ url('/editProduct/' . $product->id) }}" class="btn btn-info btn-lg mx-2"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this product">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ url('/delete-product/' . $product->id) }}" method="POST"
                            style="display:inline-block;"
                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg mx-2" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Delete this product">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>

                        <!-- Add to Cart Button -->
                        <a href="{{ url('/cart/add/' . $product->id) }}" class="btn btn-outline-secondary btn-lg mx-2"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Add this product to your cart">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p class="mb-0">LISAConsult Online Store &copy; {{ date('Y') }}</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Initialize Bootstrap Tooltips -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>
