@extends('layouts.app')

@section('title', 'Authentic form')

@section('content')
    <div id="auth-form-toggle-root"></div>
@endsection


@push('scripts')
    @viteReactRefresh
    @vite(['resources/js/entries/AuthFormToggleIndex.jsx'])
@endpush




