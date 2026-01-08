<script setup>
defineProps({
  message: String,
});
</script>

<template>
  <div v-show="message">
    <div class="alert alert-danger" role="alert">
       <p>{{ message }}</p>
    </div>
  </div>
</template>
