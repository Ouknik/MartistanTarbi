<template>
  <div>
    <!-- Tab Headers -->
    <ul id="top-tab-list" class="p-0">
      <li v-for="tab in tabs" :key="tab.name" @click.prevent="setActive(tab.name)"
        :class="{ active: isActive(tab.name) }">
        <a class="nav-link " :href="`#${tab.name}`">
          <i :class="tab.icon"></i>
          {{ tab.label }}
        </a>
      </li>
    </ul>
    <!-- Tab Content -->
    <div class="iq-card-body">
      <!-- Histoire Maladie Content -->
      <div v-if="isActive('HistoireMaladie')" class="tab-content">
        <div class="card-body col-sm-12 col-lg-12" style="overflow: auto">
          <div class="card-body col-sm-12 col-lg-12 border">
            <div class="row">

              <div class="col-lg-6">
                <div class="row">
                  <div class="col-md-12 col-lg-12">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                      <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                          <h4 class="card-title">Histoire De La Maldie</h4>
                        </div>
                      </div>
                      <div class="iq-card-body" style="max-height: 480px; overflow-y: auto;overflow-x: hidden;">
                        <ul class="iq-timeline">
                          <li v-for="histoireMaladie in HistoireMaladies" v-bind:key="histoireMaladie.id">
                            <div class="timeline-dots-fill"></div>
                            <h4 class="float-left mb-2 text-dark">{{
                              histoireMaladie.motifConsultation }}</h4>
                            <h5 class="float-right mt-1">{{
                              histoireMaladie.dateConsultation }}<i class="ri-time-fill ml-1"></i></h5>
                            <div class="d-inline-block w-100 text-dark">
                              <p>{{ histoireMaladie.descriptionConsultation }}</p>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-12">
                    <label for="exampleInputdate">Date Consultation</label>
                    <input type="date" class="form-control" id="motifInput" v-model="consultation.dateConsultation" />
                  </div>
                  <div class="col-lg-12">
                    <label for="exampleInputdate">Motif Consultation</label>
                    <input type="texte" class="form-control" id="motifInput" v-model="consultation.motifConsultation" />
                  </div>
                  <div class="col-lg-12">
                    <label for="validationTextarea">Description:</label>
                    <textarea class="form-control" id="validationTextarea" placeholder="" rows="9" cols="10"
                      v-model="consultation.diagnostiqueConsultation"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Submit Button  -->
        <button v-if="$page.props.user.type == 'secretaire'" @click="submit"
          class="btn btn-primary float-right">Enregistrer</button>
      </div>
      <!-- Ordonnances Content -->
      <div v-if="isActive('ordonnances')" class="tab-content">
        <div class="row">

          <div class="col-lg-5">
            <DocumentTemplate :ordonnanceData="ordonnanceData"></DocumentTemplate>

          </div>
          <div class="col-lg-7">

            <label :style="messageStyle" v-if="message">
              {{ message }}
            </label>
            <div v-if="ordonnanceType === 'normal'" class="row mt-2">
              <div class="col-lg-6">
                <label class="typo__label">Medicaments</label>
                <input type="text" class="form-control my-2" id="email1" v-model="rechercheMedicament"
                  @input="filtrerMedicaments" placeholder="Rechercher un médicament">
                <ul v-if="medicamentsFiltres.length > 0" class="liste-medicaments">
                  <li v-for="medicament in medicamentsFiltres" :key="medicament.id"
                    @click="selectionnerMedicament(medicament)">
                    {{ medicament.nomMedicament }}
                  </li>
                </ul>
                <ul v-else>
                  <button v-if="medicamentsFiltres.length === 0 && rechercheMedicament.length > 0" type="button"
                    class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddMedicamentOrdonnance">
                    <i class="ri-add-fill"></i>
                    Ajouter Médicament
                  </button>
                </ul>


              </div>
              <div class="col-lg-6" v-if="medicamentSelectionne && traitementsDisponibles.length > 0">
                <label class="typo__label"> Prescriptions</label>
                <select class="form-control my-2" v-model="traitementSelectionne">
                  <option value="" disabled>Sélectionnez une prescription</option>
                  <option v-for="traitement in traitementsDisponibles" :key="traitement.id" :value="traitement">
                    {{ traitement.prescription }}
                  </option>
                </select>
              </div>
            </div>

            <div v-if="ordonnanceType === 'normal'">
              <div v-if="traitementsChoisis.length">
                <div v-for="(traitement, index) in traitementsChoisis" :key="index">
                  <div class="row mt-2">
                    <div class="col-lg-11">
                      <h5 style="font-weight: bold">
                        <a @click="supprimerTraitement(index)" class="iq-icons-list" href="#"><i
                            class="ion-trash-b text-danger"></i>{{ traitement.nomMedicament }} {{
                              traitement.dosageMedicament }} {{ traitement.uniteDosageMedicament }}</a>
                      </h5>
                    </div>
                  </div>
                  <div class="row p-0" style="margin-top: -15px;">
                    <div class="col-lg-11">
                      <input type="text" class="form-control ml-3" v-model.lazy="traitement.prescription" />

                    </div>
                    <div class="col-lg-1">
                      <div class="custom-control custom-checkbox mt-2">
                        <input v-model="traitement.isChecked" type="checkbox" class="custom-control-input"
                          :id="'customCheck-' + index" :checked="false">
                        <label class="custom-control-label" :for="'customCheck-' + index"></label>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Analyses Content -->
      <div v-if="isActive('analyses')" class="tab-content" style="min-height: 800px;">
        <div class="card-body col-sm-12 col-lg-12 text-center">
          <button type="button" data-toggle="modal" data-target=".bd-OronnanceAnalyses-modal-lg"
            class="btn btn-primary">Imprimer Analyses <i class="ri-printer-line"></i></button>
        </div>
        <div class="card-body col-sm-12 col-lg-12">
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3" style="overflow: auto" v-for="familleanalyse in familleanalyses"
                v-bind:key="familleanalyse.id">
                <div class="iq-card-body">
                  <ul class="consultation-progress m-0 p-0">
                    <li class="d-flex align-items-center ml-2">
                      <h5 class="fst-bold">
                        <i class="ri-bill-fill"></i>
                        {{ familleanalyse.familleanalyse }}
                      </h5>
                    </li>
                    <li class="d-flex align-items-center " style="margin-left:30px"
                      v-for="analyse in familleanalyse.analyses" v-bind:key="analyse.famille_analyse_id">
                      <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                        <input type="checkbox" class="custom-control-input bg-primary" name="analyses" :value="analyse"
                          :id="'analysis_' + analyse.id" v-model="checkedAnalyses" />
                        <label class="custom-control-label" :for="'analysis_' + analyse.id">
                          {{ analyse.nomAnalyse }}
                        </label>

                        <ul class="consultation-progress mt-4 mb-0 p-0" style="margin-left:-45px">
                          <div v-for="sousAnalyse in sousAnalyses" v-bind:key="sousAnalyse.id">
                            <li v-if="analyse.id == sousAnalyse.analyse_id" class="d-flex align-items-center ml-2 ">
                              <input type="checkbox" class="custom-control-input bg-primary" name="sousAnalyses[]"
                                :value="sousAnalyse" :id="'subanalysis_' + sousAnalyse.id"
                                v-model="checkedSousAnalyses" />

                              <label class="custom-control-label" :for="'subanalysis_' + sousAnalyse.id">
                                {{ sousAnalyse.nomSousAnalyse }}</label>
                            </li>
                          </div>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- Facturs Content -->
      <div v-if="isActive('factures')" class="tab-content">
        <div class="card-body col-sm-12 col-lg-12" style="overflow: auto">
          <div class="col-lg-12 text-center">
            <label :style="messageStyle"
              v-if="selectedMedicamentNormal == '' && ordonnanceType === 'normal' || ordonnanceType === 'normal'">{{
                message }}</label>

          </div>
          <div class="card-body col-sm-12 col-lg-12 border">
            <div class="row">
              <div class="col-lg-6 ">
                <div class="row text-center">
                  <div class="col-lg-12">
                    <p class="text-danger">{{ selectionMessage }}</p>
                  </div>
                </div>
                <div class="row ">
                  <div class="col-lg-12">
                    <EasyDataTable buttons-pagination :items="soins" :headers="headerSoins"
                      :search-value="searchValueSoin" :search-field="searchFieldSoin" :rows-per-page="10" alternating
                      v-model:items-selected="itemsSelectedSoin" :select-all="false">
                      <template #empty-message>
                        <h5>Aucun Soin avec ce nom</h5>
                      </template>
                    </EasyDataTable>
                  </div>

                </div>
                <div class="row mt-2 ml-0 mt-4">
                  <div v-for="(items, index) in itemsSelectedSoin" :key="index" class="form-row">
                    <div class="col-lg-6 mb-2">
                      <input type="text" class="form-control" v-model="items.libelleSoin" id="validationSoin01"
                        disabled />
                      <div class="valid-feedback"></div>
                    </div>
                    <div class="col-lg-6 mb-2">
                      <input type="text" class="form-control" v-model="items.montantSoin" id="validationSoin02" />
                      <div class="valid-feedback"></div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="form-group col-md-6 col-lg-6">
                        <label for="validationSoin04">Montant Total</label>
                        <input type="text" class="form-control col-md-12 text-white" id="validationSoin04"
                          v-model="consultation.total" disabled required
                          style="background-color:#089bab;font-weight: 600;" />
                      </div>
                      <div class="form-group col-md-6 col-lg-6" hidden>
                        <label for="validationSoin04">Montant a Payer</label>
                        <input type="text" class="form-control col-md-12" id="validationSoin04"
                          v-model="consultation.montantApayer" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 ">
                <div class="row">
                  <div class="col-lg-12 text-center text-dark font-weight-bold">
                    <span hidden></span>
                    <span>Rendez-vous Le : </span><span>{{ formatDate(RendezVousDate) }}</span>
                    <DatePicker v-model="RendezVousDate" mode="date" :min-date="new Date()" expanded>
                    </DatePicker>
                  </div>

                </div>
              </div>
            </div>
            <div class="row" hidden>
              <div class="form-group col-md-6 col-lg-6">
                <div class="form-row">
                  <div class="col-md-4 mb-2">
                    <label for="validationSoin01">Soin</label>
                  </div>
                  <div class="col-md-4 mb-2">
                    <label for="validationSoin02">Montant</label>
                  </div>
                </div>
                <div v-for="(items, index) in itemsSelectedSoin" :key="index" class="form-row">
                  <div class="col-md-4 mb-4">
                    <input type="text" class="form-control" v-model="items.libelleSoin" id="validationSoin01" disabled />
                    <div class="valid-feedback"></div>
                  </div>
                  <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" v-model="items.montantSoin" id="validationSoin02" />
                    <div class="valid-feedback"></div>
                  </div>
                  <div class="col-md-3 mb-2">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Submit Button -->
        <button @click="submit" class="btn btn-primary float-right"
          >Enregistrer</button>
          
      </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="AddMedicamentOrdonnance" tabindex="-1" role="dialog"
      style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">

        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <h5 class="modal-title text-white">Ajouter Médicament</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationDefault02">Nom</label>
                <input type="text" v-model="medicament.nomMedicament" class="form-control" id="validationDefault02">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault02">Dosage</label>
                <input type="text" v-model="medicament.dosageMedicament" class="form-control" id="validationDefault02"
                  placeholder="Ex : 200, 500, 1000...">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault02">Unité Dosage</label>
                <input type="text" v-model="medicament.uniteDosageMedicament" class="form-control"
                  id="validationDefault02" placeholder="Ex : MG / UI, MG, ML, %, µG...">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault05">Unité De Mesure</label>
                <input type="text" v-model="medicament.uniteMessure" class="form-control" id="validationDefault05"
                  placeholder="Ex : Comprimé, GELULE, Cuillère, Sachette ...">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="button" @click="AjouterMedicament" class="btn btn-primary">Enregistrer</button>
          </div>
        </div>

      </div>
    </div>
    <CreateMedicament ref="isVisible"></CreateMedicament>
    <printAnalyses :patient="patient" :analyses="checkedAnalyses" :sousAnalyses="checkedSousAnalyses"
      :familleanalyses="familleanalyses"></printAnalyses>
  </div>
