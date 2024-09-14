<template>
    <div class="product-box-3 h-100">
        <div class="product-header">
            <div class="d-inline px-3 py-1 text-white" v-if="product.flag && product.flag!=='Casual'" :class="getFlagClass(product.flag)">
                <span>{{ product.flag }}</span>
            </div>

            <div class="product-image">
                <a :href="product.link">
                    <img :src="product.thumbnail" class="img-fluid lazyload" :alt="product.name">
                </a>
                <ul class="product-option">
                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                        <a :href="`/product/${product.slug}`">
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
                <span class="span-name">{{ product.category.name }}</span>
                <a :href="product.link">
                    <h5 class="name">{{ product.name }}</h5>
                </a>
                <h6 class="unit">{{ product.unit }}</h6>
                <h5 class="price">
                    <span class="theme-color">₹{{ product.customer_price }}</span>
                    <del>₹{{ product.mrp }}</del>
                </h5>
                <div class="add-to-cart-box bg-white">
                    <button class="btn btn-add-cart addcart-button" :disabled="isAddToCartDisabled" @click="addToCart">
                        Add
                        <span class="add-icon bg-light-gray">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </button>
                    <div :class="['cart_qty qty-box mw-100', { 'open': quantity > 0 }]">
                        <div class="input-group bg-white">
                            <button type="button" class="qty-left-minus bg-gray" @click="changeQuantity(-1)">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input class="form-control input-number qty-input" type="text" :value="quantity" readonly>
                            <button type="button" class="qty-right-plus bg-gray" @click="changeQuantity(1)">
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
    name: 'ProductCard',
    props: {
        product: {
            type: Object,
            required: true
        },
        quantity: {
            type: Number,
            default: 0
        },
        isAddToCartDisabled: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        addToCart() {
            if (!this.isAddToCartDisabled) {
                this.$emit('change-quantity', 1);
            }
        },
        changeQuantity(amount) {
            this.$emit('change-quantity', amount);
        },
        getFlagClass(flag) {
            switch(flag) {
                case 'On Sale':
                return 'bg-danger';
                case 'Trending':
                return 'bg-success';
                default:
                return '';
            }
        }
    },
    mounted() {
        feather.replace();
    }
};
</script>