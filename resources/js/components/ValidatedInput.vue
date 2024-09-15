<template>
    <div class="validated-input">
      <label :for="id">{{ label }}</label>
      <input
        :id="id"
        :value="modelValue"
        :type="type"
        :placeholder="placeholder"
        @input="updateValue($event)"
        @blur="validate"
        class="form-control"
      />
      <span v-if="error" class="error-message">{{ error }}</span>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ValidatedInput',
    props: {
      id: {
        type: String,
        required: true
      },
      label: {
        type: String,
        default: ''
      },
      modelValue: {
        type: [String, Number],
        default: ''
      },
      type: {
        type: String,
        default: 'text'
      },
      placeholder: {
        type: String,
        default: ''
      },
      rules: {
        type: Object,
        default: () => ({})
      }
    },
    data() {
      return {
        error: ''
      };
    },
    methods: {
      updateValue(event) {
        this.$emit('update:modelValue', event.target.value);
      },
      validate() {
        this.error = '';
  
        // Perform validation
        for (const [rule, validationFn] of Object.entries(this.rules)) {
          const result = validationFn(this.modelValue);
          if (result !== true) {
            this.error = result;
            break;
          }
        }
  
        // Emit event if validation passes or fails
        this.$emit('validation', this.error);
      }
    }
  };
  </script>
  
  <style scoped>
  .validated-input {
    margin-bottom: 1em;
  }
  
  .error-message {
    color: red;
    font-size: 0.875em;
  }
  </style>
  