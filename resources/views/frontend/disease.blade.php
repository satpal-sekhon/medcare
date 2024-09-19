@extends('layouts.frontend-layout')
@section('title', $disease->name)

@section('content')

<img src="{{ asset($disease->banner_image ?? getSetting('default_disease_banner_image')) }}" alt="" class="mw-100 mx-auto d-block">

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <category-products :filter-param="'disease_ids'" :filter-value="@json($disease->id)"></category-products>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
@endpush
@endsection