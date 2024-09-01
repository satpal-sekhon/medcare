import { createApp } from 'vue';
import ProductCardList from './components/ProductCardList.vue';

const productCardListComponent = createApp(ProductCardList);
productCardListComponent.mount('#products-card-list');
