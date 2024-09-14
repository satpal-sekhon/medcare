<template>
  <div class="row">
    <div class="col-custom-3">
      <div class="left-box">
        <ProductsFilterSidebar :selectedPrimaryCategories="selectedPrimaryCategories" :selectedCategories="selectedCategories"
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
                <span>Low - High Price</span>
                <i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" id="low" href="javascript:void(0)">Low - High Price</a>
                </li>
                <li>
                  <a class="dropdown-item" id="high" href="javascript:void(0)">High - Low
                    Price</a>
                </li>
                <li>
                  <a class="dropdown-item" id="aToz" href="javascript:void(0)">A - Z Order</a>
                </li>
                <li>
                  <a class="dropdown-item" id="zToa" href="javascript:void(0)">Z - A Order</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div>
        <ProductList :selectedPrimaryCategories="selectedPrimaryCategories" :selectedCategories="selectedCategories"
          :currentPage="currentPage" @page-change="handlePageChange" />
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
      currentPage: 1
    }
  },
  methods: {
    updateUrl() {
      const queryParams = new URLSearchParams({
        primary_categories: this.selectedPrimaryCategories.join(','),
        categories: this.selectedCategories.join(','),
        page: this.currentPage
      });
      window.history.replaceState({}, '', `${window.location.pathname}?${queryParams}`);
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