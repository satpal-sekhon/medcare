<template>
    <div class="col-12 px-0">
        <div class="product-box">
            <div class="label-tag" v-if="product.flag && product.flag!=='Casual'" :class="getFlagClass(product.flag)">
                <span>{{ product.flag }}</span>
            </div>

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
                    <Wishlist :productId="product.id"/>
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
                    <h6 class="theme-color"
                        v-if="(product.stock_type === 'With Stock' && product.available_quantity > 0) || product.stock_type === 'Without Stock'">
                        In Stock</h6>
                    <h6 class="text-danger" v-else>Out of Stock</h6>
                </div>
                <QuantityBox :productId="product.id" />
            </div>
        </div>
    </div>
</template>

<script>
import QuantityBox from '../cart/QuantityBox.vue';
import Wishlist from '../Wishlist.vue';

export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    components: {
        QuantityBox,
        Wishlist
    },
    data() {
        return {
            quantity: 0,
        };
    },
    methods: {
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