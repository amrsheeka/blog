<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">

    
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand fw-bold cursor" >📝 My Blog</a>
        <div class="ms-auto">
            <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm btn-rounded">+ New Post</a>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero text-center">
        <h1 class="fw-bold">Welcome to My Blog</h1>
        <p class="mb-0">Write, edit and share your thoughts easily</p>
    </div>
    
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success mt-2" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('failed'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        
        <main>
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>