@extends('layouts.app')

@section('title', "Contact")

@section("header")
    @include("partials.header")
@endsection

@section('content')
    <div id="contact-page-root"></div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@push("scripts")
    @viteReactRefresh
    @vite(['resources/js/entries/ContactPageIndex.jsx'])
@endpush