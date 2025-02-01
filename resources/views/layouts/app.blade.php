<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        @stack('scripts')
        @vite(['resources/scss/app.scss', 'resources/js/app.js', 'resources/js/custom-swiper.js'])
        <title>@yield('title')</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="relative min-h-dvh">
        
        
        <header id="topbar" class="w-full my-5">
            @yield('header')
        </header>

        <main>
            @yield('content')
        </main>
        
        <footer>
            @yield('footer')
        </footer>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</html>
