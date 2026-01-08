<script setup>
import Form from './Form.vue';

defineProps({
    plan: Object,
});
</script>

<template>
    <Form :plan="plan" />
</template>
