<template>
    <div class="delivery-address-form">
        <form @submit.prevent="submitForm">
            <div class="row">
                <!-- Customer Name -->
                <div class="col-md-6 mb-2">
                    <label for="customerName">Customer Name</label>
                    <input type="text" id="customerName" v-model="form.customerName" class="form-control"
                        :class="{ 'is-invalid': errors.customerName }" />
                    <div v-if="errors.customerName" class="invalid-feedback">
                        {{ errors.customerName }}
                    </div>
                </div>

                
                <!-- Email -->
                <div class="col-md-6 mb-2">
                    <label for="email">Email</label>
                    <input type="email" id="email" v-model="form.email" class="form-control"
                        :class="{ 'is-invalid': errors.email }" />
                    <div v-if="errors.email" class="invalid-feedback">
                        {{ errors.email }}
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="col-md-6 mb-2">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" v-model="form.phone" class="form-control"
                        :class="{ 'is-invalid': errors.phone }" />
                    <div v-if="errors.phone" class="invalid-feedback">
                        {{ errors.phone }}
                    </div>
                </div>


                <!-- Address Line 1 -->
                <div class="col-md-6 mb-2">
                    <label for="addressLine1">Address Line 1</label>
                    <input type="text" id="addressLine1" v-model="form.addressLine1" class="form-control"
                        :class="{ 'is-invalid': errors.addressLine1 }" />
                    <div v-if="errors.addressLine1" class="invalid-feedback">
                        {{ errors.addressLine1 }}
                    </div>
                </div>

                <!-- Address Line 2 -->
                <div class="col-md-6 mb-2">
                    <label for="addressLine2">Address Line 2</label>
                    <input type="text" id="addressLine2" v-model="form.addressLine2" class="form-control" />
                </div>

                <!-- Pin Code -->
                <div class="col-md-6 mb-2">
                    <label for="pinCode">Pin Code</label>
                    <input type="number" id="pinCode" v-model="form.pinCode" class="form-control"
                        :class="{ 'is-invalid': errors.pinCode }" />
                    <div v-if="errors.pinCode" class="invalid-feedback">
                        {{ errors.pinCode }}
                    </div>
                </div>

                <!-- State -->
                <div class="col-md-6 mb-2">
                    <label for="state">State</label>
                    <select id="state" v-model="form.state" class="form-control"
                        :class="{ 'is-invalid': errors.state }">
                        <option value="" disabled>Select a state</option>
                        <option v-for="state in states" :key="state.id" :value="state.name">
                            {{ state.name }}
                        </option>
                    </select>
                    <div v-if="errors.state" class="invalid-feedback">
                        {{ errors.state }}
                    </div>
                </div>

                <!-- Instructions (Optional) -->
                <div class="col-md-12 mb-2">
                    <label for="instructions">Instructions (Optional)</label>
                    <textarea id="instructions" v-model="form.instructions" class="form-control"></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn theme-bg-color text-white btn-md w-25 mt-4 fw-bold">
                Continue
            </button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'DeliveryAddressForm',
    data() {
        return {
            form: {
                customerName: '',
                addressLine1: '',
                addressLine2: '',
                pinCode: '',
                phone: '',
                email: '',
                state: '',
                instructions: '' // Optional instructions field
            },
            errors: {},
            states: [] // Array to hold states data
        };
    },
    methods: {
        validateForm() {
            const errors = {};
            if (!this.form.customerName) {
                errors.customerName = 'Customer Name is required';
            }
            if (!this.form.addressLine1) {
                errors.addressLine1 = 'Address Line 1 is required';
            }
            if (!this.form.pinCode) {
                errors.pinCode = 'Pin Code is required';
            } else if (!/^\d{6}$/.test(this.form.pinCode)) {
                errors.pinCode = 'Pin Code must be a 6-digit number';
            }
            if (!this.form.phone) {
                errors.phone = 'Phone is required';
            } else if (!/^\+?\d{10}$/.test(this.form.phone)) {
                errors.phone = 'Phone number must be 10 digits';
            }
            if (!this.form.email) {
                errors.email = 'Email is required';
            } else if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(this.form.email)) {
                errors.email = 'Email must be valid';
            }
            if (!this.form.state) {
                errors.state = 'State is required';
            }
            this.errors = errors;
            return Object.keys(errors).length === 0;
        },
        submitForm(event) {
            event.preventDefault();

            if (this.validateForm()) {
                this.$emit('submit', this.form);
            }
        }
    },
    mounted() {
        this.states = window.appData.states;
    }
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>
