@extends('layouts.frontend-layout')
@section('title', 'Checkout')

@section('content')

@push('styles')
    <script>
        window.appData = {
            states: @json($states) // Safely encode PHP data to JSON
        };
    </script>
@endpush

<section class="checkout-section-2 section-b-space">
    <div class="container-fluid-lg">
        <checkout></checkout>
    </div>
</section>

@push('scripts')
<script src="{{ asset('assets/js/checkout/lusqsztk.js') }}"></script>
@endpush
@endsection