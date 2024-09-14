<template>
    <div class="shop-left-sidebar">
        <div class="filter-category">
            <div class="filter-title">
                <h2>Filters</h2>
                <a href="javascript:void(0)">Clear All</a>
            </div>
            <ul>
                <li>
                    <a href="javascript:void(0)">Pharma</a>
                </li>
                <li>
                    <a href="javascript:void(0)">Test</a>
                </li>
            </ul>
        </div>

        <div class="accordion custom-accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        <span>Categories</span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="form-floating theme-form-floating-2 search-box">
                            <input type="search" class="form-control" id="search" placeholder="Search ..">
                            <label for="search">Search</label>
                        </div>

                        <ul class="category-list custom-padding custom-height">
                            <li>
                                <div class="form-check ps-0 m-0 category-list-box">
                                    <input class="checkbox_animated" type="checkbox" id="filter-cat1">
                                    <label class="form-check-label" for="filter-cat1">
                                        <span class="name">Category Name</span>
                                        <span class="number">(1)</span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductsFilterSidebar',
    // Data, methods, and other options can be added here
};
</script>