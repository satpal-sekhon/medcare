<template>
    <div class="add-to-cart-box">
        <button class="btn btn-add-cart addcart-button" :disabled="isAddToCartDisabled" @click="changeQuantity(1)">
            Add
            <span class="add-icon">
                <i class="fa-solid fa-plus"></i>
            </span>
        </button>
        <div :class="['cart_qty qty-box mw-100', { 'open': quantity > 0 }]">
            <div class="input-group">
                <button type="button" class="qty-left-minus" data-type="minus" data-field=""
                    @click="changeQuantity(-1)">
                    <i class="fa fa-minus"></i>
                </button>
                <input class="form-control input-number qty-input" type="text" name="quantity" :value="quantity" />
                <button type="button" class="qty-right-plus" data-type="plus" data-field="" @click="changeQuantity(1)">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { on, emit } from '../../eventBus';

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
        }
    },
    data() {
        return {
            quantity: this.initialQuantity,
            isAddToCartDisabled: false,
        };
    },
    created() {
        on('updated-cart-fetch', this.handleCartUpdate);
        on('product-quantity-updated', this.handleCartQuantity);
    },
    methods: {
        handleCartUpdate(updatedData) {
            if (updatedData.products && updatedData.products[this.productId]) {
                this.quantity = updatedData.products[this.productId].quantity;
            }
        },
        handleCartQuantity(productId, quantity = 0) {
            if (this.productId == productId) {
                this.quantity = 0;
                console.log('productId', productId)
                console.log('quantity', quantity)
            }
        },
        changeQuantity(amount) {
            this.quantity = Math.max(0, this.quantity + amount);
            this.updateCart();

            if (this.quantity <= 0) return;
            this.isAddToCartDisabled = true;
        },
        async updateCart() {
            if (this.quantity < 0) return;

            this.isAddToCartDisabled = true;

            try {
                let response;

                if (this.quantity === 0) {
                    response = await axios.delete(`/cart/${this.productId}`);
                } else {
                    response = await axios.post('/cart', {
                        productId: this.productId,
                        quantity: this.quantity
                    });
                }

                emit('cart-updated', response.data);
            } catch (error) {
                console.error('Error updating cart:', error.response ? error.response.data : error.message);
            } finally {
                this.isAddToCartDisabled = false;
            }
        }
    }
};
</script>
