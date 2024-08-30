@extends('layouts.frontend-layout')

@section('content')

@include('frontend.partials.home.header-section')

@include('frontend.partials.home.diseases-section')

@include('frontend.partials.home.banner-section')

<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                <div class="p-sticky">
                    <div class="ratio_156">
                        <div class="home-contain hover-effect">
                            <img src="/assets/images/banners/vertical-1.png" class="bg-img blur-up lazyload" alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h6 class="text-yellow home-banner">All Range Available </h6>
                                    <h3 class="text-uppercase fw-normal">
                                        <span class="theme-color fw-bold">Medical Equipments</span>
                                    </h3>
                                    <h3 class="fw-light">Same Day Delivery</h3>
                                    <a href="#" class="btn btn-animation btn-md mend-auto d-inline-flex">
                                        Shop Now
                                        <i class="fa-solid fa-arrow-right icon"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ratio_medium section-t-space">
                        <div class="home-contain hover-effect">
                            <img src="/assets/images/banners/vertical-2.png" class="img-fluid blur-up lazyload" alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h4 class="text-yellow home-banner">Extra Discount On</h4>
                                    <h3 class="text-uppercase fw-normal">
                                        <span class="theme-color fw-bold">Baby Care</span>
                                    </h3>
                                    <h3 class="fw-light">Super Offer to 50% Off</h3>
                                    <a href="#" class="btn btn-animation btn-md mend-auto">
                                        Shop Now
                                        <i class="fa-solid fa-arrow-right icon"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ratio_medium section-t-space">
                        <div class="home-contain hover-effect">
                            <img src="/assets/images/banners/11.jpg" class="img-fluid blur-up lazyload" alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h4 class="text-yellow text-exo home-banner">Organic</h4>
                                    <h2 class="text-uppercase fw-normal mb-0 text-russo theme-color">fresh</h2>
                                    <h2 class="text-uppercase fw-normal text-title">Vegetables</h2>
                                    <p class="mb-3">Super Offer to 50% Off</p>
                                    <button onclick="location.href = '#';"
                                        class="btn btn-animation btn-md mend-auto">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-9 col-xl-8">

                @include('frontend.partials.home.product-section')

                <div class="section-b-space">
                    <div class="row g-md-4 g-3">
                        <div class="col-md-12">
                            <div class="banner-contain">
                                <img src="{{ asset('assets/images/banners/horizonal-1.jpg') }}"
                                    class="bg-img blur-up lazyload" alt="">
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

@include('frontend.partials.home.shop-by-category')

<img src="{{asset('assets/images/banners/horizontal-2.jpg') }}" class="blur-up lazyload mw-100" alt="">

<section class="banner-section">
    <div class="container-fluid-lg">
        <div class="row gy-lg-0 gy-3">
            <div class="col-lg-8">
                <div class="banner-contain-3 h-100 pt-sm-5 hover-effect bg-size blur-up lazyloaded ">
                    <img src="/assets/images/banners/6.png" class="bg-img blur-up lazyload" alt="">
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
                            <button class="btn theme-bg-color text-white mt-sm-4 mt-3 fw-bold"
                                onclick="location.href = 'shop-left-sidebar.html';">Read More</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="banner-contain-3 pt-lg-4 h-100 hover-effect">
                    <a href="javascript:void(0)">
                        <img src="assets/images/banners/7.jpg" class="img-fluid social-image blur-up w-100 lazyloaded"
                            alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-10 col-xl-10">
                @include('frontend.partials.home.products-second-section')
            </div>
            <div class="col-xxl-2 col-xl-2 reto">
                <img src="{{ asset('assets/images/banners/vertical-3.png') }}" class="img-fluid social-image blur-up w-100 lazyloaded" alt="">
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.home.shop-by-brands')

<img src="{{asset('assets/images/banners/horizontal-3.png') }}" class="blur-up lazyload mw-100" alt="">

<x-include-plugins :plugins="['slickSlider']"></x-include-plugins>
@endsection