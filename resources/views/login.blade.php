<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <section class="bg-white rounded shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Welcome Back</h3>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email Address -->
            <div class="mb-3">
                <label for="user_email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control" id="user_email" name="user_email"
                        placeholder="Email Address">
                </div>
                @error('user_email')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="user_password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="user_password" name="user_password"
                        placeholder="Password">
                </div>
                @error('user_password')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me">
                    <label for="remember_me" class="form-check-label">Remember Me</label>
                </div>
                <a href="#" class="text-primary text-decoration-none small">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>

        <!-- Sign Up Link -->
        <div class="mt-3 text-center">
            <p class="small">Don’t have an account? <a href="{{ url('/register') }}"
                    class="text-primary text-decoration-none">Sign Up</a></p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
