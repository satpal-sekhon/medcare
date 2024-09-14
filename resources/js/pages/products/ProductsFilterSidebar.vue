<template>
    <div class="shop-left-sidebar">

        <div class="accordion custom-accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        <span>Primary Categories</span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="form-floating theme-form-floating-2 search-box">
                            <input type="search" class="form-control" v-model="searchPrimaryCategoryQuery"
                                @input="debouncedSearch" placeholder="Search ..">
                            <label for="search">Search</label>
                        </div>

                        <ul class="category-list custom-padding custom-height">
                            <li v-if="primaryCategories.length > 0" v-for="category in primaryCategories" :key="category.id">
                                <div class="form-check ps-0 m-0 category-list-box">
                                    <input
                                        class="checkbox_animated"
                                        type="checkbox"
                                        :id="`filter-cat-${category.id}`"
                                        :value="category.id"
                                        v-model="category.isChecked"
                                        @change="handleCheckboxChange"
                                    />
                                    <label class="form-check-label" :for="`filter-cat-${category.id}`">
                                        <span class="name">{{ category.name }}</span>
                                        <span class="number">({{ category.products_count }})</span>
                                    </label>
                                </div>
                            </li>
                            <li v-else>
                                No Categories found!
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
        }
    },
    data() {
        return {
            primaryCategories: [],
            searchPrimaryCategoryQuery: '',
            categories: [],
        };
    },
    mounted() {
        this.fetchCategories();
    },
    methods: {
        async fetchCategories(search = '') {
            try {
                const response = await axios.get('/api/primary-categories', {
                    params: {
                        search
                    }
                });

                if (response.data.data) {
                    this.primaryCategories = response.data.data.map(category => ({
                        ...category,
                        isChecked: this.selectedPrimaryCategories.includes(String(category.id))
                    }));
                }
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        },

        // Debounced search method to handle user input
        debouncedSearch: debounce(function () {
            this.fetchCategories(this.searchPrimaryCategoryQuery);
        }, 300),

        clearAll() {
            this.searchPrimaryCategoryQuery = '';
            this.fetchCategories();
        },

        handleCheckboxChange(event) {
            const isChecked = event.target.checked;
            const categoryId = event.target.value;
            this.$emit('filter-change', { categoryId, isChecked });
        }
    },
    watch: {
        selectedPrimaryCategories: {
            handler(newCategories) {
                /* this.primaryCategories.forEach(category => {
                    category.isChecked = newCategories.includes(category.id);
                }); */
            },
            deep: true
        }
    },
};
</script>