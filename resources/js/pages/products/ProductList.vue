<template>
  <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
    <div v-for="(product, index) in products" :key="index">
      <div class="product-box-3 h-100 wow fadeInUp" :data-wow-delay="product.delay">
        <div class="product-header">
          <div class="product-image">
            <a :href="product.link">
              <img :src="product.image" class="img-fluid blur-up lazyload" :alt="product.name">
            </a>

            <ul class="product-option">
              <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                  <i data-feather="eye"></i>
                </a>
              </li>
              <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                <a href="compare.html">
                  <i data-feather="refresh-cw"></i>
                </a>
              </li>
              <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                <a href="wishlist.html" class="notifi-wishlist">
                  <i data-feather="heart"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="product-footer">
          <div class="product-detail">
            <span class="span-name">{{ product.category }}</span>
            <a :href="product.link">
              <h5 class="name">{{ product.name }}</h5>
            </a>
            <p class="text-content mt-1 mb-2 product-content">{{ product.description }}</p>
            <div class="product-rating mt-2">
              <ul class="rating">
                <li v-for="n in product.rating" :key="n">
                  <i data-feather="star" class="fill"></i>
                </li>
                <li v-if="product.rating < 5">
                  <i data-feather="star"></i>
                </li>
              </ul>
              <span>({{ product.ratingValue }})</span>
            </div>
            <h6 class="unit">{{ product.unit }}</h6>
            <h5 class="price">
              <span class="theme-color">{{ product.price }}</span>
              <del>{{ product.originalPrice }}</del>
            </h5>
            <div class="add-to-cart-box bg-white">
              <button class="btn btn-add-cart addcart-button">Add
                <span class="add-icon bg-light-gray">
                  <i class="fa-solid fa-plus"></i>
                </span>
              </button>
              <div class="cart_qty qty-box">
                <div class="input-group bg-white">
                  <button type="button" class="qty-left-minus bg-gray" data-type="minus" data-field="">
                    <i class="fa fa-minus"></i>
                  </button>
                  <input class="form-control input-number qty-input" type="text" name="quantity" value="0">
                  <button type="button" class="qty-right-plus bg-gray" data-type="plus" data-field="">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductList',
  data() {
    return {
      products: [
        {
          image: '../assets/images/cake/product/2.png',
          link: 'product-left-thumbnail.html',
          name: 'Fresh Bread and Pastry Flour 200 g',
          category: 'Vegetable',
          description: 'Cheesy feet cheesy grin brie. Mascarpone cheese and wine hard cheese the big cheese everyone loves smelly cheese macaroni cheese croque monsieur.',
          rating: 4,
          ratingValue: '4.0',
          unit: '250 ml',
          price: '$08.02',
          originalPrice: '$15.15',
          delay: '0s'
        },
        {
          image: '../assets/images/cake/product/3.png',
          link: 'product-left-thumbnail.html',
          name: 'Peanut Butter Bite Premium Butter Cookies 600 g',
          category: 'Vegetable',
          description: 'Feta taleggio croque monsieur swiss manchego cheesecake dolcelatte jarlsberg. Hard cheese danish fontina boursin melted cheese fondue.',
          rating: 2,
          ratingValue: '2.4',
          unit: '350 G',
          price: '$04.33',
          originalPrice: '$10.36',
          delay: '0.05s'
        }
      ]
    };
  }
};
</script>