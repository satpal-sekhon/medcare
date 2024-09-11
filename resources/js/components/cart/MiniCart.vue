<template>
    <div class="onhover-div">
      <ul class="cart-list">
        <li v-for="(item, index) in cartItems" :key="index" class="product-box-contain w-100">
          <div class="drop-cart">
            <a href="#" class="drop-image">
              <img :src="item.image" class="lazyload mh-100px" :alt="item.name" />
            </a>
            <div class="drop-contain">
              <a href="#">
                <h5>{{ item.name }}</h5>
              </a>
              <h6><span>{{ item.quantity }} x</span> {{ formatPrice(item.price) }}</h6>
              <button @click="removeItem(index)" class="close-button close_button">
                <i class="fa-solid fa-xmark"></i>
              </button>
            </div>
          </div>
        </li>
      </ul>
  
      <div class="price-box">
        <h5>Total :</h5>
        <h4 class="theme-color fw-bold">{{ formatPrice(totalPrice) }}</h4>
      </div>
  
      <div class="button-group">
        <a href="/cart" class="btn btn-sm cart-button">View Cart</a>
        <a href="/checkout" class="btn btn-sm cart-button theme-bg-color text-white">Checkout</a>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        cartItems: [
          {
            name: 'Product 1 Name',
            price: 80.58,
            quantity: 1,
            image: '/assets/images/product/1.png'
          },
          {
            name: 'Product 2 Name',
            price: 25.68,
            quantity: 1,
            image: '/assets/images/product/2.png'
          },
          {
            name: 'Product 3 Name',
            price: 35.68,
            quantity: 1,
            image: '/assets/images/product/2.png'
          }
        ]
      };
    },
    computed: {
      totalPrice() {
        return this.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
      }
    },
    methods: {
      formatPrice(amount) {
        return `$${amount.toFixed(2)}`;
      },
      removeItem(index) {
        this.cartItems.splice(index, 1);
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  