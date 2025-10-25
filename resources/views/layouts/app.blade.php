<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="relative min-h-screen flex flex-col">
        @if (empty($hideHeader))
            @include('layouts.partials.header')
        @endif
        
        <main class="flex-1">
            @yield('content')
        </main>

        @if (empty($hideFooter))
            @include('layouts.partials.footer')
        @endif
         
    </body>
</html>
