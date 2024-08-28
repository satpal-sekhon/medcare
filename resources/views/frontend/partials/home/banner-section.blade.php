<section class="banner-section ratio_60 wow fadeInUp">
    <div class="container-fluid-lg">
        <div class="banner-slider">
            <div> 
                <div class="banner-contain hover-effect">
                    <img src="/assets/images/banners/2.png" class="bg-img blur-up lazyload" alt="">
                    <div class="banner-details">
                        <div class="banner-box">
                            <h6 class="text-danger">5% OFF</h6>
                            <h5>Hot Deals on New Items</h5>
                            <h6 class="text-content">Daily Essentials Eggs & Dairy</h6>
                        </div>
                        <a href="#" class="banner-button text-white">Shop Now <i
                                class="fa-solid fa-right-long ms-2"></i></a>
                    </div>
                </div>
            </div>

            <div>
                <div class="banner-contain hover-effect">
                    <img src="/assets/images/banners/3.png" class="bg-img blur-up lazyload" alt="">
                    <div class="banner-details">
                        <div class="banner-box">
                            <h6 class="text-danger">5% OFF</h6>
                            <h5>Buy More & Save More</h5>
                            <h6 class="text-content">Fresh Vegetables</h6>
                        </div>
                        <a href="#" class="banner-button text-white">Shop Now <i
                                class="fa-solid fa-right-long ms-2"></i></a>
                    </div>
                </div>
            </div>

            <div>
                <div class="banner-contain hover-effect">
                    <img src="/assets/images/banners/4.png" class="bg-img blur-up lazyload" alt="">
                    <div class="banner-details">
                        <div class="banner-box">
                            <h6 class="text-danger">5% OFF</h6>
                            <h5>Organic Meat Prepared</h5>
                            <h6 class="text-content">Delivered to Your Home</h6>
                        </div>
                        <a href="#" class="banner-button text-white">Shop Now <i
                                class="fa-solid fa-right-long ms-2"></i></a>
                    </div>
                </div>
            </div>

            <div>
                <div class="banner-contain hover-effect">
                    <img src="/assets/images/banners/5.png" class="bg-img blur-up lazyload" alt="">
                    <div class="banner-details">
                        <div class="banner-box">
                            <h6 class="text-danger">5% OFF</h6>
                            <h5>Buy More & Save More</h5>
                            <h6 class="text-content">Nuts & Snacks</h6>
                        </div>
                        <a href="#" class="banner-button text-white">Shop Now <i
                                class="fa-solid fa-right-long ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(function(){
        $('.banner-slider').slick({
            arrows: false,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2500,
            dots: false,
            responsive: [{
                breakpoint: 1387,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 966,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 34,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    fade: true,
                }
            },
            ]
        });


    })
</script>
@endpush