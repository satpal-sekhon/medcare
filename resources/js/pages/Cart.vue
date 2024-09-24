<template>
    <div class="row g-sm-5 g-3" v-if="cart.total">
        <div class="col-xxl-9">
            <div class="cart-table">
                <div class="table-responsive-xl">
                    <table class="table">
                        <tbody>
                            <tr class="product-box-contain" v-for="(item, index) in cart.products" :key="index">
                                <td class="product-detail">
                                    <div class="product border-0">
                                        <a :href="item.link" class="product-image">
                                            <img :src="item.image" class="img-fluid lazyload" alt="">
                                        </a>
                                        <div class="product-detail">
                                            <ul>
                                                <li class="name text-truncate-multiline">
                                                    <a :href="item.link">{{ item.name }}</a>
                                                </li>
                                                <li class="text-content"><span class="text-title">Category:</span> {{
                                                    item.category }}</li>
                                                <li class="text-content"><span class="text-title">Quantity</span> - {{
                                                    item.quantity }}</li>
                                                <li>
                                                    <h5 class="text-content d-inline-block">Price :</h5>
                                                    <span>{{ item.price }}</span>
                                                    <span class="text-content">{{ item.mrp }}</span>
                                                </li>
                                                <li>
                                                    <h5 class="saving theme-color">Saving : {{ item.price }}</h5>
                                                </li>
                                                <li class="quantity-price-box">
                                                    <div class="cart_qty">
                                                        <div class="input-group">
                                                            <button type="button" class="btn qty-left-minus"
                                                                @click="updateCart(item.product_id, item.quantity - 1)">
                                                                <i class="fa fa-minus ms-0"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" v-model.number="item.quantity" />
                                                            <button type="button" class="btn qty-right-plus"
                                                                @click="updateCart(item.product_id, item.quantity + 1)">
                                                                <i class="fa fa-plus ms-0"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h5>Total: {{ formatPrice(cart.total) }}</h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>

                                <td class="price">
                                    <h4 class="table-title text-content">Price</h4>
                                    <h5>
                                        {{ formatPrice(item.price) }}
                                        <del class="text-content">{{ formatPrice(item.mrp) }}</del>
                                    </h5>
                                    <h6 class="theme-color">You Save : {{ formatPrice(item.mrp - item.price) }}</h6>
                                </td>

                                <td class="quantity">
                                    <h4 class="table-title text-content">Qty</h4>
                                    <div class="quantity-price">
                                        <div class="cart_qty">
                                            <div class="input-group">
                                                <button type="button" class="btn qty-left-minus"
                                                    @click="updateCart(item.product_id, item.quantity - 1)">
                                                    <i class="fa fa-minus ms-0"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text"
                                                    v-model.number="item.quantity" />
                                                <button type="button" class="btn qty-right-plus"
                                                    @click="updateCart(item.product_id, item.quantity + 1)">
                                                    <i class="fa fa-plus ms-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="subtotal">
                                    <h4 class="table-title text-content">Total</h4>
                                    <h5>{{ formatPrice(item.quantity * item.price) }}</h5>
                                </td>

                                <td class="save-remove">
                                    <h4 class="table-title text-content">Action</h4>
                                    <a class="save notifi-wishlist" href="javascript:void(0)" @click="addToWishlist(item.product_id)">Save for later</a>
                                    <a class="remove close_button" href="javascript:void(0)"
                                        @click="removeItem(item.product_id)">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xxl-3">
            <div class="summery-box p-sticky">
                <div class="summery-header">
                    <h3>Cart Total</h3>
                </div>

                <div class="summery-contain">
                    <div class="mb-3 coupon-cart">
                        <h6 class="text-content mb-2">Coupon Apply</h6>
                        <div class="coupon-box input-group">
                            <input type="text" class="form-control" v-model="couponCode"
                                placeholder="Enter Coupon Code Here..." />
                            <button class="btn-apply" :disabled="!couponCode" @click="applyCoupon">Apply</button>
                        </div>

                        <span class="invalid-feedback d-block" v-if="couponCodeError">{{ couponCodeError }}</span>
                        <span class="valid-feedback d-block" v-if="couponCodeSuccessMessage">{{ couponCodeSuccessMessage }}</span>

                        <div class="applied-coupon d-flex justify-content-between mt-2" v-if="cart.applied_coupon">
                            <div>Applied Coupon: <span class="text-success">{{ cart.applied_coupon }}</span></div>
                            <div class="text-danger">Remove</div>
                        </div>
                    </div>
                    <ul>
                        <li>
                            <h4>Subtotal</h4>
                            <h4 class="price">{{ formatPrice(cart.sub_total) }}</h4>
                        </li>
                        <li v-if="cart.applied_coupon">
                            <h4>Coupon Discount</h4>
                            <h4 class="price">(-) {{ formatPrice(cart.discount_amount) }}</h4>
                        </li>
                        <li class="align-items-start">
                            <h4>Shipping</h4>
                            <h4 class="price text-end">-</h4>
                        </li>
                    </ul>
                </div>
                
                <ul class="summery-total">
                    <li class="list-total border-top-0">
                        <h4>Total (INR)</h4>
                        <h4 class="price theme-color">{{ formatPrice(cart.total) }}</h4>
                    </li>
                </ul>

                <div class="button-group cart-button">
                    <ul>
                        <li>
                            <a :href="checkoutLink" class="btn btn-animation proceed-btn fw-bold">Process To
                                Checkout</a>
                        </li>
                        <li>
                            <a href="/" class="btn btn-light shopping-button text-dark">
                                <i class="fa-solid fa-arrow-left-long me-2"></i>
                                Return To Shopping
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <h2 class="my-5 text-center">Cart is empty!</h2>
    </div>
