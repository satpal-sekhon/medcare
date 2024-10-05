<template>
    <div class="product-box-3 h-100">
        <div class="product-header">
            <div class="d-inline px-3 py-1 text-white" v-if="product.flag && product.flag !== 'Casual'"
                :class="getFlagClass(product.flag)">
                <span>{{ product.flag }}</span>
            </div>

            <div class="product-image">
                <a :href="`/product/${product.slug}`">
                    <img :src="`/${product.thumbnail}`" class="img-fluid lazyload" :alt="product.name">
                    <ul class="product-option">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                            <a :href="`/product/${product.slug}`">
                                <i data-feather="eye"></i>
                            </a>
                        </li>
                        <Wishlist :productId="product.id" />
                    </ul>
                </a>
            </div>
        </div>
        <div class="product-footer">
            <div class="product-detail">
                <span class="span-name">{{ product.category.name }}</span>
                <a :href="`/product/${product.slug}`">
                    <h5 class="name">{{ product.name }}</h5>
                </a>
                <h6 class="unit">{{ product.unit }}</h6>
                <h5 class="price">
                    <span class="theme-color" v-if="isVendor">₹{{ product.vendor_price }}</span>
                    <span class="theme-color" v-else>₹{{ product.customer_price }}</span>
                    <del>₹{{ product.mrp }}</del>
                </h5>
                <QuantityBox :productId="product.id" />
            </div>
        </div>
    </div>
</template>

<script>
import QuantityBox from '../../components/cart/QuantityBox.vue';
import Wishlist from '../../components/Wishlist.vue';

export default {
    name: 'ProductCard',
    props: {
        product: {
            type: Object,
            required: true
        }
    },
    components: {
        QuantityBox,
        Wishlist
    },
    methods: {
        getFlagClass(flag) {
            switch (flag) {
                case 'On Sale':
                    return 'bg-danger';
                case 'Trending':
                    return 'bg-success';
                default:
                    return '';
            }
        }
    },
    computed: {
        isVendor() {
            return window.isVendor || false;
        }
    },
    mounted() {
        feather.replace();
    }
};
</script>