</template>

<script setup>
import DocumentTemplate from "../Documents/DocumentTemplate.vue";
import 'vue3-treeselect/dist/vue3-treeselect.css';
import MultiSelect from "vue-multiselect";
import { useToast } from 'vue-toast-notification';
import { DatePicker } from 'v-calendar';
import { format } from 'date-fns';
import { useForm, router } from "@inertiajs/vue3";
import CreateMedicament from "../Medicaments/CreateMedicament.vue";
import printAnalyses from "../Analyses/OrdonnanceAnalyses.vue";
import { ref, computed, watch, onMounted, nextTick } from "vue";
import EasyDataTable from "vue3-easy-data-table";
import "sweetalert2/dist/sweetalert2.min.css";

const searchValueSoin = ref("");
const searchFieldSoin = ref(["libelleSoin", "montantSoin"]);
const antecedentsTable = ref([]);
const checkedAnalyses = ref([]);
const checkedSousAnalyses = ref([]);
const itemsSelected = ref([]);
const itemsSelectedSoin = ref([]);
const selectedTraitement = ref([]);
const RendezVousDate = ref();

const ordonnanceType = ref("normal");
const selectedMedicamentNormal = ref(null);

const isVisible = ref(false);
const selectedAnalyses = ref([]);
// Créez un ref pour stocker les analyses sélectionnées
const selectedAnalysesRef = ref([]);
const isEnregistrementReussi = ref(false);

