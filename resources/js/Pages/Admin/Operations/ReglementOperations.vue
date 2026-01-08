<template>
    <div class="row">
        <div class="col-lg-12 p-4">
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="4" alternating
                table-class-name="customize-table">
                <template #empty-message>
                    <a href="">Aucun patient avec les données saisie</a>
                </template>
                <template #item-TotalClinique="item">
                    {{ item.TotalClinique }} DH
                </template>
                <template #item-operation="item">
                    <button type="button" class="btn btn-secondary m-2" title="Ajouter à la Liste d'attente"
                            @click.prevent="OpenReglementOperationModal(item)">
                            <i class="ri-checkbox-circle-line font-size-16"></i>
                        </button>
                </template>

                <template #item-reglement="item">
                    {{ calculateDifference(item) }} DH
                </template>
            </EasyDataTable>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" ref="ReglementModalOperation" id="test">
        <div class="modal-dialog modal-lg" role="reglementOperation">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5  class="modal-title text-white"><i class="fas fa-notes-medical"></i> Reglement / Operation
                         </h5>
                    <button type="button" @click="CloseReglementModal" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills nav-fill mb-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="patientFactures-tab" data-toggle="pill" href="#patientFactures"
                                role="tab" aria-controls="patientFactures" aria-selected="true"><i
                                    class="fas fa-file-invoice"></i>Reglement</a>
                        </li>
                       
                        <li class="nav-item" >
                            <a class="nav-link" id="ajouterReglement-tab" data-toggle="pill" href="#ajouterReglement"
                                role="tab" aria-controls="ajouterReglement" aria-selected="false"><i
                                    class="ri-pass-valid-line"></i>
                                Ajouter Règlement</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="patientFactures" role="tabpanel"
                            aria-labelledby="patientFactures-tab">
                           <ListReglementOperation v-if="currentClinique" :items="currentClinique.ReglementsOperation" @CloseReglementModal="CloseReglementModal"></ListReglementOperation>
                        </div>

                        <div class="tab-pane fade" id="ajouterReglement" role="tabpanel" 
                            aria-labelledby="ajouterReglement-tab">
                            <AddReglement  v-if="currentClinique" :items="currentClinique" ></AddReglement>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="CloseReglementModal" type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="ri-pass-valid-fill"></i>
                        Fermer</button>
                </div>
            </div>
        </div>
    </div>

        <!-- overlay every modal -->
        <div v-if="currentClinique" class="modal-overlay"></div>

</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { ref, onMounted, onBeforeUnmount,defineProps  } from 'vue';
import AddReglement from "./AddReglement.vue";
import ListReglementOperation from "./ListReglement.vue";
const ReglementModalOperation = ref(null);
const currentClinique= ref(null);
const props = defineProps({
  items: Object,
});

const searchValue = ref("");
const searchField = ref(["nomPatient", "prenomPatient", "cinPatient"]);
const headers = [
    { text: "Clinique", value: "nomClinique", sortable: true },
    { text: "Ville", value: "villeClinique", sortable: true },
    { text: "Nombre Opération", value: "TotalOperations", sortable: true },
    { text: "Revenu Total", value: "TotalClinique", sortable: true },
    {text: " Montant A Regler", value:"reglement",sortable:true},
    { text: "Regler", value: "operation", sortable: true },
];

//Open / CLose Reglement Patient
const OpenReglementOperationModal = (item) => {
    currentClinique.value=item;
    ReglementModalOperation.value.style.display = 'block';
};

function CloseReglementModal  () {
    ReglementModalOperation.value.style.display = 'none';
    currentClinique.value=null;
};

const calculateDifference = (item) => {
    return (item.TotalClinique - item.TotalReglement)
}

onMounted(() => {
  const closeHandler = () => CloseReglementModal();
  window.addEventListener('close-modal', closeHandler);

  onBeforeUnmount(() => {
    // Remove the event listener when the component is unmounted
    window.removeEventListener('close-modal', closeHandler);
  });
});

</script>
<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(227, 227, 227) transparent;
    z-index: 1000;
}
.modal {
    z-index: 3000;
}
</style>