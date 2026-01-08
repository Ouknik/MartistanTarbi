<template>
    <div class="form-group col-md-6 col-lg-4">
        <input type="text" class="form-control" placeholder="search value:" id="cno" v-model="searchValue">
    </div>
    <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
        :search-field="searchField" :rows-per-page="5" @click-row="showRow"  alternating>
        <template #item-operation="item">
            <div class="row">
                <button @click="showRow(item)" class="btn btn-info m-2"><i class="ri-eye-line"></i></button>
            </div>
        </template>
        <template #empty-message>
            <a href="">Aucun rendez-vous pour ce patient</a>
        </template>
    </EasyDataTable>
</template>

<script setup>
import EasyDataTable from 'vue3-easy-data-table';
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
const searchValue = ref("");
const searchField = ref(["nomPatient", "cinPatient"]);
defineProps({
    items: Object,
    headers: Object,
})

const showRow = (item) => {
    router.get(
        route('ordonnances.show', item)
    )
};




</script>
<script>
</script>
<style></style>
