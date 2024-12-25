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
        .product-btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <div class="logo">
                <a href="{{ url('/') }}" class="text-white fw-bold fs-4">Lisaconsult</a>
            </div>

            <!-- Authentication Links -->
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to LISAConsult Online Store</h1>
            <p class="mt-3">
                Explore a wide range of products tailored to your needs. Enjoy exclusive deals, fast delivery, and a seamless shopping experience.
            </p>
            <a href="{{ url('/products') }}" class="btn btn-light btn-lg product-btn">Start Shopping Now</a>
        </div>
    </section>

    <!-- Main Content -->
    <section class="container my-5 vh-100">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Quality Products</h5>
                        <p class="card-text">Discover top-quality products curated to meet your expectations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Fast Delivery</h5>
                        <p class="card-text">Get your orders delivered quickly and securely.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">24/7 Support</h5>
                        <p class="card-text">We're here to assist you anytime, anywhere.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0">&copy; 2024 Lisaconsult. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
