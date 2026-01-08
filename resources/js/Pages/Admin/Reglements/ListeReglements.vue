<template>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="form-group col-md-6 col-lg-4">
                <input type="search" class="form-control" placeholder="Chercher Réglement" id="RechercheRD2"
                    v-model="searchValue" />
            </div>
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="4" alternating table-class-name="customize-table">
                <template #item-montantReglement="item">
                    {{ item.montantReglement + " DH" }}
                </template>
                <template #empty-message>
                    <span class="text-danger"> Aucun Réglement Pour ce Patient</span>
                </template>
                <template #item-supprimer="item">
                    <button type="button" class="btn btn-danger m-2" title="Supprimer Reglement"
                        @click.prevent="deleteReglement(item)">
                        <i class="ri-delete-bin-2-fill"></i> </button>
                </template>
            </EasyDataTable>
        </div>
    </div>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { ref } from "vue";
import { useForm, router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';

//Reference
const searchValue = ref("");
const searchField = ref(["docteur", "motifVisite"]);
//Define Props
const props = defineProps({
    items: Object,
});
//Headers Easy-DataTable
const headers = [
    { text: "N°", value: "id", sortable: true },
    { text: "Date Reglement", value: "dateReglement", sortable: true },
    { text: "Montant", value: "montantReglement", sortable: true },
    { text: "Motif", value: "motifVisite", sortable: true },
    { text: "Docteur", value: "docteur.name", sortable: true },
    { text: "Supprimer", value: "supprimer", sortable: true },

];

const deleteReglement = (reglementFacture) => {
    router.delete(`/ReglementFacture/${reglementFacture.id}`, {
        preserveState: true,
        preserveScroll: true,
        data: reglementFacture,
        forceFormData: true,
        errorBag: null,
        forceFormData: false,
        onSuccess: page => {
            useToast().info('Reglement Supprimer', { position: 'bottom-right', duration: 3000 });
        },
        onError: (errors) => {
            useToast().error('Erreur lors de la  Suppression', { position: 'bottom-right', duration: 3000 });
        },
    })

};
</script >
