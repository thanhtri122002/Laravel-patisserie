<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="relative min-h-dvh">
        @if (empty($hideHeader))
            @include('layouts.partials.header')
        @endif
        
        <main>
            @yield('content')
        </main>

        @if (empty($hideFooter))
            @include('layouts.partials.footer')
        @endif
        
        
    </body>
</html>
