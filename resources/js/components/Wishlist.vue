<template>
    <li>
        <a href="javascript:void(0)" class="notifi-wishlist" :class="{ added: isAddedToWishlist }" @click="addToWishlist">
            <i data-feather="heart"></i>
            <span v-if="!isAddedToWishlist">{{withLabel}}</span>
            <span v-else>{{withSavedLabel}}</span>
        </a>
    </li>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Wishlist',
    data() {
        return {
            isAddedToWishlist: false
        };
    },
    props: {
        productId: {
            type: Number,
            required: true
        },
        withLabel: {
            type: String,
            default: ""
        },
        withSavedLabel: {
            type: String,
            default: ""
        }
    },
    methods: {
        async addToWishlist() {
            try {
                const response = await axios.post('/wishlist', { productId: this.productId });
                window.wishlistItems = response.data.data;
                $('.wishlist-count').html(window.wishlistItems.length);

                if(window.wishlistItems.length > 0){
                    $('.wishlist-count').removeClass('d-none')
                } else {
                    $('.wishlist-count').addClass('d-none')
                }
                this.updateWishlistProduct();
            } catch (error) {
                console.error('Error adding to wishlist:', error);
            }
        },
        updateWishlistProduct(){
            let wishlistItems = window.wishlistItems;
            this.isAddedToWishlist = wishlistItems.includes(this.productId);
        }
    },
    created(){
        this.updateWishlistProduct();
    }
};
</script>

<style scoped>
.notifi-wishlist.added svg{
    fill: #f14242;
    color: #f14242!important;
}
</style>
