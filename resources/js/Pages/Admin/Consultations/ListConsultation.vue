<template>
  
</template>

<script setup>
import EasyDataTable  from "vue3-easy-data-table";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";


defineProps({
    items: Object,
    headers: Object,
    rowPerPage: Number,
});

</script>
