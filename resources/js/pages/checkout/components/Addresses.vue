<template>
    <div class="row g-4">
        <div class="col-xxl-6 col-lg-12 col-md-6">
            <div class="delivery-address-box" v-for="address in addresses">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="address" v-model="selectedAddressId"
                            @change="updateForm(address)" :value="address.id" :id="`address${address.id}`" :key="address.id">
                    </div>

                    <div class="label">
                        <label>{{ address.address_type }}</label>
                    </div>

                    <ul class="delivery-address-detail">
                        <li>
                            <h4 class="fw-500"><label :for="`address${address.id}`">{{ address.name }}</label></h4>
                        </li>

                        <li>
                            <p class="text-content"><span class="text-title">Address :</span>
                                {{ address.address_line_1 }}
                            </p>
                        </li>

                        <li>
                            <h6 class="text-content"><span class="text-title">Pin Code :</span> {{ address.pincode }}
                            </h6>
                        </li>

                        <li>
                            <h6 class="text-content mb-0">
                                <span class="text-title">Phone :</span>
                                {{ address.phone_number }}
                            </h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <button type="button" :disabled="!selectedAddressId" @click="proceedWithSelectedAddress" class="btn theme-bg-color text-white btn-md w-25 mt-4 fw-bold">
        Continue
    </button>
</template>

<script>
export default {
    name: 'Addresses',
    props: {
        addresses: {
            type: Array,
            required: true
        }
    },
    emits: ['submit'],
    data() {
        return {
            selectedAddressId: null,
            form: {
                customerName: '',
                addressLine1: '',
                addressLine2: '',
                pinCode: '',
                phone: '',
                email: '',
                state: '',
                instructions: ''
            },
        }
    },
    methods: {
        updateForm(selectedAddress) {
            this.form.customerName = selectedAddress.name;
            this.form.addressLine1 = selectedAddress.address_line_1;
            this.form.addressLine2 = selectedAddress.address_line_2 || '';
            this.form.pinCode = selectedAddress.pincode;
            this.form.phone = selectedAddress.phone_number;
            this.form.email = selectedAddress.email || window.appData.user_email || '';
            this.form.state = selectedAddress.state || '';
            this.form.instructions = selectedAddress.instructions || '';
        },
        proceedWithSelectedAddress(){
            this.$emit('submit', this.form);
        }
    }
}
</script>

<style scoped>
/* Add your scoped styles here */
</style>
