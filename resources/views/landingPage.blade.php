@extends('layouts.app')

@section('title', 'LandingPage')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div id="home-page-root"></div>
@endsection

@section('footer') 
    @include('partials.footer')
@endsection

@push('scripts')
    @viteReactRefresh
    @vite(['resources/js/entries/LandingPageIndex.jsx'])
@endpush




