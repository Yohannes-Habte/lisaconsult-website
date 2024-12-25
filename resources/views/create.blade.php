<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <section class="bg-white rounded shadow p-4" style="width: 100%; max-width: 600px;">
        <h2>Add Product</h2>
        <form action="{{ url('/create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Product Title</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                    <input type="text" id="title" name="title" class="form-control"
                        value="{{ old('title') }}">

                </div>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Product Description</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                    <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                    @error('description')
                    </div>
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-image"></i></span>
                    <input type="file" id="image" name="image" class="form-control">

                </div>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </section>

</body>

</html>
