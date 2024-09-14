<template>
    <div v-if="message" :class="['alert alert-warning alert-dismissible fade show', customClass]" role="alert">
      {{ message }}
    </div>
  </template>
  
  <script>
  export default {
    name: 'WarningMessage',
    props: {
      message: {
        type: String,
        default: ''
      },
      customClass: {
        type: String,
        default: ''
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add any specific styles here if needed */
  </style>
  