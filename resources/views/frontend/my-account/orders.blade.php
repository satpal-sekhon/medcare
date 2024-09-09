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

    <x-success-message :message="session('success')" />


    <div class="order-contain">
        <div class="order-box dashboard-bg-box w-100">
            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="products-tab" data-bs-toggle="tab"
                        data-bs-target="#products" type="button" role="tab">Products</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="lab-packages-tab" data-bs-toggle="tab"
                        data-bs-target="#lab-packages" type="button" role="tab">Lab Packages</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="doctor-consultations-tab" data-bs-toggle="tab"
                        data-bs-target="#doctor-consultations" type="button" role="tab">Doctor Consultations</button>
                </li>
            </ul>
            
            <div class="tab-content custom-tab" id="myTabContent">
                <div class="tab-pane fade show active p-4" id="products" role="tabpanel">
                    <x-warning-message message="You don't have any products order yet"></x-warning-message>
                    {{-- <div class="order-container pt-4">
                        <div class="order-icon">
                            <i data-feather="box"></i>
                        </div>
            
                        <div class="order-detail">
                            <h4>Delivers <span>Pending</span></h4>
                            <h6 class="text-content">Product is Under Process & It Will be Delivered to you on Time. &
                                Product is Under Process & It Will be Delivered to you on Time.</h6>
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
            
                                <!-- <li>
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
                                </li> -->
            
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
                    </div> --}}
                    
                </div>
            
                <div class="tab-pane fade" id="lab-packages" role="tabpanel">
                    @forelse($labPackageOrders as $order)
                        <div class="product-order-detail">
                            <a href="#" class="order-image">
                                <img src="{{ asset('assets/images/product/2.png') }}" class="blur-up lazyload" alt="">
                            </a>

                            <div class="order-wrap">
                                <a href="{{ route('lab-package.show', $order->labPackage->id) }}" target="_blank">
                                    <h3>{{ $order->labPackage->name }}</h3>
                                </a>
                                <p class="text-content">{{  }}</p>
                                <ul class="product-size">
                                    <li>
                                        <div class="size-box">
                                            <h6 class="text-content">Price : </h6>
                                            <h5>₹20.68</h5>
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
                    @empty
                        <x-warning-message message="You don't have booked any lab package yet"></x-warning-message>
                    @endforelse
                    
                </div>
            
                <div class="tab-pane fade" id="doctor-consultations" role="tabpanel">
                    <!-- Doctor Consultations Content Here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection