<section class="home-section pt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="slick-slider d-none d-md-block">
                    <div>
                        @if ($homePage->home_main_banner_image_1_link)
                            <a href="{{$homePage->home_main_banner_image_1_link}}">
                        @endif
                        <img src="{{ asset($homePage->home_main_banner_image_1) }}" class="img-fluid" alt="">
                        @if ($homePage->home_main_banner_image_1_link)
                            </a>
                        @endif
                    </div>
                    <div>
                        @if ($homePage->home_main_banner_image_2_link)
                            <a href="{{$homePage->home_main_banner_image_2_link}}">
                        @endif
                        <img src="{{ asset($homePage->home_main_banner_image_2) }}" class="img-fluid" alt="">
                        @if ($homePage->home_main_banner_image_2_link)
                            </a>
                        @endif
                    </div>
                </div>
                <div class="d-block d-md-none">
                    <div>
                        @if ($homePage->home_main_banner_image_3_link)
                            <a href="{{$homePage->home_main_banner_image_3_link}}">
                        @endif
                        <img src="{{ asset($homePage->home_main_banner_image_3) }}" class="img-fluid w-100" alt="">
                        @if ($homePage->home_main_banner_image_3_link)
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(function(){
        $('.home-section .slick-slider').slick({
            arrows: false,
            infinite: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 2500
        });
    });
</script>
@endpush
