<template>
  <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
    <product-item v-for="product in products" :key="product.id" :product="product" />
  </div>
</template>

<script>
import ProductItem from './ProductItem.vue';

export default {
  components: {
    ProductItem,
  },
  data() {
    return {
      products: [
        { id: 1, name: 'Product 1', image: '/assets/images/product/1.png', price: '26.69', originalPrice: '28.56', rating: [1, 1, 1, 1, 0], ratingValue: 4, link: '#' },
        { id: 2, name: 'Product 2', image: '/assets/images/product/2.png', price: '30.99', originalPrice: '32.99', rating: [1, 1, 1, 1, 1], ratingValue: 5, link: '#' },
        { id: 3, name: 'Product 3', image: '/assets/images/product/3.png', price: '20.00', originalPrice: '22.00', rating: [1, 1, 1, 0, 0], ratingValue: 3, link: '#' },
        { id: 4, name: 'Product 4', image: '/assets/images/product/4.png', price: '15.49', originalPrice: '17.49', rating: [1, 1, 1, 1, 0], ratingValue: 4, link: '#' },
        { id: 5, name: 'Product 5', image: '/assets/images/product/5.png', price: '25.75', originalPrice: '27.75', rating: [1, 1, 1, 1, 1], ratingValue: 5, link: '#' },
        { id: 6, name: 'Product 6', image: '/assets/images/product/6.png', price: '18.90', originalPrice: '20.90', rating: [1, 1, 1, 1, 1], ratingValue: 5, link: '#' },
        { id: 7, name: 'Product 7', image: '/assets/images/product/7.png', price: '22.55', originalPrice: '24.55', rating: [1, 1, 1, 1, 0], ratingValue: 4, link: '#' },
        { id: 8, name: 'Product 8', image: '/assets/images/product/8.png', price: '17.99', originalPrice: '19.99', rating: [1, 1, 1, 0, 0], ratingValue: 3, link: '#' },
        { id: 9, name: 'Product 9', image: '/assets/images/product/9.png', price: '12.49', originalPrice: '14.49', rating: [1, 1, 1, 1, 1], ratingValue: 5, link: '#' },
        { id: 10, name: 'Product 10', image: '/assets/images/product/10.png', price: '28.40', originalPrice: '30.40', rating: [1, 1, 1, 1, 0], ratingValue: 4, link: '#' },
        { id: 11, name: 'Product 11', image: '/assets/images/product/11.png', price: '16.89', originalPrice: '18.89', rating: [1, 1, 1, 0, 0], ratingValue: 3, link: '#' },
        { id: 12, name: 'Product 12', image: '/assets/images/product/12.png', price: '21.25', originalPrice: '23.25', rating: [1, 1, 1, 1, 1], ratingValue: 5, link: '#' },
      ],
    };
  },
};
</script>

<style scoped>
/* Your styles here */
</style>