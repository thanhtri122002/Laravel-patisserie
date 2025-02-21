@extends('layouts.app')

@section('title', 'Homepage')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section class="w-full min-h-[70dvh] relative">
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
        <div class="section-wrapper small-container mx-auto ">
            <div class="px-5">
                <p class="text-center uppercase font-mer text-h1">About us</p>
                <div class="navlink-about-us flex justify-center items-center gap-x-4 py-8">
                    <a class="nav-link relative font-mer" href="#" data-target="mission">Our missions</a>
                    <a class="nav-link relative font-mer" href="#" data-target="values">Our values</a>
                    <a class="nav-link relative font-mer" href="#" data-target="goals">Our goals</a>
                </div>
                <div class="section-inf">
                    <div id="mission" class="grid grid-cols-1 md:grid-cols-2 md:gap-x-5">
                        <div class="img-wrapper ">
                            <img class="w-full h-full object-cover" src="{{ asset('storage/images/elements/about-us.jpg')}}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <h2>Providing quality products for all be happy and peace</h2>
                            <p>We strive to deliver exceptional products that meet your needs, ensuring happiness and peace in every aspect of your life.</p>
                        </div>
                    </div>
                    <div id="values" class="grid-cols-1 md:grid-cols-2 md:gap-x-5">
                        <div class="img-wrapper">
                            <img class="w-full h-full object-cover" src="{{ asset('storage/images/elements/about-us-2.jpg')}}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <h2>Guided by integrity and excellence</h2>
                            <p>Our values are rooted in trust, honesty, and excellence, shaping the foundation of our interactions with customers and communities.</p>
                        </div>
                    </div>
                    <div id="goals" class="grid-cols-1 md:grid-cols-2 md:gap-x-5">
                        <div class="img-wrapper">
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

    <section class="section-product w-full my-[5rem] relative">
        <div class="xs-container mx-auto ">
            <div class="px-5">
                <h1 class="text-center font-mer text-h1">Best Product</h1>
                <div class="flex gap-x-4 mt-16">
                    <div class="product relative flex flex-col" tabindex="0">
                        <div class="product-name absolute top-0 left-1/2 transform -translate-x-1/2 py-2">
                            <p class="text-center">Products name</p>
                        </div>
                        <div class="z-10">
                            <img class="w-full h-auto object-cover rounded-2xl shadow-lg border border-gray-300" src="{{ asset('storage/images/elements/cake-item1.jpg') }}" alt=""> 
                        </div>
                        <div class="product-price absolute bottom-0 left-1/2 transform -translate-x-1/2 py-2">
                            <p>Price:</p>
                        </div>
                    </div>
                    <div class="product relative flex flex-col" tabindex="1">
                        <div class="product-name absolute top-0 left-1/2 transform -translate-x-1/2 py-2">
                            <p class="text-center">Products name</p>
                        </div>
                        <div class="z-10">
                            <img class="w-full h-auto object-cover rounded-2xl shadow-lg border border-gray-300" src="{{ asset('storage/images/elements/cake-item1.jpg') }}" alt=""> 
                        </div>
                        <div class="product-price absolute bottom-0 left-1/2 transform -translate-x-1/2 py-2">
                            <p>Price:</p>
                        </div>
                    </div>
                    <div class="product relative flex flex-col" tabindex="2">
                        <div class="product-name absolute top-0 left-1/2 transform -translate-x-1/2 py-2">
                            <p class="text-center">Products name</p>
                        </div>
                        <div class="z-10">
                            <img class="w-full h-auto object-cover rounded-2xl shadow-lg border border-gray-300" src="{{ asset('storage/images/elements/cake-item1.jpg') }}" alt=""> 
                        </div>
                        <div class="product-price absolute bottom-0 left-1/2 transform -translate-x-1/2 py-2">
                            <p>Price:</p>
                        </div>
                    </div>
                    <div class="product relative flex flex-col" tabindex="3">
                        <div class="product-name absolute top-0 left-1/2 transform -translate-x-1/2 py-2">
                            <p class="text-center">Products name</p>
                        </div>
                        <div class="z-10">
                            <img class="w-full h-auto object-cover rounded-2xl shadow-lg border border-gray-300" src="{{ asset('storage/images/elements/cake-item1.jpg') }}" alt=""> 
                        </div>
                        <div class="product-price absolute bottom-0 left-1/2 transform -translate-x-1/2 py-2">
                            <p>Price:</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>

    <section class="section-special-product w-full relative my-[5rem]">
        <div class="xs-container mx-auto relative">
            <div class="flex item-center gap-10">
                <div class="special-product-imgs  w-[30%]">
                    <div class="swiper mySwiper h-[320px]">
                        <div class="swiper-wrapper w-full z-[-1]">
                            <div class="swiper-slide" data-slide-id="content-1">
                                <img class="w-full h-full object-cover rounded-2xl shadow-lg border border-gray-300" src="{{ asset('storage/images/elements/special-product-1.jpg') }}" alt="">
                            </div>
                            <div class="swiper-slide" data-slide-id="content-2">
                                <img class="w-full h-full object-cover rounded-2xl shadow-lg border border-gray-300" src="{{ asset('storage/images/elements/special-product-2jpg.jpg') }}" alt="">
                            </div>
                            <div class="swiper-slide" data-slide-id="content-3">
                                <img class="w-full h-full object-cover rounded-2xl shadow-lg border border-gray-300" src="{{ asset('storage/images/elements/special-product-3.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="special-product-des flex flex-col w-[70%]">
                    <div id="content-1" class="dynamic-text active">
                        <p class="font-mer text-h1 ">Brownie</p>
                        <p class="font-mer">A rich, fudgy brownie with a decadent chocolate flavor, made from the finest cocoa and premium ingredients. 
                        Perfectly moist and delicious, it's a delightful treat for any chocolate lover.</p>
                    </div>
                    <div id="content-2" class="dynamic-text">
                        <p class="font-mer text-h1">Cheese Cake</p>
                        <p class="font-mer"> A decadent mint-flavored cake infused with rich chocolate and topped with a refreshing minty frosting. 
                        This delightful dessert combines the perfect balance of chocolate and mint, creating a perfect treat for those who love both flavors.</p>
                    </div>
                    <div id="content-3" class="dynamic-text">
                        <p class="font-mer text-h1">Mint Chocolate Poke Cake</p>
                        <p class="font-mer">A rich, fudgy brownie with a decadent chocolate flavor, made from the finest cocoa and premium ingredients. 
                        Perfectly moist and delicious, it's a delightful treat for any chocolate lover.</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="moving-text-banner w-full my-[5rem]">
        <div class="container mx-auto overflow-hidden">
            <div class="upper-text flex gap-5 justify-center moving-right">
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Freshly Baked</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Decadent Flavors</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Premium Ingredients</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Freshly Baked</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Decadent Flavors</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Premium Ingredients</p>
            </div>
            <div class="lower-text flex gap-5 justify-center moving-left mt-[2.625rem]">
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Indulge in our heavenly desserts</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Crafted with care and passion</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Perfect for any occasion</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Indulge in our heavenly desserts</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Crafted with care and passion</p>
                <p class="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">Perfect for any occasion</p>
            </div>
        </div>
    </section>

    <section class="w-full section-ingredients my-[5rem]">
        <div class="xxs-container mx-auto">
            <div class="flex flex-col items-center gap-6">
                <p class="max-w-[45rem] text-center">At our patisserie, every creation begins with the finest ingredients. From velvety French butter to rich, artisanal chocolate, each element is carefully selected to ensure exceptional flavor and texture.</p>
                <p class="text-center text-h1 text-[--Pink-Primary]">Pure. Authentic. Irresistible.</p>
                <div class="section-standard grid items-center justify-items-center gap-12 md:grid-cols-2 md:gap-6">
                    <div class="flex flex-col gap-6">
                        <div class="standard ">

                            <div class="img-icon">
                                <img class="size-10" src="{{ asset('storage/images/icons/ingredients-1.svg') }}" alt="">
                            </div>
                            <div class="standard-content">
                                <p>Freshness & Quality</p>
                                <p> Fresh dairy, premium flour, and seasonal fruits ensure rich flavors and perfect textures.</p>
                            </div>
                        </div>
                        <div class="standard ">
                             <div class="img-icon">
                                <img class="size-10" src="{{ asset('storage/images/icons/ingredients-2.svg') }}" alt="">
                            </div>
                            <div class="standard-content">
                                <p>Authenticity & Origin</p>
                                <p>Ingredients like French butter, Belgian chocolate, and Madagascar vanilla bring true artisanal taste.</p>
                            </div>
                        </div>
                        <div class="standard">
                            <div class="img-icon ">
                                <img class="size-10" src="{{ asset('storage/images/icons/ingredients-3.svg') }}" alt="">
                            </div>
                            <div class="standard-content">
                                <p>Purity & Natural Ingredients</p>
                                <p>No artificial additives—only pure, natural ingredients for the finest pastries.</p>
                            </div>
                        </div>
                    </div>
                    <div class="ingredient-img relative inset-0">
                        <img src="{{ asset('storage/images/elements/ingredients-big.jpg') }}" alt="">
                        <img class="absolute right-5 bottom-2 w-[5rem] " src="{{ asset('storage/images/elements/ingredient-bounce-2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <section class="w-full section-freqAsked my-[5rem]">
        <div class="xxs-container mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-[2.62rem]">
                <div class="md:max-w-[45%] flex flex-col gap-6">
                    <p>Have a sweet question?</p>
                    <p class="font-mer text-h1">FREQUENTLY ASKED QUESTIONS</p>
                    <p>Our team is here to assist you with any inquiries.
                    Explore these answers to commonly asked questions about our patisserie, or feel free to reach out to us directly.</p>
                </div>
                <div class="flex flex-col gap-4 flex-1 w-full ">
                    <button class="p-5 flex justify-between items-center group gap-6">
                        <div class="flex flex-col text-left">
                            <p>Do you offer custom cakes for special occasions?</p>
                            <div class="h-0 overflow-hidden group-focus:h-[7rem] transition-all">
                                <p class="pt-2">Yes! We specialize in custom cakes for birthdays, weddings, and other special events. You can choose from a variety of flavors, designs, and decorations. We recommend placing your order at least 48 hours in advance.</p>
                            </div>
                        </div>
                        <img class="size-5" src="{{ asset('storage/images/icons/donut.svg') }}" alt="">

                    </button>
                    <button class="p-5 flex justify-between items-center group gap-6">
                        <div class="flex flex-col text-left">
                            <p>Are your pastries made fresh daily?</p>
                            <div class="h-0 overflow-hidden group-focus:h-[7rem] transition-all">
                                <p class="pt-2">Absolutely! All of our pastries, cakes, and breads are made fresh every morning using the finest ingredients to ensure the best quality and taste.</p>
                            </div>
                        </div>
                        <img class="size-5" src="{{ asset('storage/images/icons/donut.svg') }}" alt="">
                    </button>
                    <button class="p-5 flex justify-between items-center group gap-6">
                        <div class="flex flex-col text-left">
                            <p>Do you have gluten-free or vegan options?</p>
                            <div class="h-0 overflow-hidden group-focus:h-[7rem] transition-all">
                                <p class="pt-2">Yes, we offer a selection of gluten-free and vegan pastries. However, since our kitchen handles wheat and dairy, we recommend informing us of any allergies when placing an order.</p>
                            </div>
                        </div>
                        <img class="size-5" src="{{ asset('storage/images/icons/donut.svg') }}" alt="">
                    </button>
                    <button class="p-5 flex justify-between items-center group gap-6">
                        <div class="flex flex-col text-left">
                            <p>Can I place an order online for pickup or delivery?</p>
                            <div class="h-0 overflow-hidden group-focus:h-[7rem] transition-all">
                                <p class="pt-2">Yes, you can order online through our website or call us directly for pickup and delivery options. Delivery availability may vary based on your location.</p>
                            </div>
                        </div>
                        <img class="size-5" src="{{ asset('storage/images/icons/donut.svg') }}" alt="">
                    </button>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('footer')
    @include('partials.footer')
@endsection