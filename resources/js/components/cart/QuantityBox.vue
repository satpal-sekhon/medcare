<template>
    <div v-if="variant === 'product-detail'">
        <div class="product-package" v-if="variants.length > 0">
            <div class="product-title">
                <h4>Variant</h4>
            </div>

            <div class="select-package">
                <select name="variant_id" class="form-control form-select" @change="updateVariant($event.target.value)">
                    <option :value="0">{{ product.unit }}</option>
                    <option v-for="variant in variants" :key="variant.id" :value="variant.id">{{ variant.name }}
                    </option>
                </select>
            </div>
        </div>

        <div class="note-box product-package">
            <div class="cart_qty qty-box product-qty">
                <div class="input-group">
                    <button type="button" class="qty-left-minus" :disabled="tempQuantity < 1" @click="dicreaseQuantity">
                        <i class="fa fa-minus"></i>
                    </button>
                    <input class="form-control input-number qty-input" type="text" name="quantity"
                        :value="tempQuantity">
                    <button type="button" class="qty-right-plus" @click="increaseQuantity">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>

            <button class="btn btn-md bg-dark cart-button text-white w-100" @click="addToCart">Add To Cart</button>
        </div>
    </div>
    <div class="add-to-cart-box" v-else>
        <button class="btn btn-add-cart addcart-button" :disabled="isAddToCartDisabled" @click="changeQuantity(1)">
            Add to cart
            <span class="add-icon">
                <i class="fa-solid fa-plus"></i>
            </span>
        </button>
        <div :class="['cart_qty qty-box mw-100', { 'open': quantity > 0 }]">
            <div class="input-group">
                <button type="button" class="qty-left-minus" @click="changeQuantity(-1)">
                    <i class="fa fa-minus"></i>
                </button>
                <input class="form-control input-number qty-input" type="text" name="quantity" :value="quantity" />
                <button type="button" class="qty-right-plus" @click="changeQuantity(1)">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { on, emit } from '../../eventBus';
import CartNotification from './CartNotification.vue';
import { createApp } from 'vue';

export default {
    name: 'QuantityBox',
    props: {
        initialQuantity: {
            type: Number,
            default: 0
        },
        productId: {
            type: Number,
            required: true
        },
        product: {
            type: Object,
            default: {}
        },
        variants: {
            type: Array,
            default: []
        },
        variant: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            quantity: this.initialQuantity,
            isAddToCartDisabled: false,
            tempQuantity: this.initialQuantity || 1,
            showNotification: false,
            variantId: 0
        };
    },
    created() {
        on('updated-cart-fetch', this.handleCartUpdate);
        on('product-quantity-updated', this.handleCartQuantity);

        if(window.isVendor && this.tempQuantity<5){
            this.tempQuantity = 5;
        }
    },
    methods: {
        increaseQuantity() {
            this.tempQuantity = parseInt(this.tempQuantity) + 1;
        },
        dicreaseQuantity() {
            if (parseInt(this.tempQuantity) !== 1 && this.variant === 'product-detail') {
                if(window.isVendor && this.tempQuantity===5){
                    this.tempQuantity = 5;
                } else {
                    this.tempQuantity = parseInt(this.tempQuantity) - 1;
                }
            }
        },
        addToCart() {
            this.quantity = this.tempQuantity;
            this.updateCart();
        },
        updateVariant(variantId) {
            const selectedVariant = this.variants.find(variant => variant.id == variantId) || null;

            if (selectedVariant) {
                if (window.cart.products) {
                    let variants = window.cart.products[this.productId]?.variants || {};
                    if (variants[selectedVariant.id]) {
                        this.tempQuantity = variants[selectedVariant.id].quantity || 1;
                    } else {
                        this.tempQuantity = 1;
                    }
                } else {
                    this.tempQuantity = 1;
                }

                this.variantId = selectedVariant.id;
                $('.productUnitName').html(selectedVariant.name);

                if(window.isVendor){
                    $(`.main-product-price`).html(`₹${selectedVariant.vendor_price}`);
                } else {
                    $(`.main-product-price`).html(`₹${selectedVariant.customer_price}`);
                }

                $(`.main-product-mrp`).html(`₹${selectedVariant.mrp}`);
            } else {
                this.variantId = 0;

                if (window.cart.products) {
                    if (window.cart.products[this.productId] || null) {
                        this.tempQuantity = window.cart.products[this.productId].quantity || 1;
                    } else {
                        this.tempQuantity = 1;
                    }
                } else {
                    this.tempQuantity = 1;
                }

                $('.productUnitName').html(this.product.unit);
                
                if(window.isVendor){
                    $(`.main-product-price`).html(`₹${this.product.vendor_price}`);
                } else {
                    $(`.main-product-price`).html(`₹${this.product.customer_price}`);
                }

                $(`.main-product-mrp`).html(`₹${this.product.mrp}`);
            }
        },
        handleCartUpdate(updatedData) {
            if (updatedData) {
                if (updatedData.products && updatedData.products[this.productId]) {
                    this.quantity = updatedData.products[this.productId].quantity;
                    this.tempQuantity = this.quantity || 1;
                }
            }
        },
        handleCartQuantity(productId, quantity = 1) {
            if (parseInt(this.productId) === parseInt(productId)) {
                this.quantity = quantity;
                this.tempQuantity = quantity;
            }
        },
        changeQuantity(amount) {
            if(this.quantity<5 && window.isVendor){
                this.quantity = 5;
            } else if(this.quantity===5 && window.isVendor && amount<0){
                this.quantity = 0;
            } else {
                this.quantity = Math.max(0, this.quantity + amount);
            }

            this.updateCart();

            if (this.quantity <= 0) return;
            this.isAddToCartDisabled = true;
        },
        async updateCart() {
            if (this.quantity < 0) return;

            this.isAddToCartDisabled = true;

            try {
                let response;

                if (this.quantity === 0 || !this.quantity) {
                    response = await axios.delete(`/cart/${this.productId}`);
                } else {
                    let payload = {
                        productId: this.productId,
                        quantity: this.quantity,
                    }

                    if (this.variantId > 0) {
                        payload.variantId = this.variantId;
                    }

                    response = await axios.post('/cart', payload);
                }

                if (response.data.status && response.data.status === 'ADDED') {
                    let addedProduct = response.data.cart.products[this.productId] || {};

                    if (this.variantId > 0) {
                        addedProduct = response.data.cart.products[this.productId].variants[this.variantId];
                    }
                    this.renderNotification(addedProduct);
                }

                emit('cart-updated', response.data);
            } catch (error) {
                console.error('Error updating cart:', error.response ? error.response.data : error.message);
            } finally {
                this.isAddToCartDisabled = false;
            }
        },
        renderNotification(addedProduct) {
            const container = document.querySelector('#notification-container');

            if (container) {
                // Clear existing notifications if necessary
                container.innerHTML = '';

                const app = createApp({
                    components: {
                        CartNotification
                    },
                    data() {
                        return {
                            showNotification: true,
                            addedProduct: addedProduct
                        };
                    },
                    template: '<CartNotification :show="showNotification" :product="addedProduct" />',
                    mounted() {
                        setTimeout(() => {
                            container.innerHTML = '';
                        }, 3000);
                    }
                });

                app.mount(container);
            }
        }
    }
};
</script>
