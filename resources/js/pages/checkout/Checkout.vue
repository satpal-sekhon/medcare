<template>
    <div class="row g-sm-4 g-3">
        <div class="col-lg-8">
            <div class="left-sidebar-checkout">
                <div class="checkout-detail-box">
                    <ul>
                        <li v-for="(step, index) in steps" :key="index">
                            <div class="checkout-icon">
                                <lord-icon :src="step.iconSrc" trigger="loop-on-hover" :colors="step.iconColors"
                                    class="lord-icon" :aria-label="step.ariaLabel"></lord-icon>
                            </div>
                            <component :is="step.component" :step="step" v-bind="getComponentProps(step.component)"
                                @continue="handleSubmit(index, $event)" @on-edit="setStepState(index)" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <OrderSummary />
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import DeliveryAddress from './DeliveryAddress.vue';
import DeliveryOptions from './DeliveryOptions.vue';
import OrderSummary from './OrderSummary.vue';
import PaymentOptions from './PaymentOptions.vue';

export default {
    name: 'Checkout',
    components: {
        DeliveryAddress,
        DeliveryOptions,
        PaymentOptions,
        OrderSummary
    },
    data() {
        return {
            steps: [
                {
                    component: 'DeliveryAddress',
                    iconSrc: '/assets/js/checkout/ggihhudh.json',
                    iconColors: 'primary:#121331,secondary:#646e78,tertiary:#0baf9a',
                    ariaLabel: 'Delivery Address Icon',
                    isActive: true,
                    isDisabled: false,
                    isCompleted: false
                },
                {
                    component: 'DeliveryOptions',
                    iconSrc: '/assets/js/checkout/oaflahpk.json',
                    iconColors: 'primary:#0baf9a',
                    ariaLabel: 'Delivery Options Icon',
                    isActive: false,
                    isDisabled: true,
                    isCompleted: false
                },
                {
                    component: 'PaymentOptions',
                    iconSrc: '/assets/js/checkout/qmcsqnle.json',
                    iconColors: 'primary:#0baf9a,secondary:#0baf9a',
                    ariaLabel: 'Payment Options Icon',
                    isActive: false,
                    isDisabled: true,
                    isCompleted: false
                }
            ],
            deliveryAddress: {},
            selectedDeliveryMethod: {},
            selectedPaymentMethod: ''
        };
    },
    methods: {
        getComponentProps(componentName) {
            switch (componentName) {
                case 'DeliveryAddress':
                    return { address: this.deliveryAddress };
                case 'DeliveryOptions':
                    return { deliveryMethod: this.selectedDeliveryMethod };
                case 'PaymentOptions':
                    return {
                        paymentOptions: [
                            { id: 'cash', label: 'Cash On Delivery', description: 'You can pay when you receive the order' },
                            /* { id: 'credit', label: 'Credit Card', description: 'Pay with your credit card securely' },
                            { id: 'paypal', label: 'PayPal', description: 'Pay using your PayPal account' }, */
                        ]
                    };
                default:
                    return {};
            }
        },
        handleSubmit(index, data) {
            const step = this.steps[index];

            switch (step.component) {
                case 'DeliveryAddress':
                    this.handleCustomerAddress(data);
                    break;
                case 'DeliveryOptions':
                    this.handleDeliveryOptions(data);
                    break;
                case 'PaymentOptions':
                    this.handlePayment(data);
                    break;
            }

            if (index !== (this.steps.length - 1)) {
                this.setStepState(index + 1);
            } else {
                this.placeOrder()
            }

        },
        handleCustomerAddress(address) {
            this.deliveryAddress = address;
        },
        handleDeliveryOptions(selectedMethod) {
            this.selectedDeliveryMethod = selectedMethod;
        },
        handlePayment(selectedMethod) {
            this.selectedPaymentMethod = selectedMethod;
        },
        async placeOrder() {
            try {
                const response = await axios.post('/orders/create', {
                    deliveryAddress: this.deliveryAddress,
                    selectedDeliveryMethod: this.selectedDeliveryMethod,
                    selectedPaymentMethod: this.selectedPaymentMethod
                });

                // Handle success response
                console.log('Order placed successfully:', response.data);

            } catch (error) {
                console.error('Failed to place order:', error.response?.data || error.message);
            }
        },
        setStepState(index) {
            this.steps.forEach((step, i) => {
                step.isActive = i === index;
                step.isDisabled = i > index;
                step.isCompleted = i < index;
            });
        }
    }
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>