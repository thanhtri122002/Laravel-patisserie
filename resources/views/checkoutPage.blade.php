@extends('layouts.app')

@section('title', "checkout")

@section('header')
    @include('partials.header')
@endsection('header')

@section('content')
    <div id='checkout-page-root'></div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@push('scripts')
    @viteReactRefresh
    @vite(['resources/js/entries/CheckoutIndex.jsx'])
@endpush