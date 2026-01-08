<template>
    <div class="iq-card">
        <div class="iq-card-header iq-bg-warning d-flex justify-content-between" style="background-color: #ceebee ;">
            <div class="iq-header-title ">
                <h5 class="card-title">Rendez-Vous Du Jour </h5>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="form-group col-md-6 col-lg-4">
                <input type="search" class="form-control" placeholder="Chercher patient" id="RechercheRendezVous"
                    v-model="searchValue" />
            </div>
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="5" alternating table-class-name="customize-table">
                <template #item-operation="item">
                    <div class="row">

                        <button @click.prevent="showRow(item)" class="btn btn-info m-2" title="Details Patient">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button type="button" class="btn btn-primary m-2" title="Ajouter à la Liste d'attente"
                            @click.prevent="openAddListAttModal(item)">
                            <i class="ri-add-fill"></i>
                        </button>
                    </div>
                </template>
                <!-- <template #item-docteurss="item"> -->
                <!-- <span v-if="item.RendezVous.length > 0" class="text-success font-weight-bold font-size-15 text-center">
                        <span class="text-secondary font-weight-bold">{{ item.RendezVous[0].dateRendezVous }}<br></span>
                        <span class="text-primary">Dr. {{ item.RendezVous[0].docteur.name }}</span>
                    </span>
                    <span v-else class="text-dark  font-weight-bold">
                        Aucun Rendez-Vous
                    </span> -->
                <!-- </template> -->
                <template #item-docteurs="item">
                    {{ item.dateRendezVous }}
                </template>
                <template #empty-message>
                    <a href="">Aucun patient avec les données saisie</a>
                </template>
            </EasyDataTable>
        </div>
    </div>
    <!-- overlay every modal -->
    <div v-if="currentPatient" class="modal-overlay"></div>
    <!-- Modal Select Doctor and Add to List Attente -->
    <div class="modal" tabindex="-1" role="dialog" ref="addListAttModal">
        <div class="modal-dialog" role="document" v-if="currentPatient">
            <div class="modal-content" style="background-color: #eff7f8 ;">
                <div class="modal-header" style="background-color: #17a2b8;">
                    <h5 class="modal-title text-white">Liste d'attente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        @click="closeAddListAttModall">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-lg-6" v-if="currentPatient"
                            style="font-size: 20px; color: black; font-weight: bold;">
                            <!-- {{ currentPatient.nomPatient + " " + currentPatient.prenomPatient }} -->

                        </div>
                        <div class="col-lg-6" v-if="currentPatient"
                            style="font-size: 20px; color: black; font-weight: bold;">
                        </div>
                    </div>
                    <span hidden v-if="currentPatient">
                        <!-- {{ idP =currentPatient.id }} -->
                    </span>
                    <div class="row text-center" v-if="!StatePatient.statePatient">
                        <div class="col-lg-12 mt-4 text-danger font-size-16 font-weight-bold">
                            Veuillez Selectionner Le Motif De Visite
                        </div>
                    </div>
                    <div class="row mt-3" v-if="StatePatient.statePatient">
                        <div class="col-sm-6 col-md-3 col-lg-6">
                            <div class="iq-card border border-primary" style="min-height: 190px;">

                                <Link :href="'/patientsAtt/' + currentPatient.patient_id + '/' + currentPatient.user_id +
                                    '/' + StatePatient.statePatient
                                    " method="put" preserve-scroll preserve-state @click="closeAddListAttModall">
                                <div class="iq-card-body text-center">
                                    <div class="doc-profile">
                                        <img :src="currentPatient.docteur.profile_photo_path" class="avatar-100" alt="profile" />
                                    </div>
                                    <div class="iq-doc-info mt-3">
                                        <h5 style="font-weight: bold;"> {{ currentPatient.docteur.name }}
                                        </h5>

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
                                        <div
                                            class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                                            <input type="radio" :id="'customRadio-7-' + index"
                                                v-model="StatePatient.statePatient" :name="'customRadio'"
                                                :value="motif.motifVisite" class="custom-control-input bg-danger" />
                                            <label :for="'customRadio-7-' + index" class="custom-control-label">
                                                {{ motif.motifVisite }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-lg-12 text-dark font-size-16 font-weight-bold">Motif de Consultation</div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
//Reference
const searchValue = ref("");
const searchField = ref(["nomPatient", "prenomPatient", "cinPatient"]);
const currentPatient = ref(null);
const newRendezVousDate = ref(new Date());
const addListAttModal = ref(null);

//Define Props
const props = defineProps({
    items: Object,
    formatedDate: "",
    docteurs: Object,
    motifVisite: Object
});
const showRow = (item) => {
    router.get(route("patients.show", item));
};
//Headers Easy-DataTable
const headers = [
    { text: "CIN", value: "patient.cinPatient", sortable: true },
    { text: "Nom", value: "patient.nomPatient", sortable: true },
    { text: "Prénom", value: "patient.prenomPatient", sortable: true },
    { text: "Rendez-Vous", value: "docteurs", sortable: true },
    { text: "Opération", value: "operation", sortable: true },
];

//Open Modal Add List Att
const openAddListAttModal = (item) => {
    currentPatient.value = item;
    addListAttModal.value.style.display = 'block';
};
const closeAddListAttModall = () => {
    addListAttModal.value.style.display = 'none';
    currentPatient.value = null;
};
//Formated Date function
function formatDate(date) {
    if (!(date instanceof Date)) {
        return '';
    }
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}-${month}-${year}`;
}
const StatePatient = useForm({
    statePatient: ''
});

</script>
<script>
export default {
    data() {
        return {
            locale: "",
            currentPatient: null,
            newRendezVousDate: new Date(),
        };
    },
    methods: {
    },
};
</script>
<style>
.customize-table {
    --easy-table-body-row-font-size: 11px;
    --easy-table-header-font-size: 14px;
    --easy-table-header-font-color: #010101;
    --easy-table-header-background-color: #ceebee;
    --easy-table-body-row-hover-background-color: #eee;
    --easy-table-body-item-padding: 6px 15px;
    --easy-table-footer-font-color: #040c0e;
    --easy-table-footer-font-size: 14px;
    --easy-table-footer-height: 50px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-body-row-hover-font-color: #002561;
    --easy-table-body-row-hover-background-color: #ceebee;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(0, 0, 0);
    z-index: 1000;
}

.modal {
    z-index: 2000;
}
</style>
