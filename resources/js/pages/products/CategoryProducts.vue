<template>
    <div class="row">
        <div class="col-md-12">
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
                            <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown">
                                <span>{{ sortedFilter.label }}</span>
                                <i class="fa-solid fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" id="low" href="#"
                                        @click.prevent="sortProducts('customer_price', 'asc', 'Low - High Price')">Low -
                                        High Price</a></li>
                                <li><a class="dropdown-item" id="high" href="#"
                                        @click.prevent="sortProducts('customer_price', 'desc', 'High - Low Price')">High
                                        - Low Price</a></li>
                                <li><a class="dropdown-item" id="aToz" href="#"
                                        @click.prevent="sortProducts('name', 'asc', 'A - Z Order')">A - Z Order</a></li>
                                <li><a class="dropdown-item" id="zToa" href="#"
                                        @click.prevent="sortProducts('name', 'desc', 'Z - A Order')">Z - A Order</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <CategoryProductList :filterParam="filterParam" :filterValue="filterValue" :currentPage="currentPage" :sortedFilter="sortedFilter" @page-change="handlePageChange" />
            </div>
        </div>
    </div>
</template>

<script>
import CategoryProductList from './CategoryProductList.vue';

export default {
    name: 'Products',
    components: {
        CategoryProductList
    },
    props: {
        filterParam: {
            type: String,
            required: true
        },
        filterValue: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            currentPage: 1,
            sortedFilter: {
                column: 'customer_price',
                order: 'asc',
                label: 'Low - High Price'
            }
        }
    },
    methods: {
        sortProducts(column, order, label) {
            this.sortedFilter = {
                column,
                order,
                label
            }
        },
        handlePageChange(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
            this.updateUrl();
        }
    },
    mounted() {
        feather.replace();
    }
};
</script>