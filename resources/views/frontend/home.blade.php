@extends('layouts.frontend-layout')

@section('content')

@include('frontend.partials.home.header-section')

@if($diseases->count() > 0)
@include('frontend.partials.home.diseases-section')
@endif

@include('frontend.partials.home.banner-section')

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
                                <img src="{{ asset('assets/images/banners/horizonal-1.jpg') }}"
                                    class="bg-img lazyload" alt="">
                                <div class="banner-details p-center p-4 text-white text-center">
                                    <div>
                                        <h3 class="lh-base fw-bold offer-text">Get ₹ 300 Cashback! Min Order of ₹ 30
                                        </h3>
                                        <h6 class="coupon-code">Use Code : MEDI4578</h6>
                                    </div>
                                </div>
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

<img src="{{asset('assets/images/banners/horizontal-2.jpg') }}" class="lazyload mw-100" alt="">

<section class="banner-section">
    <div class="container-fluid-lg">
        <div class="row gy-lg-0 gy-3">
            <div class="col-lg-8">
                <div class="banner-contain-3 h-100 pt-sm-5 hover-effect bg-size lazyloaded ">
                    <img src="/assets/images/banners/6.png" class="bg-img lazyload" alt="">
                    <div
                        class="banner-detail banner-p-sm p-center-right position-relative banner-minus-position banner-detail-deliver">
                        <div>
                            <h3 class="fw-bold banner-contain">Safe Delivery to the door</h3>
                            <h4 class="mb-sm-3 mb-2 delivery-contain">Make money on your terms. Anytime and anyhow.
                            </h4>
                            <ul class="banner-list">
                                <li>
                                    <div class="delivery-box">
                                        <div class="check-icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="check-contain">
                                            <h5>Get live order tracking</h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="delivery-box">
                                        <div class="check-icon">
                                            <i class="fa-solid fa-check"></i>
                                        </div>

                                        <div class="check-contain">
                                            <h5>Get latest feature updates</h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <button class="btn theme-bg-color text-white mt-sm-4 mt-3 fw-bold">Read More</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="banner-contain-3 pt-lg-4 h-100 hover-effect">
                    <a href="javascript:void(0)">
                        <img src="assets/images/banners/7.jpg" class="img-fluid social-image w-100 lazyloaded" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

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

<img src="{{asset('assets/images/banners/horizontal-3.png') }}" class="lazyload mw-100" alt="">

<x-include-plugins :plugins="['slickSlider']"></x-include-plugins>
@endsection