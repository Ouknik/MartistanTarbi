<template>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="form-group col-md-6 col-lg-4">
                <input type="search" class="form-control" placeholder="Chercher Réglement" id="rechercheRelement" v-model="searchValue" />
            </div>
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="4" alternating table-class-name="customize-table">
                <template #item-montantReglement="item">
                    {{ item.montantReglement }} DH
                </template>
                <template #empty-message>
                   <span class="text-danger"> Aucun Réglement Pour Cette CLinique</span>
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
const searchField = ref(["docteur","motifVisite"]);
//Define Props
const props = defineProps({
    items: Object,
});
//Headers Easy-DataTable
const headers = [
    { text: "N°", value: "id", sortable: true },
    { text: "Date Reglement", value: "dateReglement", sortable: true },
    { text: "Montant", value: "montantReglement", sortable: true },
    { text: "Mode Paiement", value: "modeReglement", sortable: true },
    { text: "Docteur", value: "docteur.name", sortable: true },
];
</script >
