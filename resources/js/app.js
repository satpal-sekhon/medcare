// resources/js/app.js
import { createApp } from 'vue';
import ProductList from './components/ProductList.vue';

// Create Vue application instance
const app = createApp({});

// Register components globally
app.component('product-list', ProductList);

// Mount Vue instance to a DOM element
app.mount('#products-list');
