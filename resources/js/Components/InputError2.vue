<script setup>
import { useToast } from 'vue-toast-notification';

defineProps({
  message: String,
});
</script>

<template>
  <div v-show="message">
    <!-- <p class="text-sm text-red-600">
            {{ message }}
        </p> -->
{{        useToast().error('Assurance Modifier', { position: 'bottom-right', duration: 3000 })
}}
  </div>
</template>
