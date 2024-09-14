<template>
  <div class="row">
    <div class="col-custom-3">
      <div class="left-box">
        <ProductsFilterSidebar />
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
                <span>Most Popular</span> <i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" id="pop" href="javascript:void(0)">Popularity</a>
                </li>
                <li>
                  <a class="dropdown-item" id="low" href="javascript:void(0)">Low - High
                    Price</a>
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

          <div class="grid-option d-none d-md-block">
            <ul>
              <li class="three-grid">
                <a href="javascript:void(0)">
                  <img src="../assets/svg/grid-3.svg" class="lazyload" alt="">
                </a>
              </li>
              <li class="grid-btn d-xxl-inline-block d-none active">
                <a href="javascript:void(0)">
                  <img src="../assets/svg/grid-4.svg" class="lazyload d-lg-inline-block d-none" alt="">
                  <img src="../assets/svg/grid.svg" class="lazyload img-fluid d-lg-none d-inline-block" alt="">
                </a>
              </li>
              <li class="list-btn">
                <a href="javascript:void(0)">
                  <img src="../assets/svg/list.svg" class="lazyload" alt="">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div>
        <ProductList />
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
  mounted() {
    feather.replace();
  },
};
</script>

<style scoped>
.product-page {
  padding: 20px;
}
</style>