</template>

<script>
import axios from 'axios';
import { emit, on } from '../eventBus';

export default {
    data() {
        return {
            cart: [],
            couponCode: '',
            couponDiscount: '0.00',
            checkoutLink: '/checkout',
            couponCodeError: '',
            couponCodeSuccessMessage: ''
        };
    },
    created() {
        on('updated-cart-fetch', this.handleCartUpdate);
        on('product-quantity-updated', this.handleCartQuantity);
    },
    methods: {
        async fetchCartData() {
            try {
                this.isLoading = true;  // Start loading
                const response = await axios.get('/cart/details');
                this.cart = response.data.cart;
                emit('cart-updated', response.data);
            } catch (error) {
                this.error = 'Error fetching cart data';  // Handle error
                console.error('Error fetching cart data:', error.response?.data || error.message);
            } finally {
                this.isLoading = false;  // Stop loading
            }
        },
        handleCartUpdate(cartData) {
            this.cart = cartData;
        },
        handleCartQuantity() {
            this.fetchCartData();
        },
        formatPrice(amount) {
            if (amount == null || isNaN(amount)) { return `-` }
            return `₹${parseFloat(amount).toFixed(2)}`;
        },
        async addToWishlist(productId) {
            if(!window.wishlistItems.includes(productId)){
                try {
                    const response = await axios.post('/wishlist', { productId: parseInt(productId) });
                    window.wishlistItems = response.data.data;
                    $('.wishlist-count').html(window.wishlistItems.length);

                    if(window.wishlistItems.length > 0){
                        $('.wishlist-count').removeClass('d-none')
                    } else {
                        $('.wishlist-count').addClass('d-none')
                    }
                } catch (error) {
                    console.error('Error adding to wishlist:', error);
                }
            }

            this.removeItem(productId);
        },
        async removeItem(productId) {
            try {
                this.isLoading = true;  // Start loading
                const response = await axios.delete(`/cart/${productId}`);
                this.cart = response.data.cart;
                emit('cart-updated', response.data);
            } catch (error) {
                this.error = 'Error removing item from cart';  // Handle error
                console.error('Error removing item from cart:', error.response?.data || error.message);
            } finally {
                this.isLoading = false;  // Stop loading
            }
        },
        async updateCart(productId, quantity) {
            if (quantity < 0) return;

            try {
                let response;

                if (quantity === 0) {
                    response = await axios.delete(`/cart/${productId}`);
                } else {
                    response = await axios.post('/cart', {
                        productId: productId,
                        quantity: quantity
                    });
                }

                this.cart = response.data.cart;
                emit('cart-updated', response.data);
            } catch (error) {
                console.error('Error updating cart:', error.response ? error.response.data : error.message);
            }
        },
        saveForLater(index) {
            // Implement save for later functionality
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
        getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
    }
};
</script>

<style scoped>
/* Add your styles here */
</style>
