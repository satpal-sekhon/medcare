<!-- ProductFilter.vue -->
<template>
    <div class="accordion custom-accordion">
      <div v-for="(filter, index) in filters" :key="index" class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" :data-bs-target="`#collapse${index}`">
            <span>{{ filter.title }}</span>
          </button>
        </h2>
        <div :id="`collapse${index}`" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <div class="form-floating theme-form-floating-2 search-box">
              <input
                type="search"
                class="form-control"
                v-model="filter.searchQuery"
                @input="debouncedSearch(index)"
                placeholder="Search .."
              />
              <label for="search">Search</label>
            </div>
            <ul class="category-list custom-padding custom-height">
              <li v-if="filter.items.length > 0" v-for="item in filter.items" :key="item.id">
                <div class="form-check ps-0 m-0 category-list-box">
                  <input
                    class="checkbox_animated"
                    type="checkbox"
                    :id="`filter-${filter.type}-${item.id}`"
                    :value="item.id"
                    v-model="item.isChecked"
                    @change="handleChange(filter.type, item.id, $event.target.checked)"
                  />
                  <label class="form-check-label" :for="`filter-${filter.type}-${item.id}`">
                    <span class="name">{{ item.name }}</span>
                    <span class="number">({{ item.products_count || 0 }})</span>
                  </label>
                </div>
              </li>
              <li v-else>
                No {{ filter.title }} found!
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import debounce from 'lodash/debounce';
  import axios from 'axios';
  import { reactive } from 'vue';
  
  export default {
    name: 'ProductFilter',
    props: {
      filters: {
        type: Array,
        required: true
      }
    },
    methods: {
      async fetchItems(filterIndex, search = '') {
        const filter = this.filters[filterIndex];
        try {
          const response = await axios.get(filter.apiUrl, {
            params: { search }
          });
  
          if (response.data.data) {
            const updatedItems = response.data.data.map(item => ({
              ...item,
              isChecked: filter.selectedItems.includes(String(item.id))
            }));
            this.filters[filterIndex].items = updatedItems; // Directly update the items
          }
        } catch (error) {
          console.error(`Error fetching ${filter.type}:`, error);
        }
      },
      debouncedSearch(index) {
        return debounce(() => {
          this.fetchItems(index, this.filters[index].searchQuery);
        }, 300);
      },
      handleChange(type, id, isChecked) {
        this.$emit('filter-change', { type, id, isChecked });
      },
      fetchAllFilters() {
        this.filters.forEach((filter, index) => {
          this.fetchItems(index, filter.searchQuery);
        });
      }
    },
    mounted() {
      this.fetchAllFilters();
    },
    watch: {
      filters: {
        deep: true,
        handler(newFilters) {
          newFilters.forEach((filter, index) => {
            if (filter.searchQuery) {
              this.fetchItems(index, filter.searchQuery);
            }
          });
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add any specific styles for the ProductFilter component here */
  </style>
  