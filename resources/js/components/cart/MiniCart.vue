<template>
  <button type="button" class="btn p-0 position-relative header-wishlist">
    <i data-feather="shopping-cart"></i>
    <span class="position-absolute top-0 start-100 translate-middle badge" v-if="cartDetails && cartDetails.total_items">
      {{ cartDetails.total_items }}
      <span class="visually-hidden">unread messages</span>
    </span>
  </button>

  <div class="onhover-div">
    <div class="mini-cart-container" v-if="cartDetails && cartDetails.total_items">

      <ul class="cart-list">
        <li v-for="(item, id) in cartDetails.products" :key="id" class="product-box-contain w-100">
          <div class="drop-cart">
            <a :href="`/product/${item.slug}`" class="drop-image">
              <img :src="`/${item.image}`" class="lazyload mh-100px" :alt="item.name" />
            </a>
            <div class="drop-contain">
              <a :href="`/product/${item.slug}`">
                <h5>{{ item.name }}</h5>
              </a>
              <h6>
                <span>{{ item.quantity }} x</span>
                {{ formatPrice(item.price) }}
              </h6>
              <button @click="removeItem(id)" class="close-button close_button">
                <i class="fa-solid fa-xmark"></i>
              </button>
            </div>
          </div>
        </li>
      </ul>

      <div class="price-box">
        <h5>Total :</h5>
        <h4 class="theme-color fw-bold">{{ formatPrice(cartDetails.total) }}</h4>
      </div>

      <div class="button-group">
        <a href="/cart" class="btn btn-sm cart-button">View Cart</a>
        <a href="/checkout" class="btn btn-sm cart-button theme-bg-color text-white">Checkout</a>
      </div>
    </div>
    <div v-else>
      <h4 class="text-center fw-bold">
        Cart is Empty
      </h4>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import { emit, on } from '../../eventBus';

export default {
  name: 'MiniCart',
  data() {
    return {
      cartDetails: {},
      isLoading: false,
      error: null,
    };
  },
  created() {
    on('cart-updated', this.handleCartUpdate);
    this.fetchCartData();
  },
  watch: {
    'cartDetails.total_items': function(count) {
      const cartCountElements = document.getElementsByClassName('cartCount');
      Array.from(cartCountElements).forEach((element) => {
        if (count > 0) {
          element.innerHTML = count;
          element.classList.remove('d-none'); // Remove d-none class
        } else {
          element.innerHTML = ''; // Clear content
          element.classList.add('d-none'); // Add d-none class
        }
      });
    }
  },
  methods: {
    handleCartUpdate(updatedData) {
      this.cartDetails = updatedData.cart;
    },
    async removeItem(productId) {
      try {
        this.isLoading = true;  // Start loading
        const response = await axios.delete(`/cart/${productId}`);
        this.cartDetails = response.data.cart;
        emit('product-quantity-updated', productId, 0);
      } catch (error) {
        this.error = 'Error removing item from cart';  // Handle error
        console.error('Error removing item from cart:', error.response?.data || error.message);
      } finally {
        this.isLoading = false;  // Stop loading
      }
    },
    formatPrice(amount) {
      if (amount == null || isNaN(amount)) { return `-` }
      return `₹${parseFloat(amount).toFixed(2)}`;
    },
    async fetchCartData() {
      try {
        this.isLoading = true;  // Start loading
        const response = await axios.get('/cart/details');
        this.cartDetails = response.data.cart;
        emit('updated-cart-fetch', this.cartDetails);
      } catch (error) {
        this.error = 'Error fetching cart data';  // Handle error
        console.error('Error fetching cart data:', error.response?.data || error.message);
      } finally {
        this.isLoading = false;  // Stop loading
      }
    },
  },
  mounted() {
    feather.replace();
  }
};
</script>

<style scoped>
/* Add your styles here */
</style>