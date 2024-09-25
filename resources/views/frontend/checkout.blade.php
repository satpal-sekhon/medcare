@extends('layouts.frontend-layout')
@section('title', 'Checkout')

@section('content')

@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('styles')
    <script>
        window.appData = {
            states: @json($states),
            addresses: @json(auth()->user()->addresses ?? null),
            user_email: "{{ auth()->user()->email ?? '' }}"
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