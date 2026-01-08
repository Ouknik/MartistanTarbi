<template>
  <div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between" style="background-color: #ceebee">
      <div class="iq-header-title">
        <h4 class="card-title">Liste des patients</h4>
      </div>
      <div class="iq-header-title">
        <div class="col-md-4">
          <div class="training-block d-flex align-items-center">
            <div class="rounded-circle iq-card-icon iq-bg-primary">
              <i class="ri-exchange-dollar-line fa-2x mr-2"></i>
            </div>
            <div class="ms-3">
              <h3 class="text-success mt-2"> {{ docteurs[0].TotalRevenuPermis }} DH</h3>
              <p class="mb-0">Revenu/Permis</p>
            </div>
          </div>
        </div>
       
      </div>
    </div>
    <div class="iq-card-body">
      <div class="form-group col-md-6 col-lg-4">
        <input type="search" class="form-control" placeholder="Chercher patient" id="cno" v-model="searchValue" />
      </div>
      <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
        :hide-footer:search-field="searchField" :rows-per-page="rowPerPage" alternating>
        <template #item-operation="item">
          <div class="row">
            <div class="d-flex justify-content-center align-items-center mb-1 mt-1">
              <button :class="calculateDifference(item) != 0 ? 'btn-danger' : 'btn-success'
                " :disabled="calculateDifference(item) === 0" type="button" class="btn"
                @click.prevent="openAddReglementModal(item)">
                <i class="ri-exchange-dollar-line"></i>
              </button>
            </div>
          </div>
        </template>
        <template #item-montantRegler="item">
          <span class="text-success font-weight-bold font-size-16">
            <!-- {{ montantRegler(item) }} -->
            {{ item.montantPayer }}
            <span class="text-dark font-size-16">DH</span>

          </span>
        </template>
        <template #empty-message>
          <a href="">Aucun patient avec les données saisie</a>
        </template>
      </EasyDataTable>
    </div>
  </div>
  <!-- overlay every modal -->
  <div v-if="currentPatient" class="modal-overlay"></div>

  <!-- Modal Add Reglement Permis -->
  <div class="modal" tabindex="-1" role="dialog" ref="addRendezVousModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: #eff7f8">
        <div class="modal-header" style="background-color: #ffb177">
          <h5 class="modal-title text-black">Encaisser La Facture</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeAddReglementModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row text-center" v-if="currentPatient">
            <div class="col-lg-12">
              <h2>N° Dossier {{ currentPatient.numeroDossier }}</h2>
            </div>
          </div>
          <div class="row text-center">
            <div class="col-lg-6" v-if="currentPatient" style="font-size: 20px; color: black; font-weight: bold">
              {{ currentPatient.nom + " " + currentPatient.prenom }}
            </div>
            <div class="col-lg-6" v-if="currentPatient" style="font-size: 20px; color: black; font-weight: bold">
              {{ formatDate(newRendezVousDate) }}
            </div>
          </div>

          <div class="row m-4" v-if="currentPatient">
            <span hidden>{{ Reglement.idPatientPermis= currentPatient.id }}</span>
            <div class="form-group col-md-4 col-lg-6">
              <label class="control-label align-self-center mb-1" for="lname"><span
                  style="color: #eff7f8; font-size: 1.2em">*</span> Montant
                A Payer</label><input type="text" class="form-control text-dark" id="lname"
                :value="currentPatient.montantAPayer + ' DH'" disabled />
            </div>
            <div v-if="currentPatient" class="form-group col-md-4 col-lg-6">
              <label class="control-label align-self-center mb-1" for="lname"><span
                  style="color: red; font-size: 1.2em">*</span> Montant
                Regler</label><input type="text" v-model="Reglement.montantReglement" :max="montantApayerPermis"
                class="form-control" id="lname" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" style="font-size: 16px" :class="{
            'btn btn-secondary text-white': !isMontantReglementValid,
            'btn btn-success': isMontantReglementValid,
            'btn btn-danger': !isMontantReglementValid,
          }" :disabled="!isMontantReglementValid" @click="AddReglement(currentPatient)">
            Ajouter Réglement
          </button>
          <button type="button" style="font-size: 16px" class="btn btn-secondary" data-dismiss="modal"
            @click="closeAddReglementModal">
            Annuler
          </button>
        </div>
      </div>
    </div>
  </div>
  <span hidden>{{ (Reglement.user_id = $page.props.user.id) }}</span>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { useToast } from "vue-toast-notification";
import { ref, computed } from "vue";
import { router, useForm } from "@inertiajs/vue3";
//Reference
const searchValue = ref("");
const searchField = ref(["nom", "prenom"]);
const currentPatient = ref(null);
const newRendezVousDate = ref(new Date());
const addRendezVousModal = ref(null);
const addListAttModal = ref(null);
const montantApayerPermis = ref(0);
//Define Props
const props = defineProps({
  items: Object,
  rowPerPage: Number,
  docteurs: Object,
});

const headers = [
  { text: "N° Dossier", value: "numeroDossier", sortable: true },
  { text: "Nom", value: "nom", sortable: true },
  { text: "Prénom", value: "prenom", sortable: true },
  { text: "Date Visite", value: "dateVisite", sortable: true },
  { text: "Montant à Payer", value: "montantAPayer", sortable: true },
  { text: "Montant regler", value: "montantRegler", sortable: true },
  { text: "Reglement", value: "operation", sortable: true },
];

const Reglement = useForm({
  montantReglement: "",
  modePaiement: "Cash",
  motifVisite: "Permis",
  patient_id: "",
  user_id: "",
  idPatientPermis: ""
});

// add reglement
const AddReglement = (patientsPermis) => {
  Reglement.patient_id = patientsPermis.patient_id;
  // Reglement.idPatientPermis = currentPatient.id;
  router.visit(`permis/${patientsPermis.id}`, {
    method: "PUT",
    data: Reglement,
    preserveState: true,
    preserveScroll: true,
    errorBag: null,
    forceFormData: false,
    onProgress: (progress) => { },
    onSuccess: (page) => {
      useToast().success("Réglement  Ajouter", {
        position: "bottom-right",
        duration: 3000,
      });
      closeAddReglementModal();
    },
    onError: (errors) => {
      useToast().error("Veuillez remplir tout les champs", {
        position: "bottom-right",
        duration: 3000,
      });
    },
  });
};
//Open Modal Add Rendez-Vous
const openAddReglementModal = (item) => {
  currentPatient.value = item;
  addRendezVousModal.value.style.display = "block";
};

//Close Modal Add Rendez-Vous
const closeAddReglementModal = () => {
  addRendezVousModal.value.style.display = "none";
  currentPatient.value = null;
};

//Formated Date function
function formatDate(date) {
  if (!(date instanceof Date)) {
    return "";
  }
  const day = String(date.getDate()).padStart(2, "0");
  const month = String(date.getMonth() + 1).padStart(2, "0");
  const year = date.getFullYear();
  return `${day}-${month}-${year}`;
}
const calculateDifference = (item) => {
  return item.montantAPayer - item.montantPayer;

};



const isMontantReglementValid = computed(() => {
  if (currentPatient.value) {
    const montantReglement = parseFloat(Reglement.montantReglement);
    const montantAPayer = parseFloat(currentPatient.value.montantAPayer);
    if (

      calculateDifference(currentPatient.value) != montantReglement ||
      isNaN(montantReglement)
    ) {
      return false;
    }
  }
  return true;
});
</script>


