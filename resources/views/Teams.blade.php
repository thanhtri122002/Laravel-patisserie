@extends('layouts.app')

@section('title', 'Our Team')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div id="team-page-root"></div>
    
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@push('scripts')
    @viteReactRefresh
    @vite(["resources/js/entries/TeamIndex.jsx"])
@endpush