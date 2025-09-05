@extends('layouts.app')
@section('title', 'product information')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div id="product-info-page-root" data-product-id="{{ $productId }}"></div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@push("scripts")
    @viteReactRefresh
    @vite(['resources/js/entries/ProductInfoIndex.jsx'])
@endpush