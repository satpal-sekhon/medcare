@extends('layouts.frontend-layout')
@section('title', 'Pharmacy')

@section('content')
@push('meta')
<meta name="title" content="{{ $metaTags->meta_name }}">
<meta name="keywords" content="{{ $metaTags->meta_keywords }}">
<meta name="description" content="{{ $metaTags->meta_description }}">
@endpush


<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row section-b-space">
            <pharmacy-shops></pharmacy-shops>
        </div>
    </div>
</section>
@endsection