<template>
  <div class="row">
    <div class="col-custom-3">
      <div class="left-box">
        <ProductsFilterSidebar :selectedPrimaryCategories="selectedPrimaryCategories" :selectedBrands="selectedBrands"
          :selectedCategories="selectedCategories" @clear-filters="handleClearFilters"
          @filter-change="handleFilterChange" />
      </div>
    </div>

    <div class="col-custom-">
      <div class="show-button">
        <div class="filter-button-group mt-0">
          <div class="filter-button d-inline-block d-lg-none">
            <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
          </div>
        </div>

        <div class="top-filter-menu">
          <div class="category-dropdown">
            <h5 class="text-content">Sort By :</h5>
            <div class="dropdown">
              <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                <span>{{ sortedFilter.label }}</span>
                <i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" id="low" href="#" @click.prevent="sortProducts('customer_price', 'asc', 'Low - High Price')">Low - High Price</a></li>
                <li><a class="dropdown-item" id="high" href="#" @click.prevent="sortProducts('customer_price', 'desc', 'High - Low Price')">High - Low Price</a></li>
                <li><a class="dropdown-item" id="aToz" href="#" @click.prevent="sortProducts('name', 'asc', 'A - Z Order')">A - Z Order</a></li>
                <li><a class="dropdown-item" id="zToa" href="#" @click.prevent="sortProducts('name', 'desc', 'Z - A Order')">Z - A Order</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div>
        <ProductList :selectedPrimaryCategories="selectedPrimaryCategories" :selectedCategories="selectedCategories"
          :currentPage="currentPage" :sortedFilter="sortedFilter" :selectedBrands="selectedBrands" @page-change="handlePageChange" />
      </div>
    </div>
  </div>
</template>

<script>
import ProductList from './ProductList.vue';
import ProductsFilterSidebar from './ProductsFilterSidebar.vue';

export default {
  name: 'Products',
  components: {
    ProductsFilterSidebar,
    ProductList
  },
  data() {
    return {
      selectedPrimaryCategories: [],
      selectedCategories: [],
      selectedBrands: [],
      currentPage: 1,
      sortedFilter: {
        column: 'customer_price',
        order: 'asc',
        label: 'Low - High Price'
      }
    }
  },
  methods: {
    updateUrl() {
      const categoryCheckboxes = document.querySelectorAll('input[name="Category[]"]');

      const availableCategories = [];

      categoryCheckboxes.forEach(checkbox => {
        availableCategories.push(checkbox.value);
      });

      this.selectedCategories = this.selectedCategories.filter(category =>
        availableCategories.includes(category)
      );

      const brandsCheckboxes = document.querySelectorAll('input[name="Brand[]"]');
      const availableBrands = [];

      brandsCheckboxes.forEach(checkbox => {
        availableBrands.push(checkbox.value);
      });

      this.selectedBrands = this.selectedBrands.filter(category =>
        availableBrands.includes(category)
      );

      // Construct the query parameters
      const queryParams = new URLSearchParams({
        primary_categories: this.selectedPrimaryCategories.join(','),
        categories: this.selectedCategories.join(','),
        brands: this.selectedBrands.join(','),
        page: this.currentPage
      });

      // Update the URL without reloading the page
      window.history.replaceState({}, '', `${window.location.pathname}?${queryParams}`);
    },
    sortProducts(column, order, label) {
      this.sortedFilter = {
        column,
        order,
        label
      }
    },
    handleFilterChange({ filterName, itemId, isChecked }) {
      this.currentPage = 1;

      let filterArray;

      switch (filterName) {
        case 'primaryCategory':
          filterArray = this.selectedPrimaryCategories;
          break;
        case 'Category':
          filterArray = this.selectedCategories;
          break;
        case 'Brand':
          filterArray = this.selectedBrands;
          break;
        default:
          console.warn(`Unknown filter type: ${filterName}`);
          return;
      }

      if (isChecked) {
        if (!filterArray.includes(itemId)) {
          filterArray.push(itemId);
        }
      } else {
        filterArray = filterArray.filter(id => id !== itemId);
      }

      this[this.getFilterArrayName(filterName)] = filterArray;

      this.updateUrl();
    },
    handleClearFilters() {
      // Clear all filters
      this.selectedPrimaryCategories = [];
      this.selectedCategories = [];
      this.selectedBrands = [];
      this.updateUrl();
    },
    getFilterArrayName(filterType) {
      switch (filterType) {
        case 'primaryCategory':
          return 'selectedPrimaryCategories';
        case 'Category':
          return 'selectedCategories';
        case 'Brand':
          return 'selectedBrands';
        default:
          console.warn(`Unknown filter type: ${filterType}`);
          return null;
      }
    },
    handlePageChange(page) {
      if (page < 1 || page > this.totalPages) return;
      this.currentPage = page;
      this.updateUrl();
    },
    initializeParams() {
      const queryParams = new URLSearchParams(window.location.search);
      this.currentPage = parseInt(queryParams.get('page'), 10) || 1;

      if (queryParams.get('primary_categories')) {
        this.selectedPrimaryCategories = queryParams.get('primary_categories').split(',');
      }

      if (queryParams.get('categories')) {
        this.selectedCategories = queryParams.get('categories').split(',');
      }

      if (queryParams.get('brands')) {
        this.selectedBrands = queryParams.get('brands').split(',');
      }
    }
  },
  mounted() {
    feather.replace();
  },
  created() {
    this.initializeParams();
  }
};
</script>