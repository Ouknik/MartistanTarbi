<template>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="form-group col-md-6 col-lg-4">
                <input type="search" class="form-control" placeholder="Chercher Facture" id="cno" v-model="searchValue" />
            </div>
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="4" alternating table-class-name="customize-table">
                <template #item-montantFacture="item">
                    {{ item.montantFacture }}  DH
                </template>
                <template #empty-message>
                    <span class="text-danger">  Aucune Facture Pour Ce Patient</span>
                </template>
            </EasyDataTable>
        </div>
    </div>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { ref } from "vue";
//Reference
const searchValue = ref("");
const searchField = ref(["id"]);
//Define Props
const props = defineProps({
    items: Object,
});
//Headers Easy-DataTable
const headers = [
    { text: "N°", value: "id", sortable: true },
    { text: "Date Facture", value: "dateFacture", sortable: true },
    { text: "Montant", value: "montantFacture", sortable: true },
];
</script >
