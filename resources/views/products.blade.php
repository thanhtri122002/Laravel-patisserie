@extends('layouts.app')

@section('title', 'Products')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div id="product-page-root"></div> {{-- React mounts here --}}
@endsection

@section('footer')
    @viteReactRefresh
    @vite(['resources/js/entries/ProductPageIndex.jsx'])
    @include('partials.footer')
@endsection