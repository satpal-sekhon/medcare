<template>
    <nav class="custom-pagination" v-if="totalPages > 1">
        <ul class="pagination justify-content-center">
            <!-- Previous Button -->
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link" href="javascript:void(0)" :aria-disabled="currentPage === 1"
                    @click="changePage(currentPage - 1)">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
            </li>

            <!-- First Page Button -->
            <li v-if="showFirstPage" class="page-item">
                <a class="page-link" :href="getPageUrl(1)" @click.prevent="changePage(1)">
                    1
                </a>
            </li>

            <!-- Ellipsis for hidden pages before the current view -->
            <li v-if="showEllipsisBefore" class="page-item disabled">
                <span class="page-link">...</span>
            </li>

            <!-- Dynamic Page Numbers -->
            <li v-for="pageNumber in visiblePageNumbers" :key="pageNumber"
                :class="{ 'page-item': true, active: pageNumber === currentPage }">
                <a class="page-link" :href="getPageUrl(pageNumber)" @click.prevent="changePage(pageNumber)">
                    {{ pageNumber }}
                </a>
            </li>

            <!-- Ellipsis for hidden pages after the current view -->
            <li v-if="showEllipsisAfter" class="page-item disabled">
                <span class="page-link">...</span>
            </li>

            <!-- Last Page Button -->
            <li v-if="showLastPage" class="page-item">
                <a class="page-link" :href="getPageUrl(totalPages)" @click.prevent="changePage(totalPages)">
                    {{ totalPages }}
                </a>
            </li>

            <!-- Next Button -->
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <a class="page-link" href="javascript:void(0)" :aria-disabled="currentPage === totalPages"
                    @click="changePage(currentPage + 1)">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        currentPage: {
            type: Number,
            required: true
        },
        totalPages: {
            type: Number,
            required: true
        },
        maxPagesToShow: {
            type: Number,
            default: 5
        }
    },
    computed: {
        visiblePageNumbers() {
            const pages = [];
            const { currentPage, totalPages, maxPagesToShow } = this;

            if (totalPages <= maxPagesToShow) {
                // Show all pages if there are fewer pages than maxPagesToShow
                for (let i = 1; i <= totalPages; i++) {
                    pages.push(i);
                }
            } else {
                // Calculate start and end pages to show around the current page
                const halfMaxPages = Math.floor(maxPagesToShow / 2);
                let startPage, endPage;

                if (currentPage <= halfMaxPages) {
                    startPage = 1;
                    endPage = maxPagesToShow;
                } else if (currentPage + halfMaxPages >= totalPages) {
                    startPage = totalPages - maxPagesToShow + 1;
                    endPage = totalPages;
                } else {
                    startPage = currentPage - halfMaxPages;
                    endPage = currentPage + halfMaxPages;
                }

                for (let i = startPage; i <= endPage; i++) {
                    pages.push(i);
                }
            }

            return pages;
        },
        showFirstPage() {
            return this.currentPage > Math.ceil(this.maxPagesToShow / 2);
        },
        showLastPage() {
            return this.currentPage < this.totalPages - Math.floor(this.maxPagesToShow / 2);
        },
        showEllipsisBefore() {
            return this.currentPage > Math.ceil(this.maxPagesToShow / 2) + 1;
        },
        showEllipsisAfter() {
            return this.currentPage < this.totalPages - Math.floor(this.maxPagesToShow / 2);
        }
    },
    methods: {
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.$emit('page-change', page);
            }
        },
        getPageUrl(pageNumber) {
            // Modify this method to return the appropriate URL for each page
            return `?page=${pageNumber}`;
        }
    }
};
</script>