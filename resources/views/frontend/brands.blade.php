@extends('layouts.frontend-layout')
@section('title', 'Brands')

@section('content')
@push('meta')
<meta name="title" content="{{ $metaTags->meta_name }}">
<meta name="keywords" content="{{ $metaTags->meta_keywords }}">
<meta name="description" content="{{ $metaTags->meta_description }}">
@endpush

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                @if($brands->count() > 0)
                <div
                    class="row g-sm-4 g-3 row-cols-xxl-6 row-cols-xl-4 row-cols-lg-3 row-cols-md-4 row-cols-3 product-list-section">
                    @foreach ($brands as $brand)
                    <div>
                        <div class="product-box-3 h-100">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="{{ route('brand.view', $brand->slug) }}">
                                        <img src="{{ asset($brand->image ?? 'assets/images/default/brand.png') }}"
                                            class="img-fluid lazyload" alt="{{ $brand->name }}">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="{{ route('brand.view', $brand->slug) }}">
                                        <h4 class="text-center">{{ $brand->name }}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>                
                @else
                    <x-warning-message message="We will launch brands soon!"></x-warning-message>
                @endif

                {{ $brands->links() }}
            </div>
        </div>
    </div>
</section>
@endsection