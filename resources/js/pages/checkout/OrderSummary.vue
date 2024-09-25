<template>
    <div class="right-side-summery-box">
        <div class="summery-box-2">
            <div class="summery-header">
                <h3>Order Summary</h3>
            </div>

            <ul class="summery-contain">
                <li v-for="(item, index) in cartProducts" :key="index">
                    <img :src="`/${item.image}`" class="img-fluid lazyloaded checkout-image" alt="">
                    <h4 class="text-truncate-multiline">{{ item.name }} - {{ item.unit }} <span>X {{ item.quantity
                            }}</span></h4>
                    <h4 class="price">{{ formatPrice(item.price) }}</h4>
                </li>
            </ul>

            <div class="mt-3 coupon-cart">
                <h6 class="text-content mb-2">Coupon Apply</h6>
                <div class="coupon-box input-group">
                    <input type="text" class="form-control" v-model="couponCode"
                        placeholder="Enter Coupon Code Here..." />
                    <button class="btn-apply" :disabled="!couponCode" @click="applyCoupon">Apply</button>
                </div>

                <span class="invalid-feedback d-block" v-if="couponCodeError">{{ couponCodeError }}</span>
                <span class="valid-feedback d-block" v-if="couponCodeSuccessMessage">{{ couponCodeSuccessMessage
                    }}</span>

                <div class="applied-coupon d-flex justify-content-between mt-2" v-if="cart.applied_coupon">
                    <div>Applied Coupon: <span class="text-success">{{ cart.applied_coupon }}</span></div>
                    <a href="javascript:void(0)" class="text-danger" @click="removeAppliedCoupon">Remove</a>
                </div>
            </div>

            <ul class="summery-total">
                <li>
                    <h4>Subtotal</h4>
                    <h4 class="price">{{ formatPrice(cart.sub_total) }}</h4>
                </li>

                <li v-if="cart.applied_coupon">
                    <h4>Discount</h4>
                    <h4 class="price">(-) {{ formatPrice(cart.discount_amount) }}</h4>
                </li>

                <li v-if="cart.cod_charges">
                    <h4>Shipping</h4>
                    <h4 class="price">{{ formatPrice(cart.cod_charges) }}</h4>
                </li>

                <li>
                    <h4>Tax</h4>
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
            cart: [],
            couponCode: '',
            couponDiscount: '0.00',
            checkoutLink: '/checkout',
            couponCodeError: '',
            couponCodeSuccessMessage: ''
        }
    },
    created() {
        on('updated-cart-fetch', this.cartDetails);
    },
    computed: {
        cartProducts() {
            const tempProducts = [];
            for (const productId in this.cart.products) {
                const product = this.cart.products[productId];
                if (product.quantity) {
                    tempProducts.push(product)
                }

                for (const variantId in product.variants) {
                    tempProducts.push(product.variants[variantId]);
                }
            }
            return tempProducts;
        }
    },
    methods: {
        cartDetails(cartData) {
            this.cart = cartData;
        },
        formatPrice(amount) {
            if (amount == null || isNaN(amount)) { return `-` }
            return `₹${parseFloat(amount).toFixed(2)}`;
        },
        async applyCoupon() {
            const response = await fetch('/apply-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
                body: JSON.stringify({ code: this.couponCode })
            });

            const data = await response.json();
            if(!data.success){
                this.couponCodeError = data.message;
            } else {
                this.couponCodeError = '';
                this.couponCodeSuccessMessage = data.message;
                this.cart = data.cart;
            }
        },
        async removeAppliedCoupon(){
            const response = await fetch('/remove-applied-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
            });

            const data = await response.json();
            this.cart = data.cart;
        },
        getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
    }
}
</script>

<style scoped></style>