// Utilisez un effet réactif pour observer les changements dans selectedAnalyses et mettre à jour selectedAnalysesRef
watch(selectedAnalyses, (newVal) => {
  selectedAnalysesRef.value = newVal;
});
// const totalSoin = ref(0);
const headerSoins = [
  { text: "Soin", value: "libelleSoin", sortable: true },
  { text: "Montant", value: "montantSoin", sortable: true },
  { text: "Description", value: "descriptionSoin", sortable: true },
];
const props = defineProps({
  HistoireMaladies: Object,
  familleanalyses: Object,
  sousAnalyses: Object,
  patient: Object,
  medicaments: Array,
  soins: Object,
  headers: Object,
  traitements: Object,
  isShow: {
    type: Boolean,
    default: false,
  },
});

let medicamentsData = ref(props.medicaments);
const MedicamentsO = ref(medicamentsData);
const message = ref(''); // Message à afficher
const messageStyle = ref('');

// let medicamentsData = ref(props.medicaments);
let rechercheMedicament = ref("");
let medicamentsFiltres = ref([]);
let medicamentSelectionne = ref(null);
let traitementsDisponibles = ref([]);
let traitementSelectionne = ref(null);
let traitementsChoisis = ref([]);

const toolbars = {
  bold: true,
  italic: true,
  header: true,
  underline: true,
  strikethrough: true,
  mark: true,
  superscript: true,
  subscript: true,
  quote: true,
  ol: true,
  ul: true,
  link: false,
  imagelink: false,
  code: false,
  table: false,
  fullscreen: true,
  readmodel: true,
  htmlcode: true,
  help: false,
  undo: true,
  redo: true,
  trash: true,
  save: true,

  navigation: true,
  alignleft: true,
  aligncenter: true,
  alignright: true,

  subfield: true,
  preview: true,
};
const traitementItems = useForm({
  nomTraitement: "",
  MedicamentsTraitement: itemsSelected,
});

