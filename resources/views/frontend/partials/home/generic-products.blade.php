<div class="section-b-space">
    <div class="product-border border-row overflow-hidden">
        <div class="product-box-2-slider no-arrow">
            <div>
                <div class="row m-0">
                    @foreach ($genericProducts->take(2) as $product)
                    <div class="col-12 px-0">
                        <product-item :product='{{ json_encode([
                        "id" => $product->id,
                        "name" => $product->name,
                        "flag" => $product->flag,
                        "image" => file_exists(public_path($product->thumbnail)) ? asset($product->thumbnail) : asset('
                            assets/images/default/product.jpg'), 
                        "price"=> $product->$priceParam,
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

            <div>
                <div class="row m-0">
                    @foreach ($genericProducts->skip(2)->take(2) as $product)
                    <div class="col-12 px-0">
                        <product-item :product='{{ json_encode([
                        "id" => $product->id,
                        "name" => $product->name,
                        "flag" => $product->flag,
                        "image" => file_exists(public_path($product->thumbnail)) ? asset($product->thumbnail) : asset('assets/images/default/product.jpg'), 
                        "price"=> $product->$priceParam,
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

            <div>
                <div class="row m-0">
                    @foreach ($genericProducts->skip(4)->take(2) as $product)
                    <div class="col-12 px-0">
                        <product-item :product='{{ json_encode([
                        "id" => $product->id,
                        "name" => $product->name,
                        "flag" => $product->flag,
                        "image" => file_exists(public_path($product->thumbnail)) ? asset($product->thumbnail) : asset('
                            assets/images/default/product.jpg'), 
                        "price"=> $product->$priceParam,
                        "originalPrice" => $product->mrp,
                        "link" => route('products.view', $product->slug),
                        "stock_type" => $product->stock_type,
                        "quantity" => $product->stock_quantity_for_customer,
                        /* "rating" => [1, 1, 1, 1, 0],
                        "ratingValue" => 4, */
                        ]) }}'></product-item>
                    </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="row m-0">
                    @foreach ($genericProducts->skip(6)->take(2) as $product)
                    <div class="col-12 px-0">
                        <product-item :product='{{ json_encode([
                        "id" => $product->id,
                        "name" => $product->name,
                        "flag" => $product->flag,
                        "image" => file_exists(public_path($product->thumbnail)) ? asset($product->thumbnail) : asset('
                            assets/images/default/product.jpg'), 
                        "price"=> $product->$priceParam,
                        "originalPrice" => $product->mrp,
                        "link" => route('products.view', $product->slug),
                        "stock_type" => $product->stock_type,
                        "quantity" => $product->stock_quantity_for_customer,
                        /* "rating" => [1, 1, 1, 1, 0],
                        "ratingValue" => 4, */
                        ]) }}'></product-item>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(function(){
        $('.product-box-2-slider').slick({
            infinite: true,
            arrows: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            pauseOnHover: true,
            responsive: [{
                breakpoint: 1680,
                    settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 660,
                settings: {
                    slidesToShow: 2,
                }
            },
            ]
        });
    })
</script>
@endpush