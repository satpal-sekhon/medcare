<template>
    <div class="checkout-box">
        <div class="checkout-title">
            <h4>Payment Options</h4>
        </div>

        <div class="checkout-detail" v-if="step.isActive">
            <div class="accordion accordion-flush custom-accordion" id="accordionFlushExample">
                <div v-for="(option, index) in paymentOptions" :key="option.id" class="accordion-item">

                    <div class="accordion-header" :id="`flush-heading-${option.id}`">
                        <div class="accordion-button collapsed" :data-bs-toggle="'collapse'"
                            :data-bs-target="`#flush-collapse-${option.id}`" :aria-expanded="isExpanded(option.id)">
                            <div class="custom-form-check form-check mb-0">
                                <label class="form-check-label" :for="option.id">
                                    <input class="form-check-input mt-0" type="radio" :name="`paymentMethod`"
                                        :id="option.id" :value="option.id" v-model="selectedPaymentMethod">
                                    {{ option.label }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div :id="`flush-collapse-${option.id}`" class="accordion-collapse collapse"
                        :class="{ show: isExpanded(option.id) }" data-bs-parent="#accordionFlushExample"
                        aria-labelledby="flush-heading">
                        <div class="accordion-body">
                            <p class="cod-review">{{ option.description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn theme-bg-color text-white btn-md w-25 mt-4 fw-bold" :disabled="!this.selectedPaymentMethod || isSubmitting" @click="submitForm">
                Place Order
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { emit } from '../../eventBus';

export default {
    name: 'PaymentOptions',
    props: {
        step: {
            type: Object,
            default: {},
        },
        paymentOptions: {
            type: Array,
            default: () => [],
        },
        isSubmitting: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            selectedPaymentMethod: null
        };
    },
    watch: {
        selectedPaymentMethod(newMethod) {
            this.applyCharges(newMethod);
        }
    },
    methods: {
        isExpanded(id) {
            return this.selectedPaymentMethod === id;
        },
        async applyCharges(paymentMethod) {
            try {
                const response = await axios.post('/cart/apply-charges', {
                    paymentMethod: paymentMethod
                });

                let cartDetails = response.data.cart;
                emit('updated-cart-fetch', cartDetails);
            } catch (error) {
                console.error('Error applying charges:', error);
            }
        },
        submitForm() {
            if (this.selectedPaymentMethod) {
                this.$emit('continue', this.selectedPaymentMethod);
            }
        },
    }
}
</script>

<style scoped></style>