const ordonnanceData = useForm({
  typeOrdonnance: ordonnanceType,
  patient: props.patient,
  traitementsChoisi: traitementsChoisis
});

const consultation = useForm({
  dateConsultation: getFormattedDate(),
  ordonnances: ordonnanceData,
  patient: "",
  total: 0,
  montantApayer: "",
  diagnostiqueConsultation: "",
  motifConsultation: "",
  soins: itemsSelectedSoin,
  antecedents: antecedentsTable,
  analyses: checkedAnalyses,
  SousAnalyses: checkedSousAnalyses,
  ordonnance: [
    {
      dateOrdonnance: new Date().toJSON().slice(0, 10),
      medicaments: MedicamentsO,
      traitement: selectedTraitement,
    },
  ],
  RendezVousDate: "",
});

function getFormattedDate() {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0'); // Ajoute un zéro initial si le mois est inférieur à 10
  const day = String(now.getDate()).padStart(2, '0'); // Ajoute un zéro initial si le jour est inférieur à 10
  return `${year}-${month}-${day}`;
}
const totalSoin = computed(() => {
  return itemsSelectedSoin.value.reduce((total, item) => total + parseInt(item.montantSoin), 0);
});

// const selectionMessage = computed(() => {
//   if (itemsSelectedSoin.value.length === 0) {
//     return "Veuillez sélectionner un soin.";
//   } else {
//     return "";
//   }
// });


