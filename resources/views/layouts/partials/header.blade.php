<!-- resources/views/layouts/partials/header.blade.php -->
<div class="hover-zone"></div>
<header id="topbar" class="w-full shadow-md bg-white z-50">
    @yield('header')
</header>

<!-- 
NOTE
1/ How to make the hover zone which will slide the header?
   Step 1: define a hover zone, set it position fixed to the top of the view port
   Step 2: Make the header fixed to the top of the view port, transform Y -100%
   Step 3: Define hover for hover zone
-->