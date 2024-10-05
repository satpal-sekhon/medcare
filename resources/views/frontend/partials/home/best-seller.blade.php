<div class="title d-block">
    <div>
        <h2>Our best Seller</h2>
        <span class="title-leaf">
            <svg class="icon-width">
                <use xlink:href="/assets/svg/leaf.svg#leaf"></use>
            </svg>
        </span>
    </div>
</div>

<div class="best-selling-slider product-wrapper">
    <div>
        <ul class="product-list">
            @foreach ($saleProducts->take(3) as $product)
            <li>
                <div class="offer-product">
                    <a href="{{ route('products.view', $product->slug) }}" class="offer-image">
                        <img src="{{ asset($product->thumbnail) }}" class="lazyload" onerror="this.onerror=null; this.src='{{ asset('assets/images/default/product.jpg') }}';" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="{{ route('products.view', $product->slug) }}" class="text-title">
                                <h6 class="name">{{ $product->name }}</h6>
                            </a>
                            <span>{{ $product->unit }}</span>
                            <h5 class="sold text-content">
                                <span class="theme-color price">₹{{ $product->$priceParam }}</span>
                                @if($product->mrp > 0)
                                    <del class="ms-1">₹{{ $product->mrp }}</del>
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    <div>
        <ul class="product-list">
            @foreach ($saleProducts->skip(3)->take(3) as $product)
            <li>
                <div class="offer-product">
                    <a href="{{ route('products.view', $product->slug) }}" class="offer-image">
                        <img src="{{ asset($product->thumbnail) }}" class="lazyload" onerror="this.onerror=null; this.src='{{ asset('assets/images/default/product.jpg') }}';" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="{{ route('products.view', $product->slug) }}" class="text-title">
                                <h6 class="name">{{ $product->name }}</h6>
                            </a>
                            <span>{{ $product->unit }}</span>
                            <h5 class="sold text-content">
                                <span class="theme-color price">₹{{ $product->$priceParam }}</span>
                                @if($product->mrp > 0)
                                    <del class="ms-1">₹{{ $product->mrp }}</del>
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    <div>
        <ul class="product-list">
            @foreach ($saleProducts->skip(6)->take(3) as $product)
            <li>
                <div class="offer-product">
                    <a href="{{ route('products.view', $product->slug) }}" class="offer-image">
                        <img src="{{ asset($product->thumbnail) }}" class="lazyload" onerror="this.onerror=null; this.src='{{ asset('assets/images/default/product.jpg') }}';" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="{{ route('products.view', $product->slug) }}" class="text-title">
                                <h6 class="name">{{ $product->name }}</h6>
                            </a>
                            <span>{{ $product->unit }}</span>
                            <h5 class="sold text-content">
                                <span class="theme-color price">₹{{ $product->$priceParam }}</span>
                                @if($product->mrp > 0)
                                    <del class="ms-1">₹{{ $product->mrp }}</del>
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


@push('scripts')
<script>
    $(function(){
        $('.best-selling-slider').slick({
            arrows: false,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1495,
                settings: {
                    slidesToShow: 2,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 2500,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 666,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 2500,
                }
            },
            ]
        });

    })
</script>
@endpush