@extends('layouts.frontend-layout')
@section('title', 'Products')

@section('content')
@push('meta')
<meta name="title" content="{{ $metaTags->meta_name }}">
<meta name="keywords" content="{{ $metaTags->meta_keywords }}">
<meta name="description" content="{{ $metaTags->meta_description }}">
@endpush

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <products></products>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
@endpush
@endsection