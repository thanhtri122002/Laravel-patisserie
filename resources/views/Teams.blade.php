@extends('layouts.app')

@section('title', 'Our Team')

@section('header')
    @include('partials.header')
@endsection

@section('content')

    <section class="w-full relative my-[2rem]">
        <div class="container mx-auto flex flex-col md:flex-row justify-center items-center">
            <div class="flex flex-col justify-center flex-1">
                <p class="font-mer text-h1 text-start">Hey,</p>
                <p class="font-mer text-h1 text-start">We'are glamour</p>
                <p class="font-mer text-body">Crafting exquisite pastries with passion and precision. Every bite is a taste of elegance and indulgence.</p>
            </div>
            <div class="flex justify-center items-center flex-1 relative">
                <div class="absolute bottom-[-20px] left-1/2 transform -translate-x-1/2 w-3/4 h-[100px] bg-[#F1EAE3] rounded-lg shadow-lg z-0"></div>
                <img class="w-full max-w-[500px] h-auto object-cover rounded-lg shadow-lg relative z-10" src="{{ asset('storage/about-us-1.jpg') }}" alt="">
            </div>
        </div>
    </section>
    <section class="w-full relative min-h-[70dvh] my-[2rem]">
        <div class="small-container mx-auto flex flex-col justify-center items-center">
            <div class="flex flex-col items-center justify-center">
                <p class="font-mer text-body text-center w-[70%]">Our dedicated team of pastry chefs and artisans pour their passion into every creation, bringing you the finest treats with love and expertise!</p>
                <p class="font-mer text-h1 text-center">Meet our teams</p>
            </div>
            <div class="people grid grid-cols-2 md:grid-cols-3 gap-[3rem] mt-8 ">
                <div class="our-team relative">
                    <div class="picture">
                        <img src="{{ asset('storage/images/elements/ceo.jpg') }}" alt="">
                    </div>
                    <div class="member">
                        <p>Tri Thanh</p>
                        <p>CEO</p>
                    </div>
                    <div class="social flex justify-center items-center">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div>
                <div class="our-team relative">
                    <div class="picture">
                        <img src="{{ asset('storage/images/elements/ceo.jpg') }}" alt="">
                    </div>
                    <div class="member">
                        <p>Tri Thanh</p>
                        <p>CEO</p>
                    </div>
                    <div class="social flex justify-center items-center">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div>
                <div class="our-team relative">
                    <div class="picture">
                        <img src="{{ asset('storage/images/elements/ceo.jpg') }}" alt="">
                    </div>
                    <div class="member">
                        <p>Tri Thanh</p>
                        <p>CEO</p>
                    </div>
                    <div class="social flex justify-center items-center">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div>
                <div class="our-team relative">
                    <div class="picture">
                        <img src="{{ asset('storage/images/elements/ceo.jpg') }}" alt="">
                    </div>
                    <div class="member">
                        <p>Tri Thanh</p>
                        <p>CEO</p>
                    </div>
                    <div class="social flex justify-center items-center">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="w-full my-[2rem]">
        <div class="xxs-container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="ceo-picture w-[90%] relative">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/images/elements/ceo.jpg') }}" alt="">
                    <div class="glass absolute top-1/2 -right-5 transform -translate-y-1/2">
                        <p class="font-mer text-h2">CEO</p>
                    </div>
                </div>
                <div class="ceo-message">
                    <p class="font-mer text-h1">NGUYEN TRI THANH</p>
                    <p class="font-mer text-h2">CEO</p>
                    <p class="font-mer text-body">As the founder, I want to take a moment to express my deepest gratitude to each and every one of you. Our journey has been incredible, and it’s all because of the dedication, creativity, and hard work that you bring to this team every day.</p>
    
                    <p class="font-mer text-body">When we started this venture, the vision was clear—to create something meaningful, impactful, and driven by passion. Seeing how far we’ve come, I couldn’t be prouder of what we have achieved together.</p>
                    
                    <p class="font-mer text-body">But this is just the beginning. The road ahead is full of opportunities, and with a team as talented as ours, I have no doubt that we will reach even greater heights.</p>
                    
                    <p class="font-mer text-body">Let’s continue to support and inspire one another, embrace challenges, and push boundaries. Thank you for being part of this incredible journey—I’m excited for what’s next!</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection