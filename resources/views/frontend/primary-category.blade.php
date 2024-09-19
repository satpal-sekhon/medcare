@extends('layouts.frontend-layout')
@section('title', $primaryCategory->name)

@section('content')
<img src="{{ asset($primaryCategory->banner_image ?? getSetting('default_primary_category_banner_image')) }}" alt="" class="mw-100 mx-auto d-block">

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <category-products :filter-param="'primary_category_ids'" :filter-value="@json($primaryCategory->id)"></category-products>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
@endpush
@endsection