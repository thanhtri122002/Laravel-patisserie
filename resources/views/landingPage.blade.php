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
<script type="module">
        @if(auth()->check())
            window.userId = {{ auth()->id() }};
            console.log(window.userId);
            
        @endif
    </script>
@endpush