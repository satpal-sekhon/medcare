<template>
    <div>
        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.05s">
            <div class="product-header">
                <div class="product-image">
                    <a href="#">
                        <img src="../assets/images/cake/product/3.png" class="img-fluid blur-up lazyload" alt="">
                    </a>

                    <ul class="product-option">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                <i data-feather="eye"></i>
                            </a>
                        </li>

                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                            <a href="#" class="notifi-wishlist">
                                <i data-feather="heart"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="product-footer">
                <div class="product-detail">
                    <a href="#">
                        <h5 class="name">{{ product.name }}</h5>
                    </a>
                    <p class="text-content mt-1 mb-2 product-content">Feta taleggio croque monsieur
                        swiss manchego cheesecake dolcelatte jarlsberg. Hard cheese danish fontina
                        boursin melted cheese fondue.</p>
                    <div class="product-rating mt-2">
                        <ul class="rating">
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <span>({{ product.rating }})</span>
                    </div>
                    <h6 class="unit">{{ product.unit }}</h6>
                    <h5 class="price">
                        <span class="theme-color">{{ formattedPrice(product.price) }}</span>
                        <del>{{ formattedPrice(product.originalPrice) }}</del>
                    </h5>
                    <div class="add-to-cart-box bg-white">
                        <button class="btn btn-add-cart addcart-button">Add
                            <span class="add-icon bg-light-gray">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </button>
                        <div class="cart_qty qty-box">
                            <div class="input-group bg-white">
                                <button type="button" class="qty-left-minus bg-gray" data-type="minus" data-field="">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input class="form-control input-number qty-input" type="text" name="quantity"
                                    value="0">
                                <button type="button" class="qty-right-plus bg-gray" data-type="plus" data-field="">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductCard',
    props: {
        product: {
            type: Object,
            required: true
        }
    },
    mounted() {
        feather.replace();
    },
    methods: {
        formattedPrice(price) {
            return `₹${price.toFixed(2)}`;
        },
        addToCart() {
            // Logic for adding product to cart
        },
    },
};
</script>