<template>
    <div class="form-group col-md-6 col-lg-4">
        <input type="text" placeholder="Recherche..." class="form-control" id="cno" v-model="searchValue">
    </div>
    <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
        :search-field="searchField" :rows-per-page="4" @click-row="showRow">
        <template #item-operation="item">
            <div class="row">
                <button @click.prevent="showRow(item)" class="btn btn-secondary m-2"><i class="ri-eye-line"></i></button>
            </div>
        </template>
    </EasyDataTable>
</template>

<script setup >
import EasyDataTable from 'vue3-easy-data-table';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
const searchValue = ref("");
const searchField = ref(["cinPatient", "nomPatient", "prenomPatient", "villePatient"]);
defineProps({
    items: Object,
})

//Headers Easy-DataTable
const headers = [
    { text: "CIN", value: "cinPatient", sortable: true },
    { text: "Nom", value: "nomPatient", sortable: true },
    { text: "Prénom", value: "prenomPatient", sortable: true },
    { text: "Date Naissance", value: "dateNaissancePatient", sortable: true },
    { text: "Adresse", value: "villePatient", sortable: true },
    { text: "Opérations", value: "operation", sortable: true },
];

const showRow = (item) => {
    router.get(route("patients.show", item));
};




</script>

