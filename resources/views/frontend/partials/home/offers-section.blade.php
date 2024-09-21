<section class="banner-section ratio_60">
    <div class="container-fluid-lg">
        <div class="banner-slider">
            <div> 
                <div class="banner-contain hover-effect">
                    @if ($homePage->home_offer_image_1_link)
                        <a href="{{ $homePage->home_offer_image_1_link }}">
                    @endif
                        <img src="{{ asset($homePage->home_offer_image_1) }}" class="bg-img lazyload" alt="">
                    @if ($homePage->home_offer_image_1_link)
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <div class="banner-contain hover-effect">
                    @if ($homePage->home_offer_image_2_link)
                        <a href="{{ $homePage->home_offer_image_2_link }}">
                    @endif
                        <img src="{{ asset($homePage->home_offer_image_2) }}" class="bg-img lazyload" alt="">
                    @if ($homePage->home_offer_image_2_link)
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <div class="banner-contain hover-effect">
                    @if ($homePage->home_offer_image_3_link)
                        <a href="{{ $homePage->home_offer_image_3_link }}">
                    @endif
                        <img src="{{ asset($homePage->home_offer_image_3) }}" class="bg-img lazyload" alt="">
                    @if ($homePage->home_offer_image_3_link)
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <div class="banner-contain hover-effect">
                    @if ($homePage->home_offer_image_4_link)
                        <a href="{{ $homePage->home_offer_image_4_link }}">
                    @endif
                        <img src="{{ asset($homePage->home_offer_image_4) }}" class="bg-img lazyload" alt="">
                    @if ($homePage->home_offer_image_4_link)
                        </a>
                    @endif
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