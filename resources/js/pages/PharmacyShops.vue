<template>
    <div>
        <!-- Search Pharmacy Section -->
        <div class="row mb-4">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="title d-block">
                    <div class="text-center">
                        <h2>Search for Nearest Pharma Shop</h2>
                    </div>
                </div>

                <div class="search-box rounded">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-pill"
                            placeholder="Search by Name, Pincode or City..." v-model="searchQuery" />
                        <button class="btn theme-bg-color text-white m-0 absolute search-btn" type="button"
                            @click="searchPharmacies">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pharmacy List -->
        <div class="col-12 section-t-space">
            <div class="row product-list-section">
                <div v-for="(pharmacy, index) in pharmacies" :key="index" class="col-md-4 mb-4">
                    <div class="product-box-3 row mx-1">
                        <div class="col-md-5 product-image d-flex align-items-center">
                            <a :href="pharmacy.link">
                                <img :src="pharmacy.image" class="img-fluid lazyload" :alt="pharmacy.name" />
                            </a>
                        </div>
                        <div class="col-md-7 product-detail-wrapper d-flex flex-column justify-content-between">
                            <div class="product-detail">
                                <h4 class="name fw-bold">{{ pharmacy.name }}</h4>
                            </div>
                            <div class="mt-3">
                                <div class="mb-2">
                                    <strong>Pincode:</strong> {{ pharmacy.pincode }}
                                </div>
                                <div class="mb-2">
                                    <strong>Location:</strong> {{ pharmacy.address }}
                                </div>
                                <div>
                                    <a :href="pharmacy.orderLink"
                                        class="badge theme-bg-color text-white rounded-pill px-3 py-2 fs-12">
                                        <i class="fa fa-shopping-cart me-2"></i>
                                        <span>Order Medicine</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <Pagination :currentPage="currentPage" :totalPages="totalPages" @page-change="handlePageChange" />

            <div v-if="pharmacies.length == 0">
                <WarningMessage class="mt-4" message="Pharmacies not available!" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Pagination from '../components/Pagination.vue';
import WarningMessage from '../components/WarningMessage.vue';

export default {
    data() {
        return {
            searchQuery: '',
            pharmacies: [],
            currentPage: 1,
            totalPages: 1,
            perPage: 18
        };
    },
    components: {
        Pagination,
        WarningMessage
    },
    methods: {
        async searchPharmacies(page = 1) {
            try {
                const response = await axios.get('/api/pharmacies', {
                    params: {
                        search: this.searchQuery,
                        page,
                        perPage: this.perPage
                    }
                });

                this.pharmacies = response.data.data;
                this.totalPages = response.data.meta.last_page || 1;
                this.currentPage = page;
            } catch (error) {
                console.error('Error fetching pharmacies:', error);
            }
        },
        handlePageChange(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
            this.searchPharmacies();
        },
    },
    created() {
        this.searchPharmacies(); // Initial fetch
    }
};
</script>
<style>
.search-btn {
    z-index: 99999!important;
}
</style>