<template>
    <div class="search-container">
        <input 
            type="text" 
            id="searchInput" 
            placeholder="Search for medicines..." 
            v-model="searchKeyword"
            @keydown.enter="handleSearch"
            aria-label="Search for medicines"
        />
        <button 
            id="searchButton" 
            @click="handleSearch"
            aria-label="Search"
        >
            Search
        </button>
    </div>

    <div class="alphabet-container">
        <a 
            href="javascript:void(0)" 
            v-for="letter in alphabet" 
            :key="letter" 
            @click="handleAlphabetChange(letter)"
            :class="{ active: selectedAlphabet === letter }"
            aria-current="selectedAlphabet === letter ? 'true' : 'false'"
        >
            {{ letter }}
        </a>
    </div>

    <div class="resde d-block d-md-none">
        <div class="alphabet-dropdown">
            <select 
                class="form-control" 
                :value="selectedAlphabet" 
                @change="handleDropdownChange"
                aria-label="Select a letter"
            >
                <option value="" disabled>Select a letter</option>
                <option v-for="letter in alphabet" :key="letter" :value="letter">
                    {{ letter }}
                </option>
            </select>
        </div>
    </div>

    <div class="medicine-list ms-4 mt-3">
        <GenericProductList 
            :searchQuery="searchQuery" 
            :selectedAlphabet="selectedAlphabet" 
            :currentPage="currentPage"
            @page-change="handlePageChange" 
        />
    </div>
</template>

<script>
import GenericProductList from './GenericProductList.vue';

export default {
    components: {
        GenericProductList,
    },
    data() {
        return {
            alphabet: Array.from({ length: 26 }, (_, i) => String.fromCharCode(65 + i)),
            selectedAlphabet: 'A',
            searchKeyword: '',
            searchQuery: '',
            currentPage: 1,
        };
    },
    methods: {
        handleSearch() {
            this.searchQuery = this.searchKeyword;
            this.currentPage = 1; // Reset to first page on search
            this.updateUrl();
        },
        handleAlphabetChange(letter) {
            this.selectedAlphabet = letter;
            this.currentPage = 1; // Reset to first page on alphabet change
            this.updateUrl();
        },
        handleDropdownChange(event) {
            this.selectedAlphabet = event.target.value;
            this.currentPage = 1; // Reset to first page on alphabet change
            this.updateUrl();
        },
        handlePageChange(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
            this.updateUrl();
        },
        updateUrl() {
            const queryParams = new URLSearchParams({
                letter: this.selectedAlphabet,
                search: this.searchQuery,
                page: this.currentPage
            });
            window.history.replaceState({}, '', `${window.location.pathname}?${queryParams}`);
        },
        initializeParams() {
            const queryParams = new URLSearchParams(window.location.search);
            this.selectedAlphabet = queryParams.get('letter') || 'A';
            this.searchQuery = queryParams.get('search') || '';
            this.currentPage = parseInt(queryParams.get('page'), 10) || 1;

            this.searchKeyword = this.searchQuery;
        }
    },
    created() {
        this.initializeParams();
    }
};
</script>


<style scoped>
.search-container {
    margin: 20px;
    text-align: center;
}

.search-container input[type="text"] {
    padding: 10px;
    font-size: 16px;
    width: 80%;
    max-width: 500px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.search-container button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    background-color: #28a745;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    margin-left: 10px;
}

.search-container button:hover {
    background-color: #218838;
}

/* Alphabet tabs */
.alphabet-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 20px;
    background: #00cea7;
    border-radius: 5px;
    padding: 5px 0px;
}

.alphabet-container a {
    padding: 8px 10px;
    margin: 5px;
    cursor: pointer;
    background-color: #fff;
    color: #000;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.alphabet-container a.active {
    background-color: #000;
    color: white;
}

/* Medicine list */
.medicine-list h2 {
    font-size: 24px;
    margin: 10px 0;
}

.composition {
    font-size: 14px;
    font-style: italic;
    color: #00614e;

}

.search-results {
    margin: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    display: none;
}

.search-results h2 {
    font-size: 22px;
    color: #333;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 18px;
    color: #333;
    background-color: #ddd;
    border: none;
    padding: 5px 10px;
    border-radius: 50%;
}

.close-btn:hover {
    background-color: #bbb;
}

/* Responsive for mobile view */
@media (max-width: 768px) {
    .alphabet-container {
        display: none;
    }

    #alphabetDropdown {
        display: block;
        width: 100%;
        padding: 10px;
        margin: 10px auto;
        font-size: 18px;
    }
}
</style>