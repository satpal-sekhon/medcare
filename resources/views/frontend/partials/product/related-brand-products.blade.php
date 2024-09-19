<section class="product-list-section section-b-space">
    <div class="container-fluid-lg">
        <div class="title text-center w-100">
            <h2>Related Brand Products</h2>
            <span class="title-leaf">
                <svg class="icon-width">
                    <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                </svg>
            </span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-6_1 product-wrapper">
                    @foreach ($relatedBrandProducts as $product)
                    <div>
                        <product-item :product='{{ json_encode([
                            "id" => $product->id,
                            "name" => $product->name,
                            "flag" => $product->flag,
                            "image" => file_exists(public_path($product->thumbnail)) ? asset($product->thumbnail) : asset('
                            assets/images/default/product.jpg'), "price"=> $product->customer_price,
                            "originalPrice" => $product->mrp,
                            "link" => route('products.view', $product->slug),
                            "stock_type" => $product->stock_type,
                            "available_quantity" => $product->stock_quantity_for_customer,
                            /* "rating" => [1, 1, 1, 1, 0],
                            "ratingValue" => 4, */
                            ]) }}'></product-item>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
<script>
    $(function(){
        $('.slider-6_1').slick({
            arrows: false,
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            dots: true,
            responsive: [{
                breakpoint: 1430,
                settings: {
                    slidesToShow: 5,
                    autoplay: true,
                    autoplaySpeed: 3500,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                }
            },
            ]
        });
    })
</script>
@endpush