@extends('layouts.frontend-layout')
@section('title', 'Lab Package Details')

@section('content')
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="row g-4">
                    <div class="col-xl-5">
                        <div class="product-left-box">
                            <div class="row g-2">
                                <div class="col-12 position-relative">
                                    <div class="product-main-1 no-arrow">
                                        <div class="slider-image">
                                            <img src="{{ asset($labPackage->image ?? 'assets/images/default/lab.png') }}"
                                                data-zoom-image="{{ asset($labPackage->image ?? 'assets/images/default/lab.png') }}"
                                                class="img-fluid image_zoom_cls-0 lazyload" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7" data-wow-delay="0.1s">
                        <div class="right-box-contain">
                            <x-success-message :message="session('success')" />

                            <h2 class="name">{{ $labPackage->name }}</h2>
                            <div class="price-rating">
                                <h3 class="theme-color price">₹{{ $labPackage->amount }}</h3>
                            </div>

                            <div class="product-contain">
                                <p>{{ $labPackage->description }}</p>
                            </div>

                            
                            <div class="pickup-box">
                                <div class="product-title">
                                    <h4>{{ $labPackage->package_title }}:</h4>
                                </div>

                                <div class="product-info">
                                    <ul class="product-info-list product-info-list-2">
                                        @foreach ($labPackage->labTests as $labTest)                                            
                                        <li>
                                            <a href="javascript:void(0)">{{ $labTest->name }} : </a>
                                            {{ $labTest->description }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="note-box product-package">
                                <a href="{{ route('lab-package.book', $labPackage->id) }}" class="btn btn-md bg-dark cart-button text-white w-100">Book Lab Package</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection