<template>

    <!-- Loading and Error States -->
    <div v-if="loading">Loading...</div>
    <div v-if="error" class="error">Error: {{ error }}</div>

    <div v-if="searchQuery && !loading">
        <h4 class="mb-2">{{ totalRecords }} Search results for: <strong>{{ searchQuery }}</strong></h4>
        <div class="searched-products">
            <div v-if="searchedProducts.length">
                <a v-for="product in searchedProducts" :key="product.id" :href="`/product/${product.slug}`"
                    class="product-link">
                    <h4 class="mb-2">
                        {{ product.name }}
                        <span v-if="product.composition" class="composition">
                            (Composition: {{ product.composition }})
                        </span>
                    </h4>
                </a>

                <!-- Pagination Component -->
                <Pagination :currentPage="currentSearchPage" :totalPages="totalSearchPages"
                    @page-change="handleSearchPageChange" />
            </div>
        </div>
    </div>

    <div class="section-b-space">
        <!-- Product List -->
        <div v-if="products.length && !searchQuery">
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
import Pagination from '../../components/Pagination.vue';
import WarningMessage from '../../components/WarningMessage.vue';

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
        currentSearchPage: {
            type: Number,
            default: 1
        },
        perPage: {
            type: Number,
            default: 12
        }
    },
    data() {
        return {
            products: [],
            searchedProducts: [],
            totalPages: 1,
            totalSearchPages: 1,
            loading: false,
            error: null,
            totalRecords: 0
        };
    },
    watch: {
        searchQuery: 'searchProducts',
        currentSearchPage: 'searchProducts',
        selectedAlphabet: 'fetchProducts',
        currentPage: 'fetchProducts',
    },
    emits: ['searchPageChange', 'pageChange'],
    methods: {
        async fetchProducts() {
            this.loading = true;
            this.error = null;

            // Build query parameters using a JSON object
            const queryParams = {
                product_types: 'Generic',
                page: this.currentPage,
                per_page: this.perPage,
                name_starts_with: this.selectedAlphabet ? this.selectedAlphabet.toLowerCase() : 'a',
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
        async searchProducts() {
            this.loading = true;
            this.error = null;

            // Build query parameters using a JSON object
            const queryParams = {
                product_types: 'Generic',
                page: this.currentSearchPage,
                per_page: this.perPage,
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
                this.searchedProducts = data.data || [];
                this.totalSearchPages = data.meta.last_page || 1;

                if(this.currentSearchPage > this.totalSearchPages){
                    this.handleSearchPageChange(1);
                }

                this.totalRecords = data.meta.total || 0;
            } catch (error) {
                this.error = error.message;
            } finally {
                this.loading = false;
            }
        },
        handlePageChange(page) {
            this.$emit('page-change', page);
        },
        handleSearchPageChange(page) {
            this.$emit('search-page-change', page);
        }
    },
    created() {
        this.fetchProducts();
        if (this.searchQuery) {
            this.searchProducts();
        }
    }
};
</script>

<style scoped>
.error {
    color: red;
}
</style>
