<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])


    <title>@yield('title')</title>
</head>
<body class="w-full min-h-dvh relative">

    <header id="topbar" class="w-full my-5">
        <div class="h-full navbar container py-2 mx-auto flex justify-between items-center sm:rounded-3xl ">
            <div class="logo flex items-center h-full">
                <img class="w-auto h-full object-cover" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="">
                <p class="">Glamour</p>
            </div>
            <div class="navbar-nav ">
                <ul class="flex gap-x-4">
                    <li class="nav-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">Product</a>
                    </li>
                    <li class="nav-item dropdown-toggle relative">
                        <a href="#">Services</a>
                        <div class="dropdown-menu hidden">
                            <a href=""></a>
                            <a href=""></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#">Teams</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="burger-menu">
            
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        
    </header>

    <div class="min-h-dvh relative">
        <div class="banner absolute inset-0 bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('storage/images/elements/banner1.jpg') }}');"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 h-fit max-w-[40dvw] flex items-center ">
            <div class="flex flex-col gap-y-4 p-10 bg-white bg-opacity-50">
                <p class="">Freshly Patisserie</p>
                <p class="">for sweet-tooth</p>
                <p class="uppercase">glamour</p>
                
                <p>Indulge your sweet tooth with our exquisite creations, crafted to bring a touch of glamour to every moment. From delicate pastries to decadent delights, our patisserie promises a journey through the art of sweetness.</p>
                <p>Elevate your day with flavors that captivate the senses, all in a setting designed for elegance and charm.</p>
                <button type="button" class="rounded-full py-4 px-5 text-center border border-[] bg-pink-300 hover:bg-opacity-80">Explore more </button>
            </div>
        </div>
    </div>

    <section class="w-full h-[30dvh] mt-[3rem]">
        <div class="section-wrapper h-full small-container mx-auto ">
            <div class="px-5 my-3">
                <p class="text-center uppercase">About us</p>
                <div class="navlink-about-us flex justify-center items-center gap-x-4 py-8">
                    <a class="nav-link" href="">Our missions</a>
                    <a class="nav-link" href="">Our values</a>
                    <a class="nav-link" href="">Our goals</a>
                </div>
            </div>
        </div>
    </section>
    <!-- 
    <div class="container-fluid">
        @include('partials.sidebar')  
        <div class="content">
            @yield('content')  
        </div>
    </div>
    -->
</body>
</html>

