@extends('layouts.frontend-layout')
@section('title', $category->name)

@section('content')
<img src="{{ asset($category->banner_image ?? getSetting('default_category_banner_image')) }}" alt="" class="mw-100 mx-auto d-block">

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <category-products :filter-param="'category_ids'" :filter-value="@json($category->id)"></category-products>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
@endpush
@endsection