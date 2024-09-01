<template>
    <div
        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
        <ProductCard v-for="(product, index) in products" :key="index" :product="product" />
    </div>
</template>

<script>
import ProductCard from './ProductCard.vue';

export default {
    name: 'ProductCardList',
    components: {
        ProductCard
    },
    data() {
        return {
            products: [
                {
                    name: 'Sample Product 1',
                    description: 'Feta taleggio croque monsieur swiss manchego cheesecake dolcelatte jarlsberg. Hard cheese danish fontina boursin melted cheese fondue.',
                    image: '../assets/images/cake/product/3.png',
                    category: 'Vegetable',
                    url: '#',
                    rating: 2.4,
                    unit: 'Pack of 3 items',
                    price: 4.33,
                    originalPrice: 10.36,
                },
                {
                    name: 'Sample product 2',
                    description: 'Feta taleggio croque monsieur swiss manchego cheesecake dolcelatte jarlsberg. Hard cheese danish fontina boursin melted cheese fondue.',
                    image: '../assets/images/cake/product/3.png',
                    category: 'Vegetable',
                    url: '#',
                    rating: 5.0,
                    unit: '12 tablets',
                    price: 24.00,
                    originalPrice: 30.50,
                },
            ]
        };
    }
};
</script>

<style scoped>
/* Your styles here */
</style>