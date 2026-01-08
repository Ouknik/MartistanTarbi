<template>
  <div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between" style="background-color: #ceebee">
      <div class="iq-header-title">
        <h5 class="card-title">Liste des patient</h5>
      </div>
    </div>
    <div class="iq-card-body" style="min-height: 680px">
      <div class="form-group d-flex col-md-6 col-lg-4">
        <input type="search" class="form-control" placeholder="Chercher patient" id="cherechePatient"
          v-model="searchValue" @keyup.enter="searchPatients()" />
        <input @click="searchPatients()" type="button" value="Recherche" class="btn btn-primary ml-4" />
      </div>
      <EasyDataTable buttons-pagination :items="items.data" :headers="headers" :hide-footer:search-field="searchField"
        :rows-per-page="items ? items.perPage : 10" :hide-footer="true" alternating table-class-name="customize-table">
        <template #header-cinPatient="header">
          <div class="mt-4">
            <i class="ri-profile-line"></i>
            {{ header.text.toUpperCase() }}
          </div>
        </template>
        <template #header-nomPatient="header">
          <div class="mt-4">
            <i class="ri-user-line"></i>
            {{ header.text.toUpperCase() }}
          </div>
        </template>
        <template #header-prenomPatient="header">
          <div class="mt-4">
            <i class="ri-user-line"></i>
            {{ header.text.toUpperCase() }}
          </div>
        </template>
        <template #header-docteurs="header">
          <div class="mt-4">
            <i class="ri-calendar-2-line"></i>
            {{ header.text.toUpperCase() }}
          </div>
        </template>
        <template #header-reglement="header">
          <div class="mt-4">
            <i class="ri-money-dollar-circle-line"></i>
            {{ header.text.toUpperCase() }}
          </div>
        </template>

        <template #header-operation="header">
          <div class="mb-3">
            <i class="ri-settings-4-line"></i>
            {{ header.text.toUpperCase() }}
          </div>
        </template>
        <template #item-operation="item">
          <div class="row">
              <div class="col-lg-2 col-md-6">
                <button type="button" class="btn btn-secondary" title="Ajouter à la Liste d'attente"
                  @click.prevent="OpenReglementModal(item)">
                  <i class="ri-checkbox-circle-line font-size-16"></i>
                </button>
              </div>
              <div class="col-lg-2  col-md-6">
                <button @click.prevent="showRow(item)" class="btn btn-info" title="Details Patient">
                  <i class="ri-eye-line"></i>
                </button>
              </div>
              <div class="col-lg-2 col-md-6">
                <button type="button" data-toggle="modal" @click="GestionRendezVousModal(item)" data-value="{{item}}"
                  data-target="#ModalAddRendezVous" class="btn btn-warning">
                  <i class="ri-calendar-line text-white"></i>
                </button>
              </div>
              <div class="col-lg-2 col-md-6">
                <button type="button" data-toggle="modal" @click="AddOperation(item)" data-value="{{item}}"
                  data-target="#ModalAddOperation" class="btn" style="background-color: #d2bed8">
                  <i class="ri-hospital-line text-white"></i>
                </button>
              </div>
              <div class="col-lg-2 col-md-6">
                <button :disabled="(item.isActive = 0)" type="button" class="btn btn-primary"
                  title="Ajouter à la Liste d'attente" @click.prevent="openAddListAttModal(item)">
                  <i class="ri-add-fill"></i>
                </button>
              </div>
          </div>
        </template>
        <template #item-docteurs="item">
          <span v-if="item.rendez_vous.length > 0" class="text-success font-weight-bold text-center">
            <span class="text-secondary font-weight-bold">{{ item.rendez_vous[0].dateRendezVous }}<br /></span>
            <span class="text-primary">Dr. {{ item.rendez_vous[0].docteur.name }}</span>
          </span>
          <span v-else class="text-dark font-weight-bold">
            Aucun Rendez-Vous
          </span>
        </template>
        <template #item-reglement="item">
          <span hidden>{{ (total = 0) }}</span>
          <div class="text-center">
            <div v-if="item.TotalByDoctor != null">
              <div v-for="(value, key) in item.TotalByDoctor" :key="key">
                <span hidden>{{
                  (total = +value.total_factures - value.total_reglements)
                }}</span>
              </div>
            </div>
            <span v-if="total != 0">
              <i style="font-size: 25px" class="ri-close-circle-line text-danger"></i>
            </span>
            <span v-else>
              <i style="font-size: 25px" class="ri-check-double-line text-success"></i>
            </span>
          </div>
        </template>
        <template #item-rendezVous="item">
          <div class="row" v-for="rendezvous in item.rendez_vous" :key="rendezvous.id">
            <span class="iq-bg-success text-primary rounded" v-if="formatedDate < rendezvous.dateRendezVous">
              {{ rendezvous.dateRendezVous }}
            </span>
          </div>
        </template>
        <template #empty-message>
          <a href="">Aucun patient avec les données saisie</a>
        </template>
      </EasyDataTable>
      <div class="row">
        <div class="col-lg-12 text-center">
          <div style="min-width: 100%">
            <button class="btn btn-primary" @click="prevPage" :disabled="items.current_page == 1">
              <h5 class="text-white">Precedent</h5>
            </button>

            <span v-for="(pag, index) in items.links" :key="pag.label">
              <button v-if="index !== 0 &&
                index !== items.links.length - 1 &&
                pag.url !== null
                " @click="loadPage(pag.label)" :class="{
    'm-2 btn': true,
    'btn-danger text-white': pag.label == items.current_page,
  }">
                <h5 :class="{
                  'm-2': true,
                  'text-white': pag.label == items.current_page,
                }">
                  {{ pag.label }}
                </h5>
              </button>
            </span>

            <button class="btn btn-primary" @click="nextPage" :disabled="items.last_page == items.current_page">
              <h5 class="text-white">Suivant</h5>
            </button>
          </div>
        </div>
        <div class="col-lg-12 text-center">
          <span class="font-weight-bold text-primary" style="font-size: 18px">
            Total Patients : {{ items.total }}</span>
        </div>
      </div>
    </div>
  </div>
  <!-- overlay every modal -->
  <div v-if="currentPatient" class="modal-overlay"></div>

  <!-- Modal Select Doctor and Add to List Attente -->
  <div class="modal" tabindex="-1" role="dialog" ref="addListAttModal">
    <div class="modal-dialog" role="document" v-if="currentPatient">
      <div class="modal-content" style="background-color: #eff7f8">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title text-white">Liste d'attente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeAddListAttModall">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row text-center">
            <div class="col-lg-12" v-if="currentPatient" style="font-size: 20px; color: black; font-weight: bold">
              Patient :
              {{
                currentPatient.nomPatient + " " + currentPatient.prenomPatient
              }}
            </div>
          </div>
          <span hidden v-if="currentPatient">
            {{ (idP = currentPatient.id) }}
          </span>
          <div class="row text-center" v-if="!StatePatient.statePatient">
            <div class="col-lg-12 mt-4 text-danger font-size-16 font-weight-bold">
              Veuillez Selectionner Le Motif De Visite
            </div>
          </div>
          <div class="row mt-3" v-if="StatePatient.statePatient">
            <div class="col-sm-6 col-md-3 col-lg-6" v-for="docteur in docteurs" v-bind:key="docteur.id">
              <div class="iq-card border border-primary" style="min-height: 190px">
                <Link :href="'/patientsAtt/' +
                  idP +
                  '/' +
                  docteur.id +
                  '/' +
                  StatePatient.statePatient
                  " method="put" preserve-scroll preserve-state @click="closeAddListAttModall">
                <div class="iq-card-body text-center">
                  <div class="doc-profile">
                    <img :src="docteur.profile_photo_path" class="img-fluid avatar-100" alt="profile" />
                  </div>
                  <div class="iq-doc-info mt-3">
                    <h6 style="font-weight: bold">{{ docteur.name }}</h6>
                  </div>
                </div>
                </Link>
              </div>
            </div>
          </div>

          <div class="row mt-2" v-if="currentPatient">
            <div class="col-sm-6 col-md-3 col-lg-12">
              <div class="iq-card border border-primary">
                <div class="row ml-2">
                  <div class="col-lg-4" v-for="(motif, index) in motifVisite" v-bind:key="motif.id">
                    <div class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                      <input type="radio" :id="'customRadio-7-' + index" v-model="StatePatient.statePatient"
                        :name="'customRadio'" :value="motif.motifVisite" class="custom-control-input bg-danger" />
                      <label :for="'customRadio-7-' + index" class="custom-control-label">
                        {{ motif.motifVisite }}
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row text-center mb-2">
            <div class="col-lg-12 text-dark font-size-16 font-weight-bold">
              Motif de Consultation
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal reglement Patient -->
  <div class="modal" tabindex="-1" role="dialog" ref="ReglementModal">
    <div class="modal-dialog modal-lg" role="reglement">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 v-if="currentPatient" class="modal-title text-white">
            <i class="fas fa-notes-medical"></i> Factures / Reglements :
            {{ currentPatient.nomPatient + " " + currentPatient.prenomPatient }}
          </h5>
          <button type="button" @click="CloseReglementModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" v-if="currentPatient">
          <ul class="nav nav-pills nav-fill mb-3" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="patientFactures-tab" data-toggle="pill" href="#patientFactures" role="tab"
                aria-controls="patientFactures" aria-selected="true"><i class="fas fa-file-invoice"></i>Factures</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="patientReglement-tab" data-toggle="pill" href="#patientReglement" role="tab"
                aria-controls="patientReglement" aria-selected="false"><i
                  class="ri-pass-valid-fill text-dark"></i>Règlement</a>
            </li>
            <li class="nav-item" v-if="currentPatient">
              <a class="nav-link" id="ajouterReglement-tab" data-toggle="pill" href="#ajouterReglement" role="tab"
                aria-controls="ajouterReglement" aria-selected="false"><i class="ri-pass-valid-line"></i> Ajouter
                Règlement</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="patientFactures" role="tabpanel"
              aria-labelledby="patientFactures-tab" v-if="currentPatient">
              <ListeFactures :items="currentPatient.factures"></ListeFactures>
            </div>
            <div class="tab-pane fade" id="patientReglement" role="tabpanel" aria-labelledby="patientReglement-tab"
              v-if="currentPatient">
              <ListeReglements :items="currentPatient.reglement_facture"></ListeReglements>
            </div>
            <div class="tab-pane fade" id="ajouterReglement" role="tabpanel" v-if="currentPatient"
              aria-labelledby="ajouterReglement-tab">
              <AddReglementPatient :motifVisite="motifVisite" :items="currentPatient" @reglementAdded="handleReglementAdded"></AddReglementPatient>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button @click="CloseReglementModal" type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="ri-pass-valid-fill"></i> Fermer
          </button>
        </div>
      </div>
    </div>
  </div>
  <GestionRendezVous :docteurs="docteurs" :currentPatient="rendezVousobj"></GestionRendezVous>
  <AddOperationModal :currentPatient="operationobj" :cliniques="cliniques" :typeOperations="typeOperations">
  </AddOperationModal>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { ref, watch } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
