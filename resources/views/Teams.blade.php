@extends('layouts.app')

@section('title', 'Our Team')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section class="w-full relative min-h-[70dvh] my-[2rem]">
        <div class="small-container mx-auto flex flex-col justify-center items-center">
            <div class="flex flex-col items-center justify-center">
                <p class="font-mer text-body text-center w-[70%]">Our dedicated team of pastry chefs and artisans pour their passion into every creation, bringing you the finest treats with love and expertise!</p>
                <p class="font-mer text-h1 text-center">Meet our teams</p>
            </div>
            <div class="people grid grid-cols-1 md:grid-cols-3 gap-[3rem] mt-8 ">
                <div class="our-team relative">
                    <div class="picture">
                        <img src="" alt="">
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
                        <img src="" alt="">
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
                        <img src="" alt="">
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
                        <img src="" alt="">
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
@endsection

@section('footer')
    @include('partials.footer')
@endsection