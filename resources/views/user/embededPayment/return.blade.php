@extends('layouts.app')

@section('title', return )


@section('content')
    
    <section id="success" class="hidden">
        <p>
            We appreciate your business! A confirmation email will be sent to <span id="customer-email"></span>.
        </p>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/embeddedReturn.js') }}"></script>
@endpush
