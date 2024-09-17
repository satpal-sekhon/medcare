<template>
    <div class="right-side-summery-box">
        <div class="summery-box-2">
            <div class="summery-header">
                <h3>Order Summary</h3>
            </div>

            <ul class="summery-contain">
                <li v-for="(item, index) in cart.products" :key="index">
                    <img :src="`/${item.image}`" class="img-fluid lazyloaded checkout-image"
                        alt="">
                    <h4 class="text-truncate-multiline">{{ item.name }} <span>X {{ item.quantity }}</span></h4>
                    <h4 class="price">{{ formatPrice(item.price) }}</h4>
                </li>
            </ul>

            <ul class="summery-total">
                <li>
                    <h4>Subtotal</h4>
                    <h4 class="price">{{ formatPrice(cart.sub_total) }}</h4>
                </li>

                <li v-if="cart.applied_coupon">
                    <h4>Applied Coupon</h4>
                    <h4 class="price">(-) {{ formatPrice(cart.discount_amount) }}</h4>
                </li>

                <li>
                    <h4>Shipping</h4>
                    <h4 class="price">-</h4>
                </li>

                <li>
                    <h4>Tax</h4>
                    <h4 class="price">-</h4>
                </li>

                <li class="d-none">
                    <h4>Coupon/Code</h4>
                    <h4 class="price">-</h4>
                </li>

                <li class="list-total">
                    <h4>Total (INR)</h4>
                    <h4 class="price">{{ formatPrice(cart.total) }}</h4>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { on } from '../../eventBus';

export default {
    name: 'OrderSummary',
    data() {
        return {
            cart: []
        }
    },
    created() {
        on('updated-cart-fetch', this.cartDetails);
    },
    methods: {
        cartDetails(cartData) {
            this.cart = cartData;
        },
        formatPrice(amount) {
            if (amount == null || isNaN(amount)) { return `-` }
            return `₹${parseFloat(amount).toFixed(2)}`;
        },
    }
}
</script>

<style scoped></style>