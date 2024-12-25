<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

   

    
    <section class="bg-white rounded shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Create a Free Account</h3>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Full Name -->
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name">
                </div>
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="user_email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email Address">
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="user_password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
                </div>
            </div>

             <!-- Password Confirmation -->
             <div class="mb-3">
                <label for="user_password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="user_password_confirmation" id="user_password_confirmation" placeholder="Confirma Password" class="form-control">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>

        <!-- Sign In Link -->
        <div class="mt-3 text-center">
            <p class="small">Already have an account? <a href="{{ url('/login') }}" class="text-primary text-decoration-none">Sign In</a></p>
        </div>
    </section>

  


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
