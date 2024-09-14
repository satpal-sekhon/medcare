import { createApp } from 'vue';
import ProductList from './components/products/ProductList.vue';
import ProductItem from './components/products/ProductItem.vue';

import GenericProducts from './pages/GenericProducts.vue';

import MiniCart from './components/cart/MiniCart.vue';

// Create Vue application instance
const app = createApp({});
app.config.globalProperties.$appUrl = window.App.baseUrl;

app.component('product-list', ProductList);
app.component('product-item', ProductItem);
app.component('generic-products', GenericProducts);
app.component('mini-cart', MiniCart);

// Mount Vue instance to a DOM element
app.mount('#vue-components');
