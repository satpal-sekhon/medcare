@extends('layouts.frontend-layout')
@section('title', 'Brands')

@section('content')
<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div
                    class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/default/brand.png') }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="#">
                                        <h4 class="text-center">Pfizer</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/default/brand.png') }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="#">
                                        <h4 class="text-center">Novartis</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/default/brand.png') }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="#">
                                        <h4 class="text-center">Sanofi</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/default/brand.png') }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="#">
                                        <h4 class="text-center">GlaxoSmithKline</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/default/brand.png') }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="#">
                                        <h4 class="text-center">Johnson & Johnson</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/default/brand.png') }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="#">
                                        <h4 class="text-center">Merck & Co.</h4>
                                    </a>
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