watch(totalSoin, (newTotal) => {
  consultation.total = newTotal;
});

const soins = ref(
  Array.isArray(props.soins)
    ? props.soins.map((soin) => ({ ...soin, selected: false }))
    : []
);

watch(itemsSelectedSoin, (newItemsSelected) => {
  soins.value.forEach((soin) => {
    if (newItemsSelected.includes(soin)) {
      soin.selected = true;
    } else {
      soin.selected = false;
    }
  });
});

const tabs = [
  { name: "HistoireMaladie", label: "Histoire Maldie", icon: "ri-hospital-line" },
  { name: "ordonnances", label: "Ordonnances", icon: "ri-medium-line" },
  { name: "analyses", label: "Analyses", icon: "ri-bar-chart-box-line" },
  { name: "factures", label: "Factures", icon: "ri-bill-line" },
];
const activeTab = ref("HistoireMaladie");

const setActive = (tabName) => {
  activeTab.value = tabName;
};
const isActive = (tabName) => {
  return activeTab.value === tabName;
};


onMounted(() => {
  medicamentsData.value = props.medicaments;
  window.Echo.channel('get-medicaments').listen('Medicaments', (e) => {
    medicamentsData.value = e.medicaments;
  });
});

function formatDate(date) {
  if (!(date instanceof Date)) {
    return '';
  }
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();

  return `${day}-${month}-${year}`;
}

const emitConsultationAdded = () => {
  const event = new Event('handelConsultation');
  window.dispatchEvent(event);
};


const submit = async () => {
  const toast = useToast();
  if (RendezVousDate.value != null) {
    const formattedDate = format(RendezVousDate.value, 'yyyy-MM-dd');
    consultation.RendezVousDate = formattedDate;
  }

  try {
    const response = await consultation.post("/consultations");
    // Après un enregistrement réussi, mettez à jour la variable
    isEnregistrementReussi.value = true;
    toast.success("Consultation ajoutée avec succès!", {
      duration: 3000,
      position: 'bottom-right'
    });
    emitConsultationAdded();
  } catch (error) {
    // Gérez les erreurs si nécessaire
  }
};
const customLabel = ({
  nomMedicament,
  dosageMedicament,
  uniteDosageMedicament,
}) => {
  return `${nomMedicament} – ${dosageMedicament} ${uniteDosageMedicament}`;
};

