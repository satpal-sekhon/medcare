import { createApp } from 'vue';
import ProductItem from './components/products/ProductItem.vue';

import GenericProducts from './pages/products/GenericProducts.vue';
import Products from './pages/products/Products.vue';

import MiniCart from './components/cart/MiniCart.vue';
import QuantityBox from './components/cart/QuantityBox.vue';
import PharmacyShops from './pages/PharmacyShops.vue';
import Cart from './pages/Cart.vue';

// Create Vue application instance
const app = createApp({});

app.component('product-item', ProductItem);
app.component('generic-products', GenericProducts);
app.component('pharmacy-shops', PharmacyShops);

app.component('products', Products);
app.component('mini-cart', MiniCart);
app.component('quantity-box', QuantityBox);
app.component('cart', Cart);

// Mount Vue instance to a DOM element
app.mount('#vue-components');
