<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/js/app.js')

    <title>@yield('title')</title>
</head>
<body>
    <div class="container-fluid">
        @include('partials.sidebar')  <!-- Include Sidebar -->
        <div class="content">
            @yield('content')  <!-- Content Section -->
        </div>
    </div>
</body>
</html>

