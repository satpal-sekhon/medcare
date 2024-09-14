import { createApp } from 'vue';
import ProductItem from './components/products/ProductItem.vue';

import GenericProducts from './pages/products/GenericProducts.vue';
import Products from './pages/products/Products.vue';

import MiniCart from './components/cart/MiniCart.vue';

// Create Vue application instance
const app = createApp({});

app.component('product-item', ProductItem);
app.component('generic-products', GenericProducts);
app.component('products', Products);
app.component('mini-cart', MiniCart);

// Mount Vue instance to a DOM element
app.mount('#vue-components');
