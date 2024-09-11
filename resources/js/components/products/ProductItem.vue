<template>
    <div class="col-12 px-0">
        <div class="product-box">
            <div class="product-image">
                <a :href="product.link">
                    <img :src="product.image" class="img-fluid lazyload" alt="" />
                </a>
                <ul class="product-option">
                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                        <a :href="product.link">
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
                    <del>₹{{ product.originalPrice }}</del>
                </h5>
                <div class="product-rating mt-sm-2 mt-1">
                    <!-- <ul class="rating">
                        <li v-for="star in product.rating" :key="star">
                            <i data-feather="star" :class="{ 'fill': star <= product.ratingValue }"></i>
                        </li>
                    </ul> -->
                    <h6 class="theme-color" v-if="(product.stock_type==='With Stock' && product.available_quantity > 0) || product.stock_type==='Without Stock'">In Stock</h6>
                    <h6 class="text-danger" v-else>Out of Stock</h6>
                </div>
                <div class="add-to-cart-box">
                    <button class="btn btn-add-cart addcart-button" :disabled="isAddToCartDisabled" @click="changeQuantity(1)">
                        Add
                        <span class="add-icon">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </button>
                    <div :class="['cart_qty qty-box mw-100', { 'open': quantity > 0 }]">
                        <div class="input-group">
                            <button type="button" class="qty-left-minus" data-type="minus" data-field="" @click="changeQuantity(-1)">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input class="form-control input-number qty-input" type="text" name="quantity" :value="quantity" />
                            <button type="button" class="qty-right-plus" data-type="plus" data-field="" @click="changeQuantity(1)">
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
    data() {
        return {
            quantity: 0,
        };
    },
    methods: {
        changeQuantity(amount) {
            const newQuantity = this.quantity + amount;
            if (newQuantity >= 0) {
                this.quantity = newQuantity;
            }
        }
    },
    mounted() {
        feather.replace();
    },
    computed: {
        isAddToCartDisabled() {
            return !(this.product.stock_type === 'With Stock' && this.product.available_quantity > 0) &&
                this.product.stock_type !== 'Without Stock';
        }
    }

};
</script>