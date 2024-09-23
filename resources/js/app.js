import { createApp } from 'vue';
import ProductItem from './components/products/ProductItem.vue';
import SearchBar from './components/SearchBar.vue';
import Wishlist from './components/Wishlist.vue';

import GenericProducts from './pages/products/GenericProducts.vue';
import Products from './pages/products/Products.vue';

import MiniCart from './components/cart/MiniCart.vue';
import QuantityBox from './components/cart/QuantityBox.vue';
import PharmacyShops from './pages/PharmacyShops.vue';
import Cart from './pages/Cart.vue';
import Checkout from './pages/checkout/Checkout.vue';
import CategoryProducts from './pages/products/CategoryProducts.vue';
import MediaLibrary from './pages/media/MediaLibrary.vue';
import WishlistPage from './pages/WishlistPage.vue';

// Create Vue application instance
const app = createApp({});

app.component('product-item', ProductItem);
app.component('search-bar', SearchBar);
app.component('generic-products', GenericProducts);
app.component('pharmacy-shops', PharmacyShops);
app.component('wishlist', Wishlist);
app.component('wishlist-page', WishlistPage);

app.component('products', Products);
app.component('category-products', CategoryProducts);
app.component('mini-cart', MiniCart);
app.component('quantity-box', QuantityBox);
app.component('cart', Cart);
app.component('checkout', Checkout);

app.component('media-library', MediaLibrary);

// Mount Vue instance to a DOM element
app.mount('#vue-components');
