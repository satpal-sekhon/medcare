<template>
    <div
        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-4 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
        <div v-for="product in products" :key="product.id">
            <ProductCard :product="product" :is-add-to-cart-disabled="isAddToCartDisabled(product)" />
        </div>
    </div>

    <!-- Pagination Component -->
    <Pagination :currentPage="currentPage" :totalPages="totalPages" @page-change="handlePageChange" />

    <div v-if="products.length == 0">
        <WarningMessage class="mt-4" message="Products will be added soon" />
    </div>

</template>

<script>
import axios from 'axios';
import ProductCard from './ProductCard.vue';
import Pagination from '../../components/Pagination.vue';
import WarningMessage from '../../components/WarningMessage.vue';
import { emit } from '../../eventBus';

export default {
    name: 'ProductList',
    components: {
        ProductCard,
        Pagination,
        WarningMessage
    },
    props: {
        filterParam: {
            type: String,
            required: true
        },
        filterValue: {
            type: Number,
            required: true
        },
        sortedFilter: {
            type: Object,
            default: () => []
        },
        currentPage: {
            type: Number,
            default: 1
        },
        perPage: {
            type: Number,
            default: 21
        }
    },
    data() {
        return {
            products: [],
            totalPages: 1
        };
    },
    watch: {
        sortedFilter: {
            handler() {
                this.fetchProducts();
            },
            deep: true // Use deep watching for arrays or objects
        },
        currentPage() {
            this.fetchProducts();
        },
        perPage() {
            this.fetchProducts();
        }
    },
    emits: ['page-change'],
    methods: {
        async fetchProducts() {
            try {
                let params = {
                    page: this.currentPage,
                    per_page: this.perPage
                }

                params[this.filterParam] = this.filterValue;

                if (this.sortedFilter.column && this.sortedFilter.order) {
                    params.sort_column = this.sortedFilter.column;
                    params.sort_direction = this.sortedFilter.order;
                }

                const response = await axios.get('/api/products', {
                    params
                });

                if (response.data.data) {
                    this.products = response.data.data;

                    const cartResponse = await axios.get('/cart/details');
                    this.cartDetails = cartResponse.data.cart;
                    emit('updated-cart-fetch', this.cartDetails);

                    this.totalPages = response.data.meta.last_page || 1;
                }
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        },
        isAddToCartDisabled(product) {
            return !(product.stock_type === 'With Stock' && product.stock_quantity_for_customer > 0) &&
                product.stock_type !== 'Without Stock';
        },
        handlePageChange(newPage) {
            this.$emit('page-change', newPage);
        }
    },
    created() {
        this.fetchProducts();
    }
};
</script>

<style scoped></style>