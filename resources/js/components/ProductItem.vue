<template>
    <div class="col-12 px-0">
        <div class="product-box">
            <div class="product-image">
                <a :href="product.link">
                    <img :src="product.image" class="img-fluid blur-up lazyload" alt="" />
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
            <div class="product-detail">
                <a :href="product.link">
                    <h6 class="name">{{ product.name }}</h6>
                </a>
                <h5 class="sold text-content">
                    <span class="theme-color price">₹{{ product.price }}</span>
                    <del>{{ product.originalPrice }}</del>
                </h5>
                <div class="product-rating mt-sm-2 mt-1">
                    <ul class="rating">
                        <li v-for="star in product.rating" :key="star">
                            <i data-feather="star" :class="{ 'fill': star <= product.ratingValue }"></i>
                        </li>
                    </ul>
                    <h6 class="theme-color">In Stock</h6>
                </div>
                <div class="add-to-cart-box">
                    <button class="btn btn-add-cart addcart-button">
                        Add
                        <span class="add-icon">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </button>
                    <div class="cart_qty qty-box">
                        <div class="input-group">
                            <button type="button" class="qty-left-minus" data-type="minus" data-field="">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input class="form-control input-number qty-input" type="text" name="quantity" value="0" />
                            <button type="button" class="qty-right-plus" data-type="plus" data-field="">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        feather.replace();
    },
};
</script>