//Import customize Components
import ListeFactures from "../Reglements/ListFactures.vue";
import ListeReglements from "../Reglements/ListeReglements.vue";
import AddReglementPatient from "../Reglements/AddReglement.vue";
import GestionRendezVous from "../RendezVous/GestionRendezVous.vue";
import AddOperationModal from "../Operations/AddOperation.vue";
//Reference
const searchValue = ref("");
const searchField = ref(["nomPatient", "prenomPatient", "cinPatient"]);
const currentPatient = ref(null);
const addListAttModal = ref(null);
const ReglementModal = ref(null);
//Define Props
const props = defineProps({
  items: Object,
  formatedDate: "",
  docteurs: Object,
  motifVisite: Object,
  cliniques: Object,
  typeOperations: Object
});

const showRow = (item) => {
  router.get(route("patients.show", item));
};
//Headers Easy-DataTable
const headers = [
  { text: "CIN", value: "cinPatient", sortable: true },
  { text: "Nom", value: "nomPatient", sortable: true },
  { text: "Prénom", value: "prenomPatient", sortable: true },
  { text: "Rendez-Vous", value: "docteurs" },
  { text: "Reglement", value: "reglement" },
  { text: "Opération", value: "operation" },
];

//Headers Easy-DataTable
const headersRV = [
  { text: "Date", value: "dateRendezVous", sortable: true },
  { text: "Docteur", value: "docteur.name", sortable: true },
  { text: "Supprimer", value: "operation", sortable: true },
];
const loadPage = async (page) => {
  try {
    let url = `patients?page=${page}`;

    if (searchValue.value) {
      url += `&query=${searchValue.value}`;
    }
    router.visit(url, {
      method: "get",
      preserveScroll: true,
      preserveState: true,
    });
  } catch (error) {
    console.error("Erreur lors du chargement de la page :", error);
  }
};
const prevPage = () => {
  if (props.items.current_page > 1) {
    props.items.current_page -= 1;
    loadPage(props.items.current_page);
  }
};
const nextPage = () => {
  if (props.items.current_page < props.items.last_page) {
    props.items.current_page += 1;
    loadPage(props.items.current_page);
  }
};
const searchPatients = async () => {
  try {
    const response = await router.visit(
      `/patients?query=${searchValue.value}`,
      {
        method: "get",
        preserveScroll: true,
        preserveState: true,
      }
    );
  } catch (error) {
    console.error("Erreur lors de la recherche des patients :", error);
  }
};
watch(searchValue, (newVal) => {
  if (!newVal) {
    loadPage(1);
  }
});

