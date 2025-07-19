@extends('layouts.app')

@section('title', 'Authentic form')

@section('content')
    <div id="auth-form-toggle-root"></div>
@endsection

@section('footer')
    @viteReactRefresh
    @vite(['resources/js/entries/AuthFormToggle.jsx'])
@endsection




