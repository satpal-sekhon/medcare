<template>
    <div class="checkout-box">
        <div class="checkout-title">
            <h4>Upload Prescription</h4>

            <a href="javascript:void(0)" v-if="!step.isActive && step.isCompleted" @click="editThisStep">Edit</a>
        </div>

        <div class="checkout-detail" v-if="step.isActive">
            <WarningMessage message="One or more products require precription" />
            <div class="row g-4">
                <div class="col-xxl-6" v-for="method in prescriptionMethods" :key="method.id">
                    <div class="delivery-option">
                        <div class="delivery-category">
                            <div class="shipment-detail">
                                <div class="form-check custom-form-check"
                                    :class="{ 'hide-check-box': method.value === 'uploadPrescription', 'show-box-checked': method.value === 'consultDoctor' }">
                                    <input class="form-check-input" type="radio" :name="method.name" :id="method.id"
                                        :value="method.value" v-model="selectedMethodValue">
                                    <label class="form-check-label" :for="method.id">{{ method.label }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2" v-if="prescriptionRequired">
                <div class="col-12">
                    <input type="file" name="prescription" id="prescription" ref="prescriptionInput" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" @change="handleFileChange" multiple>
                </div>
            </div>

            <button class="btn theme-bg-color text-white btn-md w-25 mt-4 fw-bold" :disabled="!selectedMethodObject.id || (selectedMethodObject.id==='uploadPrescription' && !selectedFiles.length)" @click="submitForm">
                Continue
            </button>
        </div>
        <div v-if="step.isCompleted && $refs.prescriptionInput">
            {{ $refs.prescriptionInput.files.length }} prescriptions uploaded
        </div>
    </div>
</template>

<script>
import WarningMessage from '../../components/WarningMessage.vue';

export default {
    name: 'UploadPrescription',
    props: {
        step: {
            type: Object,
            default: () => ({}),
        },
        prescriptionMethod: {
            type: Object,
            default: () => ({}),
        }
    },
    components:{
        WarningMessage      
    },
    data() {
        return {
            prescriptionMethods: [
                { id: 'uploadPrescription', name: 'uploadPrescription', label: 'Upload Prescription', value: 'uploadPrescription' },
                { id: 'consultDoctor', name: 'consultDoctor', label: 'Consult Doctor', value: 'consultDoctor' }
            ],
            selectedMethodValue: '',
            selectedMethodObject: {},
            prescriptionRequired: false,
            selectedFiles: []
        }
    },
    watch: {
        selectedMethodValue(newValue) {
            if (newValue) {
                this.prescriptionRequired = newValue === 'uploadPrescription';

                this.selectedMethodObject = this.prescriptionMethods.find(method => method.value === newValue);
            }
        }
    },
    methods: {
        submitForm() {
            if (this.selectedMethodObject) {
                if(this.selectedMethodObject.value==='uploadPrescription'){
                    const files = this.$refs.prescriptionInput.files;
                    this.selectedMethodObject.files = files;
                } else {
                    window.location = '/doctors';
                }

                this.$emit('continue', this.selectedMethodObject);
            }
        },
        handleFileChange() {
            const files = this.$refs.prescriptionInput.files;
            this.selectedFiles = files;
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
