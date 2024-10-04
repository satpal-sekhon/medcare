@extends('layouts.frontend-layout')

@section('content')
@push('meta')
<meta name="title" content="{{ getSetting("home_meta_title") }}">
<meta name="keywords" content="{{ getSetting("home_meta_keywords") }}">
<meta name="description" content="{{ getSetting("home_meta_description") }}">
@endpush

@include('frontend.partials.home.header-section')

@if($diseases->count() > 0)
@include('frontend.partials.home.diseases-section')
@endif

@include('frontend.partials.home.offers-section')

<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">

            <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                <div class="p-sticky">

                    <div class="ratio_156">
                        <div class="home-contain hover-effect bg-size blur-up lazyloaded">
                            <img src="{{ asset('assets/images/banners/vertical-1.png') }}" class="bg-img blur-up lazyload" alt="" style="display: none;">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h6 class="text-yellow home-banner">All Range Available</h6>
                                    <h3 class="text-uppercase fw-normal"><span class="theme-color fw-bold">Medical
                                            Equipments</span></h3>
                                    <h3 class="fw-light">Same Day Delivery</h3>
                                    <button onclick="#" class="btn btn-animation btn-md mend-auto">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ratio_medium section-t-space">
                        <div class="home-contain hover-effect">
                            <img src="{{ asset('assets/images/banners/vertical-2.png') }}" class="img-fluid blur-up lazyloaded" alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h4 class="text-yellow text-exo home-banner">Extra Discount On</h4>
                                    <h2 class="text-uppercase fw-normal mb-0 text-russo theme-color">Baby Care</h2>
                                    <p class="mb-3">Super Offer to 50% Off</p>
                                    <button class="btn btn-animation btn-md mend-auto">
                                        Shop Now 
                                        <i class="fa-solid fa-arrow-right icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-xl-8">
                @if($generalProducts->count())
                @include('frontend.partials.home.general-products')
                @else
                <x-warning-message message="We will launch products soon!"></x-warning-message>
                @endif

                <div class="section-b-space">
                    <div class="row g-md-4 g-3">
                        <div class="col-md-12">
                            <div class="banner-contain">
                                <img src="{{ asset($homePage->home_horizontal_image_1) }}"
                                    class="lazyload d-block mx-auto" alt="" style="max-height: 150px">
                            </div>
                        </div>
                    </div>
                </div>

                @include('frontend.partials.home.best-seller')
            </div>
        </div>
    </div>
</section>

@if($categories->count() > 0)
@include('frontend.partials.home.shop-by-category')
@endif

@if ($homePage->home_horizontal_image_2_link)
<a href="{{ $homePage->home_horizontal_image_2_link }}">
    @endif
    <img src="{{asset($homePage->home_horizontal_image_2) }}" class="lazyload mw-100" alt="">
    @if ($homePage->home_horizontal_image_2_link)
</a>
@endif

<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-10 col-xl-10">
                @if ($genericProducts->count() > 0)
                @include('frontend.partials.home.generic-products')
                @else
                <x-warning-message message="We will launch medicines soon!"></x-warning-message>
                @endif
            </div>
            <div class="col-xxl-2 col-xl-2 reto">
                <img src="{{ asset('assets/images/banners/vertical-3.png') }}" width="100%" class="img-fluid social-image blur-up w-100 lazyloaded" alt="">
            </div>
        </div>
    </div>
</section>

@if($brands->count() > 0)
@include('frontend.partials.home.shop-by-brands')
@endif

@if ($homePage->home_horizontal_image_3_link)
<a href="{{ $homePage->home_horizontal_image_3_link }}">
    @endif
    <img src="{{asset($homePage->home_horizontal_image_3) }}" class="lazyload mw-100" alt="">
    @if ($homePage->home_horizontal_image_3_link)
</a>
@endif

<x-include-plugins :plugins="['slickSlider']"></x-include-plugins>
@endsection