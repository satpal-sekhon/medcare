<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-if="error" class="error">Error: {{ error }}</div>
        <div v-if="products.length">
            <a :href="`${appUrl}/view-product/${product.slug}`" v-for="product in products" :key="product.id">
                <h4 class="mb-2">
                    {{ product.name }}
                    <span class="composition" v-if="product.composition">(Composition: {{ product.composition }})</span>
                </h4>
            </a>
        </div>
        <div v-if="!loading && !error && !products.length">
            <WarningMessage message="Products will be added soon"></WarningMessage>
        </div>
    </div>
</template>

<script>
import WarningMessage from '../components/WarningMessage.vue';

export default {
    name: 'GenericProductList',
    components: {
        WarningMessage
    },
    props: {
        searchQuery: String,
        selectedAlphabet: String
    },
    data() {
        return {
            products: [],
            loading: false,
            error: null
        };
    },
    watch: {
        searchQuery: 'fetchProducts',
        selectedAlphabet: 'fetchProducts'
    },
    methods: {
        async fetchProducts() {
            this.loading = true;
            this.error = null;

            const baseUrl = '/api/products';

            // Build query parameters using a JSON object
            const queryParams = {
                product_types: 'Generic',
                name_starts_with: this.selectedAlphabet ? this.selectedAlphabet.toLowerCase() : '',
                search: this.searchQuery || ''
            };

            // Convert queryParams object to URL query string
            const url = `${baseUrl}?${new URLSearchParams(queryParams)}`;

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
            } catch (error) {
                this.error = error.message;
            } finally {
                this.loading = false;
            }
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
