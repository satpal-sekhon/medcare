<template>
    <div class="shop-left-sidebar">
        <div class="accordion custom-accordion">
            <div v-for="(item, index) in accordionItems" :key="index" class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" :data-bs-toggle="item.collapseId"
                        :data-bs-target="`#${item.collapseId}`">
                        <span>{{ item.title }}</span>
                    </button>
                </h2>
                <div :id="item.collapseId" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="form-floating theme-form-floating-2 search-box">
                            <input type="search" class="form-control" v-model="item.searchQuery"
                                @input="debouncedSearch" placeholder="Search ..">
                            <label for="search">Search</label>
                        </div>

                        <ul class="category-list custom-padding custom-height">
                            <li v-if="item.categories.length > 0" v-for="category in item.categories" :key="category.id">
                                <div class="form-check ps-0 m-0 category-list-box">
                                    <input class="checkbox_animated" type="checkbox" :id="`filter-${item.filterName}-${category.id}`"
                                        :value="category.id" v-model="category.isChecked"
                                        @change="handleCheckboxChange($event, item.filterName)" />
                                    <label class="form-check-label" :for="`filter-${item.filterName}-${category.id}`">
                                        <span class="name">{{ category.name }}</span>
                                        <span class="number">({{ category.products_count }})</span>
                                    </label>
                                </div>
                            </li>
                            <li v-else>
                                No {{ item.title }} found!
                            </li>
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
        selectedPrimaryCategories: {
            type: Array,
            default: []
        },
        selectedCategories: {
            type: Array,
            default: []
        }
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
                    fetchCategories: this.fetchPrimaryCategories
                },
                {
                    title: 'Categories',
                    collapseId: 'collapseTwo',
                    searchQuery: '',
                    filterName: 'Category',
                    categories: [],
                    fetchCategories: this.fetchCategories
                }
            ]
        };
    },
    mounted() {
        this.fetchAccordionItemsData();
    },
    methods: {
        async fetchAccordionItemsData() {
            for (const item of this.accordionItems) {
                await item.fetchCategories.call(this, item.searchQuery);
            }
        },

        async fetchPrimaryCategories(search = '') {
            try {
                const response = await axios.get('/api/primary-categories', {
                    params: { search }
                });

                if (response.data.data) {
                    this.accordionItems[0].categories = response.data.data.map(category => ({
                        ...category,
                        isChecked: this.selectedPrimaryCategories.includes(String(category.id))
                    }));
                }
            } catch (error) {
                console.error('Error fetching primary categories:', error);
            }
        },

        async fetchCategories(search = '') {
            try {
                let params = { search };

                if (this.selectedPrimaryCategories.length > 0) {
                    params.primary_category_ids = this.selectedPrimaryCategories.join(',');
                }

                const response = await axios.get('/api/categories', { params });

                if (response.data.data) {
                    this.accordionItems[1].categories = response.data.data.map(category => ({
                        ...category,
                        isChecked: this.selectedCategories.includes(String(category.id))
                    }));
                }
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        },

        debouncedSearch: debounce(function () {
            for (const item of this.accordionItems) {
                item.fetchCategories.call(this, item.searchQuery);
            }
        }, 300),

        handleCheckboxChange(event, filterName) {
            const isChecked = event.target.checked;
            const itemId = event.target.value;
            this.$emit('filter-change', { filterName, itemId, isChecked });
        }
    },
    watch: {
        selectedPrimaryCategories: {
            handler() {
                this.fetchAccordionItemsData();
            },
            deep: true
        }
    }
};
</script>
