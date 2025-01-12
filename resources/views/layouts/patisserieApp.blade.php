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
        <div class="h-full navbar container py-2 mx-auto flex items-center sm:rounded-3xl ">
            <div class="logo flex items-center h-full ml-4">
                <img class="w-auto h-full object-cover" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="">
                <p class="">Glamour</p>
            </div>
            <div class="navbar-nav mr-4">
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
            <div id="burgerMenu" class="burger-menu ml-auto">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
            <div id="mobileMenu" class="mobile-menu">
                <div class="flex m-10 justify-between">
                    <img class="w-auto h-[2rem] object-cover" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="">
                    <button id="closeBtn">x</button>
                </div>
                
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
        
    </header>

    <section class="w-full min-h-screen relative">
        <div class="banner absolute inset-0 bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('storage/images/elements/banner1.jpg') }}');"></div>
        <div class="absolute inset-0  flex justify-center items-center">
            <div class="flex flex-col max-h-full max-w-[50dvh] my-auto gap-y-4 m-auto bg-white bg-opacity-50">
                <p class="">Freshly Patisserie</p>
                <p class="">for sweet-tooth</p>
                <p class="uppercase">glamour</p>
                <p>Indulge your sweet tooth with our exquisite creations, crafted to bring a touch of glamour to every moment. From delicate pastries to decadent delights, our patisserie promises a journey through the art of sweetness.</p>
                <p>Elevate your day with flavors that captivate the senses, all in a setting designed for elegance and charm.</p>
                <button type="button" class="rounded-full py-4 px-5 text-center border border-[] bg-pink-300 hover:bg-opacity-80">Explore more </button>
            </div>
        </div>
    </section>

    <section class="w-full my-[3rem]">
        <div class="section-wrapper h-full small-container mx-auto ">
            <div class="px-5 my-3">
                <p class="text-center uppercase">About us</p>
                <div class="navlink-about-us flex justify-center items-center gap-x-4 py-8">
                    <a class="nav-link relative" href="#" data-target="mission">Our missions</a>
                    <a class="nav-link relative" href="#" data-target="values">Our values</a>
                    <a class="nav-link relative" href="#" data-target="goals">Our goals</a>
                </div>
                <div class="section-inf">
                    <div id="mission" class="h-full grid grid-cols-1 md:grid-cols-2 md:gap-x-5">
                        <div class="img-wrapper h-[15rem]">
                            <img class="w-full h-full object-cover" src="{{ asset('storage/images/elements/about-us.jpg')}}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <h2>Providing quality products for all be happy and peace</h2>
                            <p>We strive to deliver exceptional products that meet your needs, ensuring happiness and peace in every aspect of your life.</p>
                        </div>
                    </div>
                    <div id="values" class="h-full grid-cols-1 md:grid-cols-2 md:gap-x-5">
                        <div class="img-wrapper h-[15rem]">
                            <img class="w-full h-full object-cover" src="{{ asset('storage/images/elements/about-us-2.jpg')}}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <h2>Guided by integrity and excellence</h2>
                            <p>Our values are rooted in trust, honesty, and excellence, shaping the foundation of our interactions with customers and communities.</p>
                        </div>
                    </div>
                    <div id="goals" class="h-full grid-cols-1 md:grid-cols-2 md:gap-x-5">
                        <div class="img-wrapper h-[15rem]">
                            <img class="w-full h-full object-cover" src="{{ asset('storage/images/elements/about-us-3.jpg')}}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <h2>Empowering growth and innovation</h2>
                            <p>Our goal is to continuously innovate and expand, ensuring we bring the best solutions to our customers and foster a culture of growth.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full my-[3rem] relative z-[2]">
        <div class="section-wrapper h-full small-container mx-auto">
            <div class="px-5">
                <h1 class="text-center">Best Product</h1>
                <div class="flex gap-x-4 items-center">
                    <div class="relative flex flex-col">
                        <div class="absolute top-0 p-3">
                            <p>Products name</p>
                        </div>
                        <img src="" alt=""> 
                        <div class="absolute bottom-0 p-3">
                            <p>Price:</p>
                        </div>
                    </div>
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

