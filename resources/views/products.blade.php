<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars - LISAConsult Online Store</title>

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

        <p class="text-center fs-4 mb-4">
            Discover an exceptional selection of cars at LISAConsult. Whether you're looking for a luxury ride, a family
            car, or a practical vehicle for everyday commuting, our online store offers a variety of top-quality
            vehicles. Each listing comes with detailed specifications, high-resolution images, and pricing information
            to help you make informed decisions. Start your car shopping journey today and enjoy a seamless, secure, and
            fast purchasing experience!
        </p>

        <!-- Add Product Button -->
        <p class="text-center">
            <a href="{{ route('create') }}" class="btn btn-info btn-lg">
                <i class="bi bi-plus-circle"></i> Add New Car
            </a>

            <a href="{{ route('userProducts') }}" class="btn btn-outline-success btn-lg" data-bs-toggle="tooltip"
                data-bs-placement="top" title="View details of your cars">
                <i class="bi bi-eye"></i> View Your Cars
            </a>
        </p>

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
                            <a href="{{ url('/productDetails/' . $product->id) }}" class="btn btn-outline-secondary btn-sm"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="View details of this product">
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

    <!-- Initialize Bootstrap tooltips -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>
