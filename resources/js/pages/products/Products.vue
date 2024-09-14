<template>
  <div class="row">
    <div class="col-custom-3">
      <div class="left-box">
        <ProductsFilterSidebar :selectedPrimaryCategories="selectedPrimaryCategories"
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
        <ProductList 
          :selectedPrimaryCategories="selectedPrimaryCategories" 
          :currentPage="currentPage" 
          @page-change="handlePageChange" 
        />
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
        categories: this.selectedPrimaryCategories.join(','),
        page: this.currentPage
      });
      window.history.replaceState({}, '', `${window.location.pathname}?${queryParams}`);
    },
    handleFilterChange({ categoryId, isChecked }) {
      this.currentPage = 1;
      
      if (isChecked) {
        if (!this.selectedPrimaryCategories.includes(categoryId)) {
          this.selectedPrimaryCategories.push(categoryId);
        }
      } else {
        this.selectedPrimaryCategories = this.selectedPrimaryCategories.filter(id => id !== categoryId);
      }

      this.updateUrl();
    },
    handlePageChange(page) {
      if (page < 1 || page > this.totalPages) return;
      this.currentPage = page;
      this.updateUrl();
    },
    initializeParams() {
      const queryParams = new URLSearchParams(window.location.search);
      this.currentPage = parseInt(queryParams.get('page'), 10) || 1;

      if (queryParams.get('categories')) {
        this.selectedPrimaryCategories = queryParams.get('categories').split(',');
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