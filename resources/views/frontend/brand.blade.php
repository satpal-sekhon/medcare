@extends('layouts.frontend-layout')
@section('title', $brand->name)

@section('content')
<img src="{{ asset($brand->banner_image ?? getSetting('default_brand_banner_image')) }}" alt="" class="mw-100 mx-auto d-block">

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <category-products :filter-param="'brand_ids'" :filter-value="@json($brand->id)"></category-products>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
@endpush
@endsection