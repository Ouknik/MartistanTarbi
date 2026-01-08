<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddMedicament">
            <i class="ri-add-fill"></i>
            Médicament
        </button>
    </div>
    <div class="row">
        <div class="form-group col-md-8 col-lg-4 ml-2">
            <input type="text" class="form-control" placeholder="Recherche..." id="cno" v-model="searchValue" />
        </div>
    </div>
    <div class="p-3">
        <EasyDataTable buttons-pagination :items="medicaments" :headers="headers" :search-value="searchValue"
            :search-field="searchField" :rows-per-page="8" alternating table-class-name="customize-table" >
            <template #item-operation="item">
                <button @click="editMedicament(item)" class="btn btn-success m-2" data-toggle="modal"
                    data-value="{{ item }}" data-target="#EditMedicament">
                    <i class="ri-edit-line"></i>
                </button>

                <button v-if="item.countMedicamentOrdonnance == 0 && item.countMedicamentTraitement==0"  @click="deleteMedicament(item)" class="btn btn-danger m-2">
                    <i class="ri-delete-bin-2-line"></i>
                </button>
            </template>
            <template #item-prescriptions="item">
                <button  @click="editMedicament(item)" class="btn btn-secondary m-2" data-toggle="modal"
                    data-value="{{ item }}" data-target="#CreatePrescription">
                    <i class="ri-add-circle-line"></i>
                </button>
            </template>
            <template #empty-message>
                <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddMedicament">
                    <i class="ri-add-fill"></i>
                    Ajouter Médicament
                </button>
            </template>
            <span>
            </span>
        </EasyDataTable>
    </div>
    <UpdateMedicament :medicament="medicamentobj"></UpdateMedicament>
    <CreatePrescription :medicament="medicamentobj"></CreatePrescription>
</template>
<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import EasyDataTable from "vue3-easy-data-table";
import UpdateMedicament from "../Medicaments/UpdateMedicament.vue";
import CreatePrescription from "../Prescriptions/CreatePrescription.vue";
let medicamentobj = ref({});
const props = defineProps({
    medicaments: Object,
    headers: Object
});
const searchValue = ref("");
const searchField = ref(["nomMedicament"]);
const headers = [
    // { text: "Code", value: "codeMedicament", sortable: true },
    { text: "Medicament", value: "nomMedicament", sortable: true },
    { text: "unite Mesure", value: "uniteMessure", sortable: true },
    { text: "Dosage", value: "dosageMedicament", sortable: true },
    { text: "Unité Dosage", value: "uniteDosageMedicament", sortable: true },
    // { text: "Forme", value: "formeMedicament", sortable: true },
    // { text: "Présentation", value: "presentationMedicament", sortable: true },
    // { text: "Prix", value: "prixMedicament", sortable: true },
    { text: "Action", value: "operation" },

    { text: "Prescriptions", value: "prescriptions" },
];
// Function Edit
const editMedicament = (data) => {
    medicamentobj.value = data
}
// Function Delete
const deleteMedicament = (medicament) => {
    router.delete(`/medicaments/${medicament.id}`, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().info('Medicament Supprimer', { position: 'bottom-right', duration: 3000 });
        },
    })
}
</script>