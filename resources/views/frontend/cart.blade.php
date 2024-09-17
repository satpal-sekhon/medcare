@extends('layouts.frontend-layout')
@section('title', 'Cart')

@section('content')

@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

<section class="cart-section section-b-space">
    <div class="container-fluid-lg">
        <cart></cart>
    </div>
</section>
@endsection