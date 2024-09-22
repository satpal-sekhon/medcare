@extends('layouts.frontend-layout')
@section('title', 'View Product')

@section('content')
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-9 col-xl-8 col-lg-7">
                <div class="row g-4">
                    <div class="col-xl-6">
                        <div class="product-left-box">
                            <div class="row g-2">
                                <div class="col-12 position-relative">
                                    @if($product->flag && $product->flag!='Casual')
                                    <div class="product-label-group">
                                        <div @class(["product-label-tag", "success-label-tag" => $product->flag=='Trending', "danger-label-tag" => $product->flag=='On Sale' ])>
                                            <span>{{ $product->flag }}</span>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="product-main-1 no-arrow">
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{ file_exists(public_path($product->thumbnail)) ? asset($product->thumbnail) : asset('assets/images/default/product.jpg') }}"
                                                    data-zoom-image="{{ file_exists(public_path($product->thumbnail)) ? asset($product->thumbnail) : asset('assets/images/default/product.jpg') }}"
                                                    class="img-fluid image_zoom_cls-0 d-block mx-auto lazyload" alt="">
                                            </div>
                                        </div>

                                        @foreach($product->images as $image)
                                        @if(file_exists(public_path($image->path)))
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{ asset($image->path) }}"
                                                    data-zoom-image="{{ $image->path }}"
                                                    class="img-fluid image_zoom_cls-1 lazyload" alt="">
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="bottom-slider-image left-slider no-arrow slick-top">
                                        @if ($product->images->count() > 0)
                                        <div>
                                            <div class="sidebar-image">
                                                <img src="{{ asset($product->thumbnail) }}" class="img-fluid lazyload"
                                                    alt="">
                                            </div>
                                        </div>
                                        @endif

                                        @foreach($product->images as $image)
                                        @if(file_exists(public_path($image->path)))
                                        <div>
                                            <div class="sidebar-image">
                                                <img src="{{ asset($image->path) }}" class="img-fluid lazyload" alt="">
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="right-box-contain">
                            {{-- <h6 class="offer-top">30% Off</h6> --}}
                            <h2 class="name">{{ $product->name }} - <span class="productUnitName">{{ $product->unit }}</span></h2>

                            <div class="chips-container mb-3">
                                @if($product->product_type=='Generic')
                                   @foreach ($product->diseases as $disease)
                                   <a href="{{ route('disease.view', diseaseSlug($disease->disease_id)) }}"><div class="chip">{{ diseaseName($disease->disease_id) }}</div></a>
                                   @endforeach
                                @else
                                    <a href="{{ route('category.view', $product->category->slug) }}"><div class="chip">{{ $product->category->name }}</div></a>
                                    <a href="{{ route('primary-category.view', $product->primaryCategory->slug) }}"><div class="chip">{{ $product->primaryCategory->name }}</div></a>
                                @endif

                                @if($product->is_prescription_required)
                                    <div class="chip bg-info">Rx required</div>
                                @endif
                            </div>

                            @if($product->composition)
                            <div class="card mb-3">
                                <div class="card-body d-flex gap-2 align-items-center">
                                    <div>
                                        <img src="{{ asset('assets/svg/composition.svg') }}" alt="">
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Composition</h5>
                                        <p class="m-0">{!! $product->composition !!}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($product->short_description)
                            <div class="product-contain">
                                {!! $product->short_description !!}
                            </div>
                            @endif

                            <div class="price-rating mt-3">
                                <h3 class="theme-color price">
                                    <span class="main-product-price fs-4 me-1">₹{{ $product->customer_price }}</span>
                                    <del class="text-content main-product-mrp">₹{{ $product->mrp }}</del>
                                    {{-- <span class="offer theme-color">(8% off)</span> --}}
                                </h3>
                                {{-- <div class="product-rating custom-rate">
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
                                    <span class="review">23 Customer Review</span>
                                </div> --}}
                            </div>

                            @if($product->variants->count() > 0)
                                <div class="product-package">
                                    <div class="product-title">
                                        <h4>Variant</h4>
                                    </div>

                                    <div class="select-package">
                                        <select name="variant_id" class="form-control form-select">
                                            <option value="">{{ $product->unit }}</option>
                                            @foreach($product->variants as $variant)
                                                <option value="{{ $variant->id }}" data-variant-price="{{$variant->customer_price}}" data-variant-mrp="{{$variant->mrp}}">{{ $variant->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @push('scripts')
                                    <script>
                                        $(function(){
                                            $('[name="variant_id"]').change(function(){
                                                $('.productUnitName').html($(this).find('option:selected').html());

                                                if($(this).val()){
                                                    let variant_price = $(this).find('option:selected').attr('data-variant-price');
                                                    let variant_mrp = $(this).find('option:selected').attr('data-variant-mrp');

                                                    $('.main-product-price').html(`₹${variant_price}`);
                                                    $('.main-product-mrp').html(`₹${variant_mrp}`);
                                                } else {
                                                    $('.main-product-price').html(`₹{{ $product->customer_price }}`);
                                                    $('.main-product-mrp').html(`₹{{ $product->mrp }}`);
                                                }
                                            })
                                        })
                                    </script>
                                @endpush
                            @endif

                            <quantity-box variant="product-detail" :product-Id="{{ $product->id }}" :initial-quantity="1"></quantity-box>

                            <div class="buy-box">
                                <a href="#">
                                    <i data-feather="heart"></i>
                                    <span>Add To Wishlist</span>
                                </a>
                            </div>

                            <div class="payment-option">
                                <div class="product-title">
                                    <h4>Brand:</h4>
                                </div>
                            </div>

                            <div class="mt-2">
                                <a href="{{ route('brand.view', $product->brand->slug) }}" class="d-flex gap-4 align-items-center">
                                    <img src="{{ asset($product->brand->image) }}" class="w-60px">
                                    <h4 class="text-dark fw-bold">{{ $product->brand->name }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab">Description</button>
                                </li>

                                @foreach ($product->specifications as $specification)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="spec{{$specification->id}}-tab" data-bs-toggle="tab"
                                        data-bs-target="#spec{{$specification->id}}" type="button" role="tab">{{
                                        $specification->title }}</button>
                                </li>
                                @endforeach
                            </ul>

                            <div class="tab-content custom-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="product-description">
                                        {!! nl2br($product->description) !!}
                                    </div>
                                </div>

                                @foreach ($product->specifications as $specification)
                                <div class="tab-pane fade" id="spec{{$specification->id}}" role="tabpanel">
                                    {!! $specification->description !!}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block">
                <div class="right-sidebar-box">
                    <!-- Related Product -->
                    <div class="pt-25">
                        <div class="category-menu">
                            <h3>Related Products</h3>

                            <ul class="product-list product-right-sidebar border-0 p-0">
                                @foreach ($relatedProducts as $relatedProduct)
                                <li>
                                    <div class="offer-product">
                                        <a href="{{ route('products.view', $relatedProduct->slug) }}" class="offer-image">
                                            <img src="{{ file_exists(public_path($relatedProduct->thumbnail)) ? asset($relatedProduct->thumbnail) : asset('assets/images/default/product.jpg') }}"
                                                class="img-fluid lazyload" alt="">
                                        </a>

                                        <div class="offer-detail">
                                            <div>
                                                <a href="{{ route('products.view', $relatedProduct->slug) }}">
                                                    <h6 class="name">{{ $relatedProduct->name }}</h6>
                                                </a>
                                                <span>{{ $relatedProduct->unit }}</span>
                                                
                                                <h5 class="sold text-content">
                                                    <span class="theme-color price">₹{{ $relatedProduct->customer_price }}</span>
                                                    @if($relatedProduct->mrp > 0)
                                                        <del class="ms-1">₹{{ $relatedProduct->mrp }}</del>
                                                    @endif
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Banner Section -->
                    {{-- <div class="ratio_156 pt-25">
                        <div class="home-contain">
                            <img src="{{ asset('assets/images/banners/4.jpg') }}" class="bg-img lazyload"
                                alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h6 class="text-yellow home-banner">Dummy banner title</h6>
                                    <h3 class="text-uppercase fw-normal"><span class="theme-color fw-bold">Dummy
                                            text</span> Products</h3>
                                    <h3 class="fw-light">every hour</h3>
                                    <button class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

@if($relatedBrandProducts->count() > 0)
@include('frontend.partials.product.related-brand-products')
@endif

<x-include-plugins :plugins="['slickSlider']"></x-include-plugins>


@push('scripts')
<script>
    $(function(){
        $('.product-main-1').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.bottom-slider-image'
        });

        $('.bottom-slider-image').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.product-main-1',
            dots: false,
            focusOnSelect: true,
            responsive: [{
                breakpoint: 1400,
                settings: {
                    vertical: false,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    vertical: true,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    vertical: false,
                }
            }, {
                breakpoint: 430,
                settings: {
                    slidesToShow: 3,
                    vertical: false,
                }
            },
            ]
        });
    })
</script>
@endpush
@endsection