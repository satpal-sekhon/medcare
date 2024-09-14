<template>
  <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
    <div v-for="product in products" :key="product.id">
      <ProductCard :product="product" :quantity="productQuantities[product.id] || 0"
        :is-add-to-cart-disabled="isAddToCartDisabled(product)" @change-quantity="changeQuantity(product.id, $event)" />
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

export default {
  name: 'ProductList',
  components: {
    ProductCard,
    Pagination,
    WarningMessage
  },
  props: {
    selectedPrimaryCategories: {
      type: Array,
      default: () => []
    },
    currentPage: {
      type: Number,
      default: 1
    },
    perPage: {
      type: Number,
      default: 20
    }
  },
  data() {
    return {
      products: [],
      productQuantities: {},
      totalPages: 1
    };
  },
  watch: {
    selectedPrimaryCategories: {
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
  methods: {
    async fetchProducts() {
      try {
        let params = {
          page: this.currentPage,
          per_page: this.perPage
        }

        if (this.selectedPrimaryCategories && this.selectedPrimaryCategories.length > 0) {
          params.primary_category_ids = this.selectedPrimaryCategories.join(',');
        }

        const response = await axios.get('/api/products', {
          params
        });

        if (response.data.data) {
          this.products = response.data.data;
          this.totalPages = response.data.meta.last_page || 1;
        }
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    changeQuantity(productId, amount) {
      const currentQuantity = this.productQuantities[productId] || 0;
      this.productQuantities[productId] = Math.max(currentQuantity + amount, 0);
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
