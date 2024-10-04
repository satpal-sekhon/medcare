@extends('layouts.frontend-layout')
@section('title', 'Search Medicines')

@section('content')
@push('meta')
<meta name="title" content="{{ $metaTags->meta_name }}">
<meta name="keywords" content="{{ $metaTags->meta_keywords }}">
<meta name="description" content="{{ $metaTags->meta_description }}">
@endpush

<section class="search-section">
    <div class="container-fluid-lg">
        <generic-products></generic-products>
    </div>
</section>
@endsection