import { createApp } from 'vue';
import ProductList from './components/products/ProductList.vue';
import ProductItem from './components/products/ProductItem.vue';
import MiniCart from './components/cart/MiniCart.vue';

// Create Vue application instance
const app = createApp({});

app.component('product-list', ProductList);
app.component('product-item', ProductItem);
app.component('mini-cart', MiniCart);

// Mount Vue instance to a DOM element
app.mount('#vue-components');
