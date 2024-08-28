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

<div class="best-selling-slider product-wrapper wow fadeInUp">
    <div>
        <ul class="product-list">
            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/1.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>500 G</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/5.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>500 G</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/7.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>150 G</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div>
        <ul class="product-list">
            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/8.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>500 G</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/1.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>1 KG</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/2.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>150 G</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div>
        <ul class="product-list">
            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/6.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>1 L</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/3.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>1 KG</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="offer-product">
                    <a href="#" class="offer-image">
                        <img src="/assets/images/product/2.png" class="blur-up lazyload" alt="">
                    </a>

                    <div class="offer-detail">
                        <div>
                            <a href="#" class="text-title">
                                <h6 class="name">Medical Syrup</h6>
                            </a>
                            <span>160 ML</span>
                            <h6 class="price theme-color">$ 10.00</h6>
                        </div>
                    </div>
                </div>
            </li>
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