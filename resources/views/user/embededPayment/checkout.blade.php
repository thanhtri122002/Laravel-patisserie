@extends('layouts.app')

@section('title', 'checkout')

@section('content')
    <section class='w-full relative'>
        <div id="checkout"></div>
    </section>
@endsection

@push('scripts')
    <script>
        const invoiceId = @json($invoice->id);
    </script>
    @vite('resources/js/checkout.js')
@endpush
