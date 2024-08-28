@extends('layouts.frontend-layout')

@section('content')

@include('frontend.partials.home.header-section')
@include('frontend.partials.home.banner-section')

<!-- Product Section Start -->
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
                                    <h6 class="text-yellow home-banner">All Range Available                                    </h6>
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
                                <img src="{{ asset('assets/images/banners/horizonal-1.jpg') }}" class="bg-img blur-up lazyload" alt="">
                                <div class="banner-details p-center p-4 text-white text-center">
                                    <div>
                                        <h3 class="lh-base fw-bold offer-text">Get ₹ 300 Cashback! Min Order of ₹ 30</h3>
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
<!-- Product Section End -->

<x-include-plugins :plugins="['slickSlider']"></x-include-plugins>
@endsection