<div class="container section-t-space section-b-space">
    <div class="title d-block">
        <h2 class="text-center">Shop By Brands</h2>
    </div>

    <div class="shop-by-brands-slider overflow-hidden">
        @foreach ($brands as $brand)
            <div>
                <img src="{{ asset($brand->image ?? 'assets/images/default/brand.png') }}" alt="{{ $brand->name }}" class="img-fluid p-2">
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    $(function(){
        $('.shop-by-brands-slider').slick({
            infinite: true,
            arrows: true,
            slidesToShow: 7,
            slidesToScroll: 1,
            pauseOnHover: true,
            autoplay: true,
            autoplaySpeed: 1500,
            dots: true,      // Show next/prev arrows
            responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 8,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }]
        });
    })
</script>
@endpush