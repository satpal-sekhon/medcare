@extends('layouts.frontend-layout')
@section('title', 'Wishlist')

@section('content')
<section class="wishlist-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-sm-3 g-2">
            <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">
                <div class="product-box-3 h-100">
                    <div class="product-header">
                        <div class="product-image">
                            <a href="#">
                                <img src="{{ asset('assets/images/product/2.png') }}" class="img-fluid lazyload"
                                    alt="">
                            </a>

                            <div class="product-header-top">
                                <button class="btn wishlist-button close_button">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-footer">
                        <div class="product-detail">
                            <span class="span-name">Hygiene</span>
                            <a href="#">
                                <h5 class="name">Product 1 name</h5>
                            </a>
                            <h6 class="unit mt-1">250 ml</h6>
                            <h5 class="price">
                                <span class="theme-color">₹08.02</span>
                                <del>₹15.15</del>
                            </h5>

                            <div class="add-to-cart-box bg-white mt-2">
                                <button class="btn btn-add-cart addcart-button">Add
                                    <span class="add-icon bg-light-gray">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                </button>
                                <div class="cart_qty qty-box">
                                    <div class="input-group bg-white">
                                        <button type="button" class="qty-left-minus bg-gray" data-type="minus"
                                            data-field="">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input class="form-control input-number qty-input" type="text"
                                            name="quantity" value="0">
                                        <button type="button" class="qty-right-plus bg-gray" data-type="plus"
                                            data-field="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">
                <div class="product-box-3 h-100">
                    <div class="product-header">
                        <div class="product-image">
                            <a href="#">
                                <img src="{{ asset('assets/images/product/3.png') }}" class="img-fluid lazyload" alt="">
                            </a>

                            <div class="product-header-top">
                                <button class="btn wishlist-button close_button">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-footer">
                        <div class="product-detail">
                            <span class="span-name">Hygiene</span>
                            <a href="#">
                                <h5 class="name">Product 2 name</h5>
                            </a>
                            <h6 class="unit mt-1">550 G</h6>
                            <h5 class="price">
                                <span class="theme-color">₹14.25</span>
                                <del>₹16.57</del>
                            </h5>

                            <div class="add-to-cart-box bg-white mt-2">
                                <button class="btn btn-add-cart addcart-button">Add
                                    <span class="add-icon bg-light-gray">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                </button>
                                <div class="cart_qty qty-box">
                                    <div class="input-group bg-white">
                                        <button type="button" class="qty-left-minus bg-gray" data-type="minus"
                                            data-field="">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input class="form-control input-number qty-input" type="text"
                                            name="quantity" value="0">
                                        <button type="button" class="qty-right-plus bg-gray" data-type="plus"
                                            data-field="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection