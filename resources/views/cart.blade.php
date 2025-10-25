@extends('layouts.app')

@section('title', 'Cart Details')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div id="cart-page-root"></div>
@endsection


@section('footer')
    @include('partials.footer')
@endsection

@push('scripts')
    @viteReactRefresh
    @vite(['resources/js/entries/CartIndex.jsx'])
@endpush