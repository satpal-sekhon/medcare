<div class="container section-t-space section-b-space">
    <div class="title d-block">
        <h2 class="text-center">Shop By Brands</h2>
    </div>

    <div class="shop-by-brands-slider overflow-hidden">
        <div><img src="assets/images/categories/1.png" alt="Image 1" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/2.png" alt="Image 2" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/3.png" alt="Image 3" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/4.png" alt="Image 4" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/5.png" alt="Image 5" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/6.png" alt="Image 6" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/7.png" alt="Image 7" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/8.png" alt="Image 8" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/9.png" alt="Image 9" class="img-fluid p-2"></div>
        <div><img src="assets/images/categories/10.png" alt="Image 10" class="img-fluid p-2"></div>
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
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
    })
</script>
@endpush