onMounted(() => {
  if (ordonnanceType === "normal") {
    ordonnanceData.medicamentsMere = null;
  }
});


// Fonction pour filtrer les médicaments
const filtrerMedicaments = () => {
  medicamentsFiltres.value = rechercheMedicament.value
    ? medicamentsData.value.filter(medicament =>
      medicament.nomMedicament.toLowerCase().includes(rechercheMedicament.value.toLowerCase())
    )
    : [];
};
// Sélection d'un médicament et chargement des prescriptions
const selectionnerMedicament = (medicament) => {
  medicamentSelectionne.value = medicament;
  traitementsDisponibles.value = medicament.prescriptions || [];
  rechercheMedicament.value = '';
  medicamentsFiltres.value = [];

  if (traitementsDisponibles.value.length === 0) {
    traitementsChoisis.value.push({
      medicament_id: medicament.id, // Utilisez une valeur unique pour l'ID
      nomMedicament: medicament.nomMedicament,
      dosageMedicament: medicament.dosageMedicament,
      uniteDosageMedicament: medicament.uniteDosageMedicament,
      prescription: '', // Champ de saisie vide pour une nouvelle 
      isChecked: ''
    });
  }
};

watch(traitementSelectionne, (nouveauTraitement) => {
  if (nouveauTraitement) {
    traitementsChoisis.value.push({
      ...nouveauTraitement,
      nomMedicament: medicamentSelectionne.value.nomMedicament,
      dosageMedicament: medicamentSelectionne.value.dosageMedicament,
      uniteDosageMedicament: medicamentSelectionne.value.uniteDosageMedicament
    });
    traitementSelectionne.value = null;
  }
});

// Suppression d'un traitement de la liste
const supprimerTraitement = (index) => {
  traitementsChoisis.value.splice(index, 1);
};

onMounted(() => {
  medicamentsData.value = props.medicaments;
  window.Echo.channel('get-medicaments').listen('Medicaments', (e) => {
    medicamentsData.value = e.medicaments;
  });
});



const medicament = useForm({
  nomMedicament: '',
  dossageMedicament: '',
  unitedosageMedicament: '',
  uniteMessure: '',
});
const AjouterMedicament = () => {
  if (validateMedicament(medicament)) {
    router.visit('/medicaments', {
      method: 'post',
      data: medicament,
      preserveState: true,
      preserveScroll: false,
      errorBag: null,
      forceFormData: true,
      onProgress: progress => { },
      onSuccess: page => {
        medicament.nomMedicament = '';
        medicament.dossageMedicament = '';
        medicament.unitedosageMedicament = '';
        medicament.uniteMessure = '';
        useToast().success('Bien Ajouter', { position: 'bottom-right', duration: 3000 });
        $('#AddMedicamentOrdonnance').modal('hide');
      }, onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
  }
};
const validateMedicament = (medicament) => {
  if (
    !medicament.nomMedicament ||
    !medicament.uniteMessure || !medicament.uniteDosageMedicament || !medicament.dosageMedicament
  ) {
    useToast().error("Veuillez remplir tout Les champs", { position: 'bottom-right', duration: 3000 });
    return false;
  }
  return true;
};
</script>
<style scoped>
@import "vue-multiselect/dist/vue-multiselect.css";

.fixed-button-analyse {
  position: relative;
  bottom: 150px;
  right: 320px;
  z-index: 1500;
}

.liste-medicaments {
  max-height: 200px;
  overflow-y: auto;
  list-style-type: none;
  padding: 0;
}

.liste-medicaments li {
  cursor: pointer;
  padding: 5px;
  font-weight: bold;
  color: black;
}

.liste-medicaments li:hover {
  background-color: #c9c9c9;
  color: black;
}
</style>


