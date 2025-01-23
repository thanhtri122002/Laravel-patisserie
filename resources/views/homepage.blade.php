@extends('layouts.app')

@section('title', 'Homepage')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section class="w-full min-h-dvh relative">
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('storage/images/elements/banner1.jpg') }}');"></div>
        <div class="absolute top-1/2 md:left-20 transform -translate-y-1/2 max-w-[60dvw]">
            <div class="flex items-center">
                <div class="flex flex-col gap-y-4 p-5 bg-white bg-opacity-50">
                    <div class="">
                        <p class="">Freshly Patisserie</p>
                        <p class="">for sweet-tooth</p>
                        <p class="uppercase font-mer text-h2 ">glamour</p>
                        <p>Elevate your day with flavors that captivate the senses, all in a setting designed for elegance and charm.</p>
                    </div>
                    <button type="button" class="rounded-full w-fit py-4 px-5 text-center border border-[] bg-pink-300 hover:bg-opacity-80">Explore more </button>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full my-[3rem]">
        <div class="section-wrapper h-full small-container mx-auto ">
            <div class="px-5 my-3">
                <p class="text-center uppercase">About us</p>
                <div class="navlink-about-us flex justify-center items-center gap-x-4 py-8">
                    <a class="nav-link relative font-mer" href="#" data-target="mission">Our missions</a>
                    <a class="nav-link relative font-mer" href="#" data-target="values">Our values</a>
                    <a class="nav-link relative font-mer" href="#" data-target="goals">Our goals</a>
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

    <section class="section-product w-full my-[3rem] relative z-[2]">
        <div class="h-full xs-container mx-auto ">
            <div class="px-5">
                <h1 class="text-center pb-10">Best Product</h1>
                <div class="flex gap-x-4">
                    
                    <div class="product relative flex flex-col" tabindex="0">
                        <div class="product-name absolute top-0 left-1/2 transform -translate-x-1/2 p-3">
                            <p class="text-center">Products name</p>
                        </div>
                        <div class="z-10">
                            <img class="w-full h-auto object-cover" src="{{ asset('storage/images/elements/cake-item1.jpg') }}" alt=""> 
                        </div>
                        <div class="product-price absolute bottom-0 left-1/2 transform -translate-x-1/2 p-3">
                            <p>Price:</p>
                        </div>
                    </div>
                    <div class="product relative flex flex-col" tabindex="1">
                        <div class="product-name absolute top-0 left-1/2 transform -translate-x-1/2 p-3">
                            <p class="text-center">Products name</p>
                        </div>
                        <div class="z-10">
                            <img class="w-full h-auto object-cover" src="{{ asset('storage/images/elements/cake-item1.jpg') }}" alt=""> 
                        </div>
                        <div class="product-price absolute bottom-0 left-1/2 transform -translate-x-1/2 p-3">
                            <p>Price:</p>
                        </div>
                    </div>
                    <div class="product relative flex flex-col" tabindex="2">
                        <div class="product-name absolute top-0 left-1/2 transform -translate-x-1/2 p-3">
                            <p class="text-center">Products name</p>
                        </div>
                        <div class="z-10">
                            <img class="w-full h-auto object-cover" src="{{ asset('storage/images/elements/cake-item1.jpg') }}" alt=""> 
                        </div>
                        <div class="product-price absolute bottom-0 left-1/2 transform -translate-x-1/2 p-3">
                            <p>Price:</p>
                        </div>
                    </div>
                    <div class="product relative flex flex-col" tabindex="3">
                        <div class="product-name absolute top-0 left-1/2 transform -translate-x-1/2 p-3">
                            <p class="text-center">Products name</p>
                        </div>
                        <div class="z-10">
                            <img class="w-full h-auto object-cover" src="{{ asset('storage/images/elements/cake-item1.jpg') }}" alt=""> 
                        </div>
                        <div class="product-price absolute bottom-0 left-1/2 transform -translate-x-1/2 p-3">
                            <p>Price:</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>

    <section class="section-special-productw-full relative">
        <div class="small-container mx-auto relative">
            <div class="flex justify-center gap-10">
                <div class="special-product-imgs flex-1 w-[50%]">
                    <div class="swiper mySwiper h-[320px]">
                        <div class="swiper-wrapper w-full">
                            <div class="swiper-slide">
                                <img class="w-full h-full object-cover" src="{{ asset('storage/images/elements/special-product-1.jpg') }}" alt="">
                            </div>
                            <div class="swiper-slide"></div>
                        </div>
                    </div>
                </div>
                <div class="special-product-des flex-1 flex flex-col">
                    <p class="font-mer text-h1">Brownie</p>
                </div>
            </div>
        </div>
    </section>
@endsection