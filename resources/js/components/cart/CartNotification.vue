<template>
    <div class="cart-notification">
        <div class="cart-notification-content">
            <img :src="`/${product.image}`" alt="Product Image" class="product-image" />
            <div class="product-details">
                <p class="product-name">{{ product.name }}</p>
                <a href="/cart" class="go-to-cart-button">Go to Cart</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CartNotification',
    props: {
        show: {
            type: Boolean,
            required: true
        },
        product: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>
.cart-notification {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 1px 2px 12px;
    padding: 15px;
    z-index: 1000;
    max-width: 80%;
    transition: opacity 0.3s ease;
    opacity: 1;
}

.cart-notification.fade-out {
    opacity: 0;
}


.cart-notification .cart-notification-content {
    display: flex;
    align-items: flex-start;
}

.cart-notification .product-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    margin-right: 10px;
}

.cart-notification .product-details {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.cart-notification .product-name {
    margin: 0;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
}

.cart-notification .go-to-cart-button {
    background-color: var(--theme-color);
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    text-align: center;
    width: fit-content;
}

.cart-notification .go-to-cart-button:hover {
    background-color: var(--theme-color);
}
</style>