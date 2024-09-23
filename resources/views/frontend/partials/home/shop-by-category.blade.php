<div class="container section-t-space section-b-space">
    <div class="title d-block">
        <h2 class="text-center">Shop By Categories</h2>
    </div>

    <div class="shop-by-categories-slider overflow-hidden">
        @foreach ($categories as $category)
            <div>
                <a href="{{ route('category.view', $category->slug) }}">
                    <img src="{{ asset($category->image ?? 'assets/images/default/category.jpg') }}" alt="{{ $category->name }}" class="img-fluid p-2">
                </a>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    $(function(){
        $('.shop-by-categories-slider').slick({
            infinite: true,
            arrows: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            pauseOnHover: true,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: true,      // Show next/prev arrows
            responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
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