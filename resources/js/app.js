// resources/js/app.js
import { createApp } from 'vue';
import ProductList from './components/products/ProductList.vue';
import ProductItem from './components/products/ProductItem.vue';

// Create Vue application instance
const app = createApp({});

// Register components globally
app.component('product-list', ProductList);
app.component('product-item', ProductItem);

// Mount Vue instance to a DOM element
app.mount('#vue-components');
