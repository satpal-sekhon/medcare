<template>
  <a href="/cart" class="btn p-0 position-relative header-wishlist">
    <i data-feather="shopping-cart"></i>
    <span class="position-absolute top-0 start-100 translate-middle badge"
      v-if="cartDetails && cartDetails.total_items">
      {{ cartDetails.total_items }}
    </span>
  </a>

  <div class="onhover-div">
    <div class="mini-cart-container" v-if="cartDetails && cartDetails.total_items">

      <ul class="cart-list">
        <li v-for="(item, id) in cartProducts" :key="id" class="product-box-contain w-100">
          <div class="drop-cart" v-if="item.quantity">
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
              <button @click="removeItem(item.product_id, item.variant_id)" class="close-button close_button">
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
  computed: {
    cartProducts() {
      const tempProducts = [];
      for (const productId in this.cartDetails.products) {
        const product = this.cartDetails.products[productId];
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
  watch: {
    'cartDetails.total_items': function (count) {
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
    async removeItem(productId, variantId = 0) {
      try {
        this.isLoading = true;  // Start loading
        const response = await axios.delete(`/cart/${productId}`, { data: { variantId } });
        this.cartDetails = response.data.cart;
        emit('product-quantity-updated', productId, 1);
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