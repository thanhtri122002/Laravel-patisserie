
@extends('layouts.app')

@section('title', 'Forgot password')

@section('content')
    <div id="forgot-password-root"></div>
@endsection


@push('scripts')
    @viteReactRefresh
    @vite(['resources/js/entries/ForgotPasswordIndex.jsx'])
@endpush




