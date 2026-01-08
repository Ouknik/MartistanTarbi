<template>
  <AdminLayout>
    <span hidden>{{ (user = $page.props.user) }}</span>
    <div class="row mt-1">
      <div class="col-lg-9">
        <HeaderState :docteur="docteurs"></HeaderState>
        <div class="col-lg-12 mt-1">
          <ul class="iq-edit-profile nav" style="margin-top: -25px">
            <li class="col-md-3 mb-3" data-intro="Voici où vous pouvez voir la liste des patients." data-step="1">
              <a class="nav-link p-0 linkcss" data-toggle="pill" href="#liste-patients">
                <div class="iq-card-block iq-card-height py-0 nav-pills">
                  <div class="iq-card-body iq-bg-primary rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <i class="ri-group-fill mr-2" style="font-size: 20px"></i>
                      <div class="text-right">
                        <h6 class="">Liste Patient</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </li>
            <li class="col-md-3" data-intro="Voici où vous pouvez voir la liste des patients." data-step="2">
              <a class="nav-link p-0 linkcss" data-toggle="pill" href="#ajouter-patient">
                <div class="iq-card iq-card-block iq-card-height py-0 nav-pills">
                  <div class="iq-card-body iq-bg-info rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <i class="ri-user-add-fill mr-2" style="font-size: 20px"></i>
                      <div class="text-right">
                        <h6 class="">Ajouter Patient</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </li>
            <li class="col-md-3" data-intro="Voici où vous pouvez voir la liste des patients." data-step="3">
              <a class="nav-link p-0 linkcss" data-toggle="pill" href="#validee">
                <div class="iq-card iq-card-block py-0 iq-card-height nav-pills">
                  <div class="iq-card-body iq-bg-secondary rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <i class="ri-user-follow-fill mr-2" style="font-size: 20px"></i>
                      <div class="text-right">
                        <h6 class="">Visite Terminée</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </li>
            <li class="col-md-3" data-intro="Voici où vous pouvez voir la liste des patients." data-step="4">
              <a class="nav-link p-0 linkcss" data-toggle="pill" href="#rendez-vous">
                <div class="iq-card iq-card-block py-0 iq-card-height nav-pills">
                  <div class="iq-card-body iq-bg-warning rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <i class="ri-calendar-todo-line mr-2" style="font-size: 20px"></i>
                      <div class="text-right">
                        <h6 class="m-0">Rendez Vous</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-12">
          <div class="iq-edit-list-data">
            <div class="tab-content">
              <div class="tab-pane fade active show" id="liste-patients" role="tabpanel">
                <div class="row">
                  <div class="col-lg-12">
                    <List :items="patients" :formatedDate="formatedDate" :motifVisite="motifVisite" :docteurs="docteurs"
                      :cliniques="cliniques" :typeOperations="typeOperations">
                    </List>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="ajouter-patient" role="tabpanel">
                <Create :assurances="assurances" :villes="villes" :antecedents="antecedents" :docteurs="docteurs"
                  :motifVisite="motifVisite" />
              </div>
              <div class="tab-pane fade" id="rendez-vous" role="tabpanel">
                <div class="row">
                  <div class="col-lg-12">
                    <ListRendezVousToday :items="rendezVousToday" :formatedDate="formatedDate" :docteurs="docteurs"
                      :motifVisite="motifVisite">
                    </ListRendezVousToday>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="validee" role="tabpanel">
                <div class="row">
                  <div class="col-md-12">
                    <ListDone v-if="consultationDone" :items="consultationDone" :formatedDate="formatedDate"
                      :docteurs="docteurs">
                    </ListDone>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 h-full">
        <ListAtt :patientsAtt="patientsAtt" :docteurs="docteurs"></ListAtt>
      </div>
    </div>
  </AdminLayout>
</template>
<script setup>
import { ref, onMounted, computed } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import List from "./List.vue";
import ListRendezVousToday from "./ListRendezVousToday.vue";
import ListDone from "./ListDone.vue";
import Create from "./Create.vue";
import ListAtt from "./ListAtt.vue";
import introJs from "intro.js";
import HeaderState from "../Statistiques/HeaderStat.vue";
const tabs = computed(() => props.docteurs.map((docteur) => docteur.id));
//var listAtt = ref(props.patientsAtt);
const props = defineProps({
  patients: Object,
  patientsAtt: Object,
  visiteDone: Object,
  assurances: Object,
  villes: Object,
  antecedents: Object,
  formatedDate: "",
  docteurs: Object,
  rendezvous: Object,
  motifVisite: Object,
  cliniques: Object,
  typeOperations: Object,
  rendezVousToday: Object

});

const ListPatientsToDay = ref([]);
let consultationDone = ref(props.visiteDone);
let ListPatients = ref(props.patients.data);
let DocteurState = ref(props.docteurs);

// WebSockets Consultation Terminer & Ajouter List Patients
onMounted(() => {
  // introJs().start();
  consultationDone.value = props.visiteDone;
  window.Echo.channel("consultation-done").listen("ConsultationDone", (e) => {
    consultationDone.value = e.visiteDone;
  });

  ListPatients.value = props.patients.data;
  window.Echo.channel("add-to-list-patients").listen(
    "AddToListPatient",
    (e) => {
      ListPatients.value = e.patients;
      // ListPatientsToDay.value = ListPatients.value.filter((item) => {
      //     return item.rendez_vous && item.rendez_vous[0] && item.rendez_vous[0].dateRendezVous === getCurrentDate();
      // });
    }
  );
  // ListPatientsToDay.value = ListPatients.value.filter((item) => {
  //     return item.rendez_vous && item.rendez_vous[0] && item.rendez_vous[0].dateRendezVous === getCurrentDate();
  // });

  DocteurState.value = props.docteurs;
  window.Echo.channel("header-statistiques-doctor").listen(
    "HeaderStatistiquesDoctor",
    (e) => {
      DocteurState.value = e.docteur;
    }
  );
});

const getCurrentDate = () => {
  const currentDate = new Date();
  const day = currentDate.getDate().toString().padStart(2, "0");
  const month = (currentDate.getMonth() + 1).toString().padStart(2, "0"); // Months are zero-based
  const year = currentDate.getFullYear();
  return `${year}-${month}-${day}`;
};
</script>

<style>
@import "intro.js/introjs.css";
</style>