//Open Modal Add List Att
const openAddListAttModal = (item) => {
  currentPatient.value = item;
  addListAttModal.value.style.display = "block";
};
const closeAddListAttModall = () => {
  addListAttModal.value.style.display = "none";
  currentPatient.value = null;
  StatePatient.statePatient = "";
};
//Open / CLose Reglement Patient
const OpenReglementModal = (item) => {
  currentPatient.value = item;
  ReglementModal.value.style.display = "block";
};
const CloseReglementModal = (item) => {
  if (ReglementModal.value && currentPatient.value) {
    ReglementModal.value.style.display = "none";
    currentPatient.value = null;
  }
};
// Define the function to handle the reglement added event
const handleReglementAdded = () => {
    // console.log('Reglement added');
    // Close the parent modal when the reglement is added or perform other actions
    CloseReglementModal();
};
// Listen for the custom event on window
window.addEventListener('reglementAdded', handleReglementAdded);
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

let rendezVousobj = ref({});
const GestionRendezVousModal = (item) => {
  rendezVousobj.value = item;
};

let operationobj = ref({});
const AddOperation = (item) => {
  operationobj.value = item;
};

const StatePatient = useForm({
  statePatient: "",
});
</script>

<style scoped>
.customize-table {
  --easy-table-header-height: 0px;
  --easy-table-header-item-padding: 0px 30px;
  /* --easy-table-body-row-font-size	: 16px; */
  /* --easy-table-header-font-size	:12px; */
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1000;
}

.modal {
  z-index: 2000;
}
</style>
