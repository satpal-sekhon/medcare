<template>
    <div class="section-b-space">
        <!-- Loading and Error States -->
        <div v-if="loading">Loading...</div>
        <div v-if="error" class="error">Error: {{ error }}</div>


        <div v-if="searchQuery">
            <h4 class="mb-2">{{ totalRecords }} Search results for: <strong>{{ searchQuery }}</strong></h4>
        </div>

        <!-- Product List -->
        <div v-if="products.length">
            <a v-for="product in products" :key="product.id" :href="`/product/${product.slug}`" class="product-link">
                <h4 class="mb-2">
                    {{ product.name }}
                    <span v-if="product.composition" class="composition">
                        (Composition: {{ product.composition }})
                    </span>
                </h4>
            </a>

            <!-- Pagination Component -->
            <Pagination :currentPage="currentPage" :totalPages="totalPages" @page-change="handlePageChange" />
        </div>

        <!-- No Products Message -->
        <div v-if="!loading && !error && !products.length">
            <WarningMessage message="Products will be added soon" />
        </div>
    </div>
</template>

<script>
import Pagination from '../components/Pagination.vue';
import WarningMessage from '../components/WarningMessage.vue';

export default {
    name: 'GenericProductList',
    components: {
        Pagination,
        WarningMessage
    },
    props: {
        searchQuery: {
            type: String,
            default: ''
        },
        selectedAlphabet: {
            type: String,
            default: ''
        },
        currentPage: {
            type: Number,
            default: 1
        },
        perPage: {
            type: Number,
            default: 18
        }
    },
    data() {
        return {
            products: [],
            totalPages: 1,
            loading: false,
            error: null,
            totalRecords: 0
        };
    },
    watch: {
        searchQuery: 'fetchProducts',
        selectedAlphabet: 'fetchProducts',
        currentPage: 'fetchProducts'
    },
    methods: {
        async fetchProducts() {
            this.loading = true;
            this.error = null;

            // Build query parameters using a JSON object
            const queryParams = {
                product_types: 'Generic',
                page: this.currentPage,
                per_page: this.perPage,
                name_starts_with: this.selectedAlphabet ? this.selectedAlphabet.toLowerCase() : '',
                search: this.searchQuery || '',
            };

            // Convert queryParams object to URL query string
            const url = `/api/products?${new URLSearchParams(queryParams).toString()}`;

            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`Error ${response.status}: ${response.statusText}`);
                }

                const data = await response.json();
                this.products = data.data || [];
                this.totalPages = data.meta.last_page || 1;
                this.totalRecords = data.meta.total || 0;
            } catch (error) {
                this.error = error.message;
            } finally {
                this.loading = false;
            }
        },
        handlePageChange(page) {
            this.$emit('page-change', page);
        }
    },
    created() {
        this.fetchProducts();
    }
};
</script>

<style scoped>
.error {
    color: red;
}
</style>
