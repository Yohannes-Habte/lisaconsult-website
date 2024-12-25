<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisaconsult</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            background: linear-gradient(to right, #4e73df, #224abe);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1.2rem;
        }

        .hero-section .btn {
            font-size: 1.1rem;
        }

        .card:hover {
            transform: scale(1.03);
            transition: 0.3s ease-in-out;
        }

        .footer-text {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ url('/') }}" class="text-white fw-bold fs-4">Lisaconsult</a>
            </div>
            <div class="auth-links">
                @auth
                    <span>Welcome, {{ Auth::user()->name }}!</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-sm ms-2">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <h1>Welcome to LISAConsult Online Store</h1>
                <p class="mt-3">
                    Explore a wide range of products tailored to your needs. Enjoy exclusive deals, fast delivery, and a
                    seamless shopping experience.
                </p>
                <a href="{{ url('/products') }}" class="btn btn-light btn-lg mt-4">Start Shopping Now</a>
            </div>
        </section>

        <!-- Main Features Section -->
        <section class="container my-5">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-box-seam display-4 text-primary"></i>
                            <h5 class="card-title mt-3">Quality Products</h5>
                            <p class="card-text">Discover top-quality products curated to meet your expectations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-truck display-4 text-success"></i>
                            <h5 class="card-title mt-3">Fast Delivery</h5>
                            <p class="card-text">Get your orders delivered quickly and securely.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-headset display-4 text-danger"></i>
                            <h5 class="card-title mt-3">24/7 Support</h5>
                            <p class="card-text">We're here to assist you anytime, anywhere.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Product Listing Section -->
        <section class="container my-5">
            @if ($products->isEmpty())
                <div class="alert alert-warning text-center">No products available at the moment. Check back later!
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                    alt="{{ $product->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->title }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="text-muted small">
                                        For more information, contact {{ $product->user->name }}:
                                        <strong>{{ $product->user->email }}</strong>
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <a href="{{ url('/editProduct/' . $product->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ url('/delete-product/' . $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                    <a href="{{ url('/productDetails/' . $product->id) }}"
                                        class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="footer-text mb-0">&copy; 2024 Lisaconsult. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
