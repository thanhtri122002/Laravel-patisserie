@extends('layouts.app')

@section('title', 'Products')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div id="product-page-root"></div> {{-- React mounts here --}}
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@push('scripts')
    @viteReactRefresh
    @vite(['resources/js/entries/ProductPageIndex.jsx'])
@endpush