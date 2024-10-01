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
import UploadPrescription from './UploadPrescription.vue';

export default {
    name: 'Checkout',
    components: {
        DeliveryAddress,
        DeliveryOptions,
        UploadPrescription,
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
                /* {
                    component: 'DeliveryOptions',
                    iconSrc: '/assets/js/checkout/oaflahpk.json',
                    iconColors: 'primary:#0baf9a',
                    ariaLabel: 'Delivery Options Icon',
                    isActive: false,
                    isDisabled: true,
                    isCompleted: false
                }, */
            ],
            deliveryAddress: {},
            selectedDeliveryMethod: {},
            selectedPaymentMethod: '',
            isSubmitting: false,
            transactionId: ''
        };
    },
    methods: {
        getComponentProps(componentName) {
            const propsMap = {
                'DeliveryAddress': { address: this.deliveryAddress },
                //'DeliveryOptions': { deliveryMethod: this.selectedDeliveryMethod },
                'UploadPrescription': { deliveryMethod: this.selectedDeliveryMethod },
                'PaymentOptions': {
                    isSubmitting: this.isSubmitting,
                    address: this.deliveryAddress,
                    paymentOptions: [
                        { id: 'cash', label: 'Cash On Delivery', description: 'You can pay when you receive the order' },
                        { id: 'razorpay', label: 'Pay Online (UPI | Credit & Debit Card | Net Banking )', description: 'Pay with multile payment methods' },
                        //{ id: 'paytm', label: 'PayTM', description: 'Pay with india\'s most trustworthy app' },
                    ]
                }
            };
            return propsMap[componentName] || {};
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
                case 'UploadPrescription':
                    this.handlePrescription(data);
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
        handlePrescription(data){
            this.prescriptionMethod = data;
        },
        handlePayment(selectedMethod) {
            this.selectedPaymentMethod = selectedMethod;
            this.transactionId = selectedMethod.txn_id ? selectedMethod.txn_id : ''
        },
        async placeOrder() {
            try {
                this.isSubmitting = true;
                    
                const formData = new FormData();
                formData.append('deliveryAddress', JSON.stringify(this.deliveryAddress));
                formData.append('selectedDeliveryMethod', JSON.stringify(this.selectedDeliveryMethod));
                formData.append('selectedPaymentMethod', this.selectedPaymentMethod);
                formData.append('transactionId', this.transactionId);

                if(this.prescriptionMethod.files && this.prescriptionMethod.files.length > 0){
                    Array.from(this.prescriptionMethod.files).forEach(file => {
                        formData.append('prescriptions[]', file);
                    });
                }

                const response = await axios.post('/orders/create', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                this.isSubmitting = false;

                if (response.data.success && response.data.success === true) {
                    window.location = '/order-success';
                }
            } catch (error) {
                console.error('Failed to place order:', error.response?.data || error.message);
                this.isSubmitting = false;
            }
        },
        setStepState(index) {
            this.steps.forEach((step, i) => {
                step.isActive = i === index;
                step.isDisabled = i > index;
                step.isCompleted = i < index;
            });
        }
    },
    mounted() {
        this.steps.push({
            component: 'UploadPrescription',
            iconSrc: '/assets/js/checkout/animated-document.json',
            iconColors: 'primary:#0baf9a',
            ariaLabel: 'Upload Prescription',
            isActive: false,
            isDisabled: true,
            isCompleted: false
        });

        this.steps.push({
            component: 'PaymentOptions',
            iconSrc: '/assets/js/checkout/qmcsqnle.json',
            iconColors: 'primary:#0baf9a,secondary:#0baf9a',
            ariaLabel: 'Payment Options Icon',
            isActive: false,
            isDisabled: true,
            isCompleted: false
        });
    }
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>