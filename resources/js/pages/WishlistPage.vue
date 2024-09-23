<template>
    <div class="row">
        <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain" v-for="product in localProducts">
            <div class="product-box-3 h-100">
                <div class="product-header">
                    <div class="d-inline px-3 py-1 text-white" v-if="product.flag && product.flag !== 'Casual'"
                        :class="getFlagClass(product.flag)">
                        <span>{{ product.flag }}</span>
                    </div>
                    
                    <div class="product-image">
                        <a :href="`/product/${product.slug}`">
                            <img :src="`/${product.thumbnail}`" class="img-fluid lazyload" alt="">
                        </a>

                        <div class="product-header-top">
                            <button class="btn wishlist-button close_button" @click="removeProductFromWishlist(product.id)">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-footer">
                    <div class="product-detail">
                        <span class="span-name">Hygiene</span>
                        <a :href="`/product/${product.slug}`">
                            <h5 class="name">{{product.name}}</h5>
                        </a>
                        <h6 class="unit mt-1">{{product.unit}}</h6>
                        <h5 class="price">
                            <span class="theme-color">₹{{product.customer_price}}</span>
                            <del>₹{{product.mrp}}</del>
                        </h5>

                        <QuantityBox :productId="product.id" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="localProducts.length === 0">
        <WarningMessage message="Your wishlist is empty!"></WarningMessage>
    </div>
</template>

<script>
import axios from 'axios';
import QuantityBox from '../components/cart/QuantityBox.vue';
import WarningMessage from '../components/WarningMessage.vue';

export default {
    name: 'WishlistPage',
    props:{
        products: {
            type: Array,
            required: true
        }
    },
    components: {
        QuantityBox,
        WarningMessage
    },
    data() {
        return {
            localProducts: [...this.products]
        };
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
        },
        async removeProductFromWishlist(productId) {
            try {
                const response = await axios.post('/wishlist', { productId: productId });
                window.wishlistItems = response.data.data;
                $('.wishlist-count').html(window.wishlistItems.length);

                if(window.wishlistItems.length > 0){
                    $('.wishlist-count').removeClass('d-none')
                } else {
                    $('.wishlist-count').addClass('d-none')
                }

                this.removeProductById(productId);
            } catch (error) {
                console.error('Error adding to wishlist:', error);
            }
        },
        removeProductById(productId) {
            this.localProducts = this.localProducts.filter(product => product.id !== productId);
        }
    },
    mounted() {
        feather.replace();
    }
};
</script>