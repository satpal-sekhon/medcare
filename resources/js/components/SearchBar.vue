<template>
    <div class="middle-box">
        <div class="search-box">
            <div class="input-group">
                <input type="search" class="form-control" placeholder="I'm searching for..." v-model="searchQuery"
                    @input="fetchResults" @focusout="handleFocusOut">
                <button class="btn" type="button" id="button-addon2">
                    <i data-feather="search"></i>
                </button>
            </div>
        </div>

        <div class="search-results" v-if="showSearch">
            <ul class="product-list p-1" v-for="product in searchResults">
                <li>
                    <div class="offer-product">
                        <a :href="`/product/${product.slug}`" class="offer-image" tabindex="0">
                            <img :src="`/${product.thumbnail}`"
                                class=" lazyloaded"
                                onerror="this.onerror=null; this.src='/assets/images/default/product.jpg';"
                                alt="">
                        </a>
                        <div class="offer-detail">
                            <div>
                                <a :href="`/product/${product.slug}`" class="text-title"
                                    tabindex="0">
                                    <h6 class="name">{{ product.name }}</h6>
                                </a>
                                <span>15's</span>
                                <h5 class="sold text-content">
                                    <span class="theme-color price">₹{{ product.customer_price }}</span>
                                    <del class="ms-1">₹{{ product.mrp }}</del>
                                </h5>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <div v-if="searchResults.length==0">
                <ul class="product-list p-1">
                    <li style="height: 26px;">Search results not found!</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            searchResults: [],
            showSearch: false,
            searchQuery: '',
            perPage: 5
        }
    },
    methods: {
        async fetchResults() {
            try {
                let params = {
                    page: 1,
                    per_page: this.perPage,
                    search: this.searchQuery
                }

                const response = await axios.get('/api/products', {
                    params
                });

                if (response.data.data) {
                    this.showSearch = true;
                    this.searchResults = response.data.data;
                }
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        },
        handleFocusOut() {
            /* setTimeout(() => {
                this.showSearch = false;
            }, 150); */
        }
    },
    mounted() {
        feather.replace();
    }
};
</script>

<style scoped>
.search-results {
    position: absolute;
    z-index: 999;
    background: #fff;
    top: 46px;
    width: 526px;
}
</style>