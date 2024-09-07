@extends('layouts.user-account')
@section('title', 'User Dashboard')

@section('my-account')
<div class="dashboard-order">
    <div class="title">
        <h2>My Orders History</h2>
        <span class="title-leaf title-leaf-gray">
            <svg class="icon-width bg-gray">
                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
            </svg>
        </span>
    </div>

    <div class="order-contain">
        <div class="order-box dashboard-bg-box">
            <div class="order-container">
                <div class="order-icon">
                    <i data-feather="box"></i>
                </div>

                <div class="order-detail">
                    <h4>Delivers <span>Pending</span></h4>
                    <h6 class="text-content">Product is Under Process & It Will be Delivered to you on Time. & Product is Under Process & It Will be Delivered to you on Time.</h6>
                </div>
            </div>

            <div class="product-order-detail">
                <a href="#" class="order-image">
                    <img src="{{ asset('assets/images/product/1.png') }}" class="blur-up lazyload" alt="">
                </a>

                <div class="order-wrap">
                    <a href="#">
                        <h3>Product 1 Name</h3>
                    </a>
                    <p class="text-content">Use with Care, Product Descrption & Short Details</p>
                    <ul class="product-size">
                        <li>
                            <div class="size-box">
                                <h6 class="text-content">Price : </h6>
                                <h5>₹20.68</h5>
                            </div>
                        </li>

                        <li>
                            <div class="size-box">
                                <h6 class="text-content">Rate : </h6>
                                <div class="product-rating ms-2">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="size-box">
                                <h6 class="text-content">Sold By : </h6>
                                <h5>Seller Name</h5>
                            </div>
                        </li>

                        <li>
                            <div class="size-box">
                                <h6 class="text-content">Quantity : </h6>
                                <h5>250 G</h5>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="order-box dashboard-bg-box">
            <div class="order-container">
                <div class="order-icon">
                    <i data-feather="box"></i>
                </div>

                <div class="order-detail">
                    <h4>Delivered <span class="success-bg">Success</span></h4>
                    <h6 class="text-content">Product is Under Process & It Will be Delivered to you on Time. & Product is Under Process & It Will be Delivered to you on Time.</h6>
                </div>
            </div>

            <div class="product-order-detail">
                <a href="#" class="order-image">
                    <img src="{{ asset('assets/images/product/2.png') }}" class="blur-up lazyload" alt="">
                </a>

                <div class="order-wrap">
                    <a href="#">
                        <h3>Product 1 Name</h3>
                    </a>
                    <p class="text-content">Use with Care, Product Descrption & Short Details</p>
                    <ul class="product-size">
                        <li>
                            <div class="size-box">
                                <h6 class="text-content">Price : </h6>
                                <h5>₹20.68</h5>
                            </div>
                        </li>

                        <li>
                            <div class="size-box">
                                <h6 class="text-content">Rate : </h6>
                                <div class="product-rating ms-2">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="size-box">
                                <h6 class="text-content">Sold By : </h6>
                                <h5>Seller Name</h5>
                            </div>
                        </li>

                        <li>
                            <div class="size-box">
                                <h6 class="text-content">Quantity : </h6>
                                <h5>250 G</h5>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection