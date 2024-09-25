<template>
    <div class="checkout-box">
        <div class="checkout-title">
            <h4>Delivery Address</h4>

            <a href="javascript:void(0)" v-if="!step.isActive" @click="editThisStep">Edit</a>
        </div>

        <div class="checkout-detail" v-if="step.isActive">
            <div v-if="addresses && addresses.length > 0 && enterNewAddress">
                <a href="javascript:void(0)" @click="useSavedAddress">Use a saved address</a>
            </div>
            
            <div v-if="!addresses || addresses.length===0 || enterNewAddress">
                <DeliveryAddressForm :address="address" @submit="handleFormSubmit" />
            </div>
            <div v-else>
                <Addresses @submit="handleFormSubmit" :selectedPrevAddressId="address.addressId" :addresses="addresses" @enter-new-address="userNewAddress" />
            </div>
        </div>
        <div class="checkout-detail" v-else>
            <div class="delivery-address-box">
                <div>
                    <ul class="delivery-address-detail">
                        <li>
                            <h4 class="fw-500">{{ address.customerName }}</h4>
                        </li>

                        <li>
                            <p class="text-content">
                                <span class="text-title">Address :</span>
                                {{ address.addressLine1 }}
                            </p>
                        </li>

                        <li>
                            <h6 class="text-content">
                                <span class="text-title">Pin Code :</span>
                                {{ address.pinCode }}
                            </h6>
                        </li>

                        <li>
                            <h6 class="text-content mb-0">
                                <span class="text-title">Phone :</span>
                                {{ address.phone }}
                            </h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Addresses from './components/Addresses.vue';
import DeliveryAddressForm from './components/DeliveryAddressForm.vue';

export default {
    name: 'DeliveryAddress',
    props: {
        step: {
            type: Object,
            default: {},
        },
        address: {
            type: Object,
            default: {},
        }
    },
    components: {
        DeliveryAddressForm,
        Addresses
    },
    data() {
        return {
            addresses: null,
            enterNewAddress: false
        }
    },
    methods: {
        handleFormSubmit(billingAddress) {
            if (billingAddress.customerName) {
                this.$emit('continue', billingAddress);
            }
        },
        editThisStep() {
            this.$emit('on-edit');
        },
        userNewAddress(){
            this.enterNewAddress = true;
        },
        useSavedAddress(){
            this.enterNewAddress = false;
        }
    },
    mounted() {
        this.addresses = window.appData.addresses;
    }
};
</script>