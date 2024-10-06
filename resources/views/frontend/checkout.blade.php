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
            user: @json(auth()->user()),
            user_email: "{{ auth()->user()->email ?? '' }}",
            razorpay_for_vendor: "{{ getSetting('razorpay_for_vendor') }}",
            razorpay_for_customer: "{{ getSetting('razorpay_for_customer') }}"
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endpush
@endsection