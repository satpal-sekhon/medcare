<template>
    <div class="checkout-box">
        <div class="checkout-title">
            <h4>Delivery Option</h4>

            <a href="javascript:void(0)" v-if="!step.isActive && step.isCompleted" @click="editThisStep">Edit</a>
        </div>

        <div class="checkout-detail" v-if="step.isActive">
            <div class="row g-4">
                <div class="col-xxl-6" v-for="method in deliveryMethods" :key="method.id">
                    <div class="delivery-option">
                        <div class="delivery-category">
                            <div class="shipment-detail">
                                <div class="form-check custom-form-check"
                                    :class="{ 'hide-check-box': method.value === 'pickup', 'show-box-checked': method.value === 'delivery' }">
                                    <input class="form-check-input" type="radio" :name="method.name" :id="method.id"
                                        :value="method.value" v-model="selectedMethodValue">
                                    <label class="form-check-label" :for="method.id">{{ method.label }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn theme-bg-color text-white btn-md w-25 mt-4 fw-bold" :disabled="!this.selectedMethodObject.id" @click="submitForm">
                Continue
            </button>
        </div>

        <div v-if="step.isCompleted">
            {{ deliveryMethod.label }}
        </div>
    </div>
</template>

<script>
export default {
    name: 'DeliveryOptions',
    props: {
        step: {
            type: Object,
            default: () => ({}),
        },
        deliveryMethod: {
            type: Object,
            default: () => ({}),
        }
    },
    data() {
        return {
            deliveryMethods: [
                { id: 'pickup', name: 'deliveryOption', label: 'Pickup from Store', value: 'pickup' },
                { id: 'delivery', name: 'deliveryOption', label: 'Home Delivery', value: 'delivery' }
            ],
            selectedMethodValue: '',
            selectedMethodObject: {}
        }
    },
    watch: {
        selectedMethodValue(newValue) {
            if (newValue) {
                this.selectedMethodObject = this.deliveryMethods.find(method => method.value === newValue);
            }
        }
    },
    methods: {
        submitForm() {
            if (this.selectedMethodObject) {
                this.$emit('continue', this.selectedMethodObject);
            }
        },
        editThisStep() {
            this.$emit('on-edit');
        }
    }
}
</script>

<style scoped>
/* Add your scoped styles here */
</style>
