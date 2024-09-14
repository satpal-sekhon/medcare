<template>
    <div class="shop-left-sidebar">
        <div class="filter-category" v-if="(selectedPrimaryCategories.length > 0) || (selectedCategories.length > 0) || (selectedBrands.length > 0)">
            <div class="filter-title">
                <h2>Filters</h2>
                <a href="#" @click.prevent="clearAllFilters">Clear All</a>
            </div>
            <ul>
                <li v-for="category in selectedPrimaryCategories" :key="category" @click="removeFilter($event)">
                    <input type="checkbox" :id="`filter-primaryCategory${category}`"
                        @change="handleCheckboxChange($event, 'primaryCategory')" class="d-none"
                        :checked="isCategorySelected('primaryCategory', category)" :value="category">

                    <label :for="`filter-primaryCategory${category}`">
                        {{ primaryCategoryMap[category] || 'Unknown' }}
                    </label>
                </li>
                <li v-for="category in selectedCategories" :key="category" @click="removeFilter($event)">
                    <input type="checkbox" :id="`filter-Category${category}`"
                        @change="handleCheckboxChange($event, 'Category')" class="d-none"
                        :checked="isCategorySelected('Category', category)" :value="category">

                    <label :for="`filter-Category${category}`">
                        {{ CategoryMap[category] || 'Unknown' }}
                    </label>
                </li>
                <li v-for="category in selectedBrands" :key="category" @click="removeFilter($event)">
                    <input type="checkbox" :id="`filter-Brand${category}`"
                        @change="handleCheckboxChange($event, 'Brand')" class="d-none"
                        :checked="isCategorySelected('Brand', category)" :value="category">

                    <label :for="`filter-Category${category}`">
                        {{ BrandMap[category] || 'Unknown' }}
                    </label>
                </li>
            </ul>
        </div>

        <div class="accordion custom-accordion">
            <div v-for="(item, index) in accordionItems" :key="index" class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" :aria-expanded="isAccordionExpanded(item.collapseId)"
                        :aria-controls="item.collapseId" :data-bs-toggle="item.collapseId"
                        :data-bs-target="`#${item.collapseId}`">
                        <span>{{ item.title }}</span>
                    </button>
                </h2>
                <div :id="item.collapseId" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="form-floating theme-form-floating-2 search-box">
                            <input type="search" class="form-control" v-model="item.searchQuery"
                                @input="debouncedSearch(item.filterName)" placeholder="Search ..">
                            <label for="search">Search</label>
                        </div>

                        <ul class="category-list custom-padding custom-height">
                            <li v-if="item.categories.length" v-for="category in item.categories" :key="category.id">
                                <div class="form-check ps-0 m-0 category-list-box">
                                    <input class="checkbox_animated" type="checkbox" :name="`${item.filterName}[]`"
                                        :id="`filter-${item.filterName}-${category.id}`" :value="category.id"
                                        v-model="category.isChecked"
                                        @change="handleCheckboxChange($event, item.filterName)" />
                                    <label class="form-check-label" :for="`filter-${item.filterName}-${category.id}`">
                                        <span class="name">{{ category.name }}</span>
                                        <span class="number">({{ category.products_count }})</span>
                                    </label>
                                </div>
                            </li>
                            <li v-else>No {{ item.title }} found!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import debounce from 'lodash/debounce';

export default {
    name: 'ProductsFilterSidebar',
    props: {
        selectedPrimaryCategories: Array,
        selectedCategories: Array,
        selectedBrands: Array
    },
    data() {
        return {
            accordionItems: [
                {
                    title: 'Primary Categories',
                    collapseId: 'collapseOne',
                    searchQuery: '',
                    filterName: 'primaryCategory',
                    categories: [],
                    apiEndpoint: '/api/primary-categories'
                },
                {
                    title: 'Categories',
                    collapseId: 'collapseTwo',
                    searchQuery: '',
                    filterName: 'Category',
                    categories: [],
                    apiEndpoint: '/api/categories'
                },
                {
                    title: 'Brands',
                    collapseId: 'collapseThree',
                    searchQuery: '',
                    filterName: 'Brand',
                    categories: [],
                    apiEndpoint: '/api/brands'
                }
            ],
            primaryCategoryMap: {},
            CategoryMap: {},
            BrandMap: {}
        };
    },
    mounted() {
        this.fetchAccordionItemsData();
    },
    methods: {
        async fetchAccordionItemsData() {
            await Promise.all(this.accordionItems.map(item =>
                this.fetchData(item.apiEndpoint, item.filterName, item.searchQuery)
            ));
        },
        removeFilter(event) {
            event.preventDefault();
            const checkbox = event.currentTarget.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            checkbox.dispatchEvent(new Event('change'));
        },
        async fetchData(endpoint, filterName, search = '') {
            try {
                const params = { search };

                if ((filterName === 'Category' || filterName === 'Brand') && this.selectedPrimaryCategories.length > 0) {
                    params.primary_category_ids = this.selectedPrimaryCategories.join(',');
                }

                if (filterName === 'Brand' && this.selectedCategories.length > 0) {
                    params.category_ids = this.selectedCategories.join(',');
                }

                const { data } = await axios.get(endpoint, { params });
                const targetItem = this.accordionItems.find(item => item.filterName === filterName);

                if (targetItem) {
                    targetItem.categories = data.data.map(category => ({
                        ...category,
                        isChecked: this.isCategorySelected(filterName, category.id)
                    }));

                    // Update primaryCategoryMap if fetching primary categories
                    if (filterName === 'primaryCategory') {
                        this.primaryCategoryMap = data.data.reduce((acc, category) => {
                            acc[category.id] = category.name;
                            return acc;
                        }, {});
                    }

                    if (filterName === 'Category') {
                        this.CategoryMap = data.data.reduce((acc, category) => {
                            acc[category.id] = category.name;
                            return acc;
                        }, {});
                    }

                    if (filterName === 'Brand') {
                        this.BrandMap = data.data.reduce((acc, category) => {
                            acc[category.id] = category.name;
                            return acc;
                        }, {});
                    }
                }
            } catch (error) {
                console.error(`Error fetching ${filterName} data:`, error);
                // You might want to add user feedback here
            }
        },

        debouncedSearch(filterName) {
            debounce(() => {
                this.fetchData(
                    this.accordionItems.find(item => item.filterName === filterName).apiEndpoint,
                    filterName,
                    this.accordionItems.find(item => item.filterName === filterName).searchQuery
                );
            }, 300)();
        },

        handleCheckboxChange(event, filterName) {
            const isChecked = event.target.checked;
            const itemId = event.target.value;
            this.$emit('filter-change', { filterName, itemId, isChecked });
        },

        clearAllFilters() {
            this.$emit('clear-filters');
        },

        isCategorySelected(filterName, categoryId) {
            switch (filterName) {
                case 'primaryCategory':
                    return this.selectedPrimaryCategories.includes(String(categoryId));
                case 'Category':
                    return this.selectedCategories.includes(String(categoryId));
                case 'Brand':
                    return this.selectedBrands.includes(String(categoryId));
                default:
                    return false;
            }
        },

        isAccordionExpanded(collapseId) {
            return this.accordionItems.find(item => item.collapseId === collapseId)?.searchQuery ? 'true' : 'false';
        }
    },
    watch: {
        selectedPrimaryCategories: 'fetchAccordionItemsData',
        selectedCategories: 'fetchAccordionItemsData',
        selectedBrands: 'fetchAccordionItemsData'
    }
};
</script>
