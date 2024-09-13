@extends('layouts.frontend-layout')
@section('title', 'Pharmacy')

@section('content')
<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row section-b-space">
            <!-- Search Pharmacy Section -->
            <div class="row mb-4">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="title d-block">
                        <div class="text-center">
                            <h2>Search for Nearest Pharma Shop</h2>
                        </div>
                    </div>

                    <div class="search-box rounded">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-pill"
                                placeholder="Search by Name, Pincode or City...">
                            <button class="btn theme-bg-color text-white m-0 absolute" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pharmacy List -->
            <div class="col-12  section-t-space">
                <div class="row product-list-section">
                    <div class="col-md-4 mb-4">
                        <div class="product-box-3 row mx-1">
                            <div class="col-md-5 product-image d-flex align-items-center">
                                <a href="#">
                                    <img src="{{ asset('assets/images/default/pharmacy.png') }}"
                                        class="img-fluid lazyload" alt="">
                                </a>
                            </div>
                            <div class="col-md-7 product-detail-wrapper d-flex flex-column justify-content-between">
                                <div class="product-detail">
                                    <h4 class="name fw-bold">247 Medicine Shop</h4>
                                    <div class="product-rating mt-2">
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
                                        <span>(4.0)</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="mb-2">
                                        <strong>Pincode:</strong> 123456
                                    </div>
                                    <div class="mb-2">
                                        <strong>Location:</strong> Mohali, Chandigarh
                                    </div>
                                    <div>
                                        <a href="#" class="badge theme-bg-color text-white rounded-pill px-3 py-2 fs-12">
                                            <i class="fa fa-shopping-cart me-2"></i>
                                            <span>Order Medicine</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="product-box-3 row mx-1">
                            <div class="col-md-5 product-image d-flex align-items-center">
                                <a href="#">
                                    <img src="{{ asset('assets/images/default/pharmacy.png') }}"
                                        class="img-fluid lazyload" alt="">
                                </a>
                            </div>
                            <div class="col-md-7 product-detail-wrapper d-flex flex-column justify-content-between">
                                <div class="product-detail">
                                    <h4 class="name fw-bold">247 Medicine Shop</h4>
                                    <div class="product-rating mt-2">
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
                                        <span>(4.0)</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="mb-2">
                                        <strong>Pincode:</strong> 123456
                                    </div>
                                    <div class="mb-2">
                                        <strong>Location:</strong> Mohali, Chandigarh
                                    </div>
                                    <div>
                                        <a href="#" class="badge theme-bg-color text-white rounded-pill px-3 py-2 fs-12">
                                            <i class="fa fa-shopping-cart me-2"></i>
                                            <span>Order Medicine</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="product-box-3 row mx-1">
                            <div class="col-md-5 product-image d-flex align-items-center">
                                <a href="#">
                                    <img src="{{ asset('assets/images/default/pharmacy.png') }}"
                                        class="img-fluid lazyload" alt="">
                                </a>
                            </div>
                            <div class="col-md-7 product-detail-wrapper d-flex flex-column justify-content-between">
                                <div class="product-detail">
                                    <h4 class="name fw-bold">247 Medicine Shop</h4>
                                    <div class="product-rating mt-2">
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
                                        <span>(4.0)</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="mb-2">
                                        <strong>Pincode:</strong> 123456
                                    </div>
                                    <div class="mb-2">
                                        <strong>Location:</strong> Mohali, Chandigarh
                                    </div>
                                    <div>
                                        <a href="#" class="badge theme-bg-color text-white rounded-pill px-3 py-2 fs-12">
                                            <i class="fa fa-shopping-cart me-2"></i>
                                            <span>Order Medicine</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="product-box-3 row mx-1">
                            <div class="col-md-5 product-image d-flex align-items-center">
                                <a href="#">
                                    <img src="{{ asset('assets/images/default/pharmacy.png') }}"
                                        class="img-fluid lazyload" alt="">
                                </a>
                            </div>
                            <div class="col-md-7 product-detail-wrapper d-flex flex-column justify-content-between">
                                <div class="product-detail">
                                    <h4 class="name fw-bold">247 Medicine Shop</h4>
                                    <div class="product-rating mt-2">
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
                                        <span>(4.0)</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="mb-2">
                                        <strong>Pincode:</strong> 123456
                                    </div>
                                    <div class="mb-2">
                                        <strong>Location:</strong> Mohali, Chandigarh
                                    </div>
                                    <div>
                                        <a href="#" class="badge theme-bg-color text-white rounded-pill px-3 py-2 fs-12">
                                            <i class="fa fa-shopping-cart me-2"></i>
                                            <span>Order Medicine</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="product-box-3 row mx-1">
                            <div class="col-md-5 product-image d-flex align-items-center">
                                <a href="#">
                                    <img src="{{ asset('assets/images/default/pharmacy.png') }}"
                                        class="img-fluid lazyload" alt="">
                                </a>
                            </div>
                            <div class="col-md-7 product-detail-wrapper d-flex flex-column justify-content-between">
                                <div class="product-detail">
                                    <h4 class="name fw-bold">247 Medicine Shop</h4>
                                    <div class="product-rating mt-2">
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
                                        <span>(4.0)</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="mb-2">
                                        <strong>Pincode:</strong> 123456
                                    </div>
                                    <div class="mb-2">
                                        <strong>Location:</strong> Mohali, Chandigarh
                                    </div>
                                    <div>
                                        <a href="#" class="badge theme-bg-color text-white rounded-pill px-3 py-2 fs-12">
                                            <i class="fa fa-shopping-cart me-2"></i>
                                            <span>Order Medicine</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="custom-pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection