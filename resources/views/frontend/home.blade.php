@extends('layouts.frontend-layout')

@section('content')

@include('frontend.partials.home.header-section')

@if($diseases->count() > 0)
@include('frontend.partials.home.diseases-section')
@endif

@include('frontend.partials.home.offers-section')

<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-12 col-xl-12">
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
            <div class="col-xxl-12 col-xl-12">
                @if ($genericProducts->count() > 0)
                    @include('frontend.partials.home.generic-products')
                @else
                    <x-warning-message message="We will launch medicines soon!"></x-warning-message>
                @endif
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