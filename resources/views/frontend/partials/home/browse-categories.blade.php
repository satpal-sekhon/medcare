<div class="title">
    <h2>Bowse by Categories</h2>
    <span class="title-leaf">
        <svg class="icon-width">
            <use xlink:href="/assets/svg/leaf.svg#leaf"></use>
        </svg>
    </span>
    <p>Top Categories Of The Week</p>
</div>

<div class="category-slider product-wrapper no-arrow">
    <div>
        <a href="#" class="category-box category-dark">
            <div>
                <img src="/assets/svg/1/vegetable.svg" class="blur-up lazyload" alt="">
                <h5>Vegetables & Fruit</h5>
            </div>
        </a>
    </div>

    <div>
        <a href="#" class="category-box category-dark">
            <div>
                <img src="/assets/svg/1/cup.svg" class="blur-up lazyload" alt="">
                <h5>Beverages</h5>
            </div>
        </a>
    </div>

    <div>
        <a href="#" class="category-box category-dark">
            <div>
                <img src="/assets/svg/1/meats.svg" class="blur-up lazyload" alt="">
                <h5>Meats & Seafood</h5>
            </div>
        </a>
    </div>

    <div>
        <a href="#" class="category-box category-dark">
            <div>
                <img src="/assets/svg/1/breakfast.svg" class="blur-up lazyload" alt="">
                <h5>Breakfast</h5>
            </div>
        </a>
    </div>

    <div>
        <a href="#" class="category-box category-dark">
            <div>
                <img src="/assets/svg/1/frozen.svg" class="blur-up lazyload" alt="">
                <h5>Frozen Foods</h5>
            </div>
        </a>
    </div>

    <div>
        <a href="#" class="category-box category-dark">
            <div>
                <img src="/assets/svg/1/milk.svg" class="blur-up lazyload" alt="">
                <h5>Milk & Dairies</h5>
            </div>
        </a>
    </div>

    <div>
        <a href="#" class="category-box category-dark">
            <div>
                <img src="/assets/svg/1/pet.svg" class="blur-up lazyload" alt="">
                <h5>Pet Food</h5>
            </div>
        </a>
    </div>
</div>

@push('scripts')
<script>
    $(function(){
        $('.category-slider').slick({
            arrows: true,
            infinite: true,
            slidesToShow: 7,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1745,
                settings: {
                    slidesToShow: 6,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 2500,
                }
            },
            {
                breakpoint: 1540,
                settings: {
                    slidesToShow: 5,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 2500,
                }
            },
            {
                breakpoint: 910,
                settings: {
                    slidesToShow: 4,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 2500,
                }
            },
            {
                breakpoint: 730,
                settings: {
                    slidesToShow: 3,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 2500,
                }
            },
            {
                breakpoint: 410,
                settings: {
                    slidesToShow: 2,
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