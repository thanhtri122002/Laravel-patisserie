@extends('layouts.app')

@section('title', 'Products')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section class="w-full h-[50dvh] relative banner">
        <div class="absolute left-0 right-0 h-[90%] bg-[--Layered-Overlay] opacity-50"></div>
        <img class="w-full h-[90%] object-cover" src="https://images.squarespace-cdn.com/content/v1/535469cde4b02e672cf340ef/1733862604022-Q3S29C5QGA43DLW45757/bakery+banner+2s.jpg?format=2500w" alt="">
        <div class="category-title flex flex-col">
            <p class="text-h1 font-mer text-center">Products</p>
            <p class="text-paragraph text-center font-mer text-[--Gray-Tertiary]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus.</p>
        </div>
    </section>

    <section class="products-section w-full relative">
        <div class="container mx-auto">
            <div data-react-component="ProductSection"></div>
        </div>    
    </section>
@endsection

@section('footer')
    @viteReactRefresh
    @vite(['resources/js/Pages/Product/index.jsx'])
    @include('partials.footer')
@endsection