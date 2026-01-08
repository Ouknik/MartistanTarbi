<template>
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between iq-bg-secondary" style="background-color: #ceebee ;">
            <div class="iq-header-title">
                <h5 class="card-title text-dark">Liste Viste Terminée</h5>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="form-group col-md-6 col-lg-4">
                <input type="search" class="form-control" placeholder="Chercher patient" id="cno" v-model="searchValue" />
            </div>
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="rowPerPage" alternating>
                <template #item-operation="item">
                    <div class="d-flex justify-content-center align-items-center ">
                        <button :class="calculateDifference(item) != 0 ? 'btn-danger' : 'btn-success'"
                            :disabled="calculateDifference(item) === 0" type="button" class="btn"
                            @click.prevent="openReglementModal(item)">
                            <i class="ri-exchange-dollar-line"></i>
                        </button>
                    </div>
                </template>
                <template #item-show="item">
                    <button type="button" @click="openFactureModal(item)" data-toggle="modal"
                        data-target=".bd-FactureviewDone-modal-lg" :disabled="calculateDifference(item) !== 0"
                        :class="calculateDifference(item) != 0 ? 'btn-danger' : 'btn-success'"
                        class="btn btn-secondary m-2">
                        <i class="ri-printer-line text-white"></i>
                    </button>

                </template>
                <template #item-rendezVous="item">
                    <button type="button" data-toggle="modal" @click="GestionRendezVousModal(item)"
                        data-target=".bd-GestionRendezVous2-modal-lg" class="btn btn-warning m-2">
                        <i class="ri-calendar-line text-white"></i>
                    </button>

                </template>
                <template #item-patient="item">
                    <button @click.prevent="showRow(item)" class="btn btn-info" title="Details Patient">
                        <i class="ri-eye-line"></i>
                    </button>

                </template>
                <template #item-reglement="item">
                    <!-- <button type="button" data-toggle="modal" @click="opendeleteReglementModal(item)"
                         class="btn btn-warning m-2">
                        <i class="ri-calendar-line text-white"></i>
                    </button> -->

                    <button class="btn btn-danger" type="button" @click.prevent="opendeleteReglementModal(item)">
                        <i class="ri-exchange-dollar-line"></i>
                    </button>

                </template>
                <template #item-motif="item">
                    {{ item.statutPatient }}
                </template>
                <template #item-DateFacture="item">
                    {{ item.dateFacture }}
                </template>
                <template #item-montantFacture="item">
                    <span v-if="item.factures[0]" class="text-danger font-weight-bold font-size-16"> {{ item.factures[0].montantFacture }} <span
                            class="text-dark font-size-16">DH</span></span>
                </template>
                <template #item-montantReglement="item">
                    <span v-for="total in item.patient.TotalByDoctorToDay" v-bind:key="total.id">
                        <span v-if="item.user_id == total.id" class="text-success font-weight-bold font-size-16"> {{
                            total.total_reglements }}
                            <span class="text-dark font-size-16">DH</span></span>
                    </span>
                </template>
                <template #item-Patientassurance="item">
                    <span class="text-dark font-weight-bold">
                        {{ item.patient.assurance.typeAssurance }} </span>
                </template>
                <template #empty-message>
                    <span class="text-danger font-size-18">Aucune visite pour le moment</span>
                </template>
            </EasyDataTable>
        </div>
    </div>
    <div v-if="currentPatient" class="modal-overlay"></div>
    <!-- Add Reglement Modal -->
    <div class="modal" tabindex="-1" role="dialog" ref="addReglementModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #eff7f8 ;">
                <div class="modal-header bg-secondary">
                    <h5 v-if="currentPatient" class="modal-title text-white">Reglement {{
                        currentPatient.patient.nomPatient }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        @click="closeaddReglementModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-lg-6" v-if="currentPatient"
                            style="font-size: 20px; color: black; font-weight: bold;">
                            {{ currentPatient.patient.prenomPatient + " " + currentPatient.patient.nomPatient }}
                        </div>
                        <div class="col-lg-6" v-if="currentPatient"
                            style="font-size: 20px; color: black; font-weight: bold;">
                            {{ formatDate(newRendezVousDate) }}
                        </div>
                    </div>
                    <div class="row mt-4 ml-2" v-if="currentPatient">
                        <div class="col-lg-12 text-dark">
                            <p class="font-weight-bold ">Date Facture : {{ currentPatient.factures[0].dateFacture }}</p>
                            <p>Consulter Par Dr. <span>{{ currentPatient.docteur.name }}</span></p>
                            <p class="font-weight-bold">Montant Facture : <span class="text-danger">{{
                                calculateDifference(currentPatient) + " DH" }}</span></p>
                            <p class="font-weight-bold"> <input v-model="Reglement.montantReglement" type="text"
                                    @input="handleMontantInputChange" class="form-control mt-3 bg-white"
                                    id="montantReglement" placeholder="Saisir le Montant à régler">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 ml-2 mt-2">
                            <select class="form-control" v-model="Reglement.modePaiement">
                                <option selected disabled>Mode Paiement</option>
                                <option value="Cash">Cash</option>
                                <option value="Chéque">Chéque</option>
                                <option value="Virement">Virement</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="font-size: 16px;" :class="{
                        'btn btn-secondary text-white': !isMontantReglementValid,
                        'btn btn-success': isMontantReglementValid,
                        'btn btn-danger': !isMontantReglementValid
                    }" :disabled="!isMontantReglementValid || isButtonDisabled" @click="AddReglement">
                        Ajouter Réglement
                    </button>
                    <button type="button" style="font-size: 16px;" class="btn btn-secondary" data-dismiss="modal"
                        @click="closeaddReglementModal">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Manage Reglement Modal -->
    <GestionRendezVous :docteurs="docteurs" :currentPatient="currentPatientRD2"></GestionRendezVous>
    <!-- Print Facture Modal -->
    <div class="modal" tabindex="-1" role="dialog" ref="FactureModal">
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">
                            Note d'honoration

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" @click="closeFactureModal">×</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="currentPatient">
                        <HeaderDocteur></HeaderDocteur>
                        <div id="printable-contentFactureDone">
                            <div class="header" style=" text-align: center; ">
                                <h4 style="font-size: 15px; "> Taroudant Le : {{ currentPatient.factures[0].dateFacture }} :
                                    تارودانت في </h4>
                                <h1 class="facture mt-2">Note d'honoration</h1>
                                <h4 class="mt-2" style="font-size: 18px;"> {{
                                    currentPatient.patient.nomPatient + " "
                                    + currentPatient.patient.prenomPatient }}
                                </h4>
                            </div>
                            <div class="invoice-details"
                                style="font-size: 23px; font-family: Verdana, Geneva, Tahoma, sans-serif; color: black; text-align: justify;">
                                <table border="1" style="width: 100%;">

                                    <thead class="text-center">
                                        <tr>
                                            <th>N°</th>
                                            <th>Désignation</th>
                                            <th>Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">

                                        <tr v-for="(soin, index) in JSON.parse(currentPatient.factures[0].soins)"
                                            :key="index">
                                            <td class="center">{{ index + 1 }}</td>
                                            <td> {{ soin.libelleSoin }}</td>
                                            <td class="center text-center"> {{ soin.montantSoin + " DH" }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2" class="text-start font-weight-bold center">Total </td>
                                            <td class="center font-weight-bold">{{ currentPatient.factures[0].montantFacture
                                                + " DH" }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <p class="text-left text-black" id="footer-facture" style="font-size: 12px;">
                                    Arrêter la Présente Note à la Somme de
                                    <span> {{ currentPatient.factures[0].montantLettre }}</span> Dirhams
                                    (<span>{{ currentPatient.factures[0].montantFacture }}</span> DH )
                                </p>

                            </div>
                        </div>
                        <div class="footer-cer">
                            <FooterDocteur></FooterDocteur>
                        </div>
                        <div class="text-right">
                            <button style="font-size: 20px" @click="printInvoice()" type="button"
                                class="btn btn-outline-primary  mt-3">
                                <i class="ri-printer-line"></i>Imprimer
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Delete Reglement Modal -->
    <div class="modal" tabindex="-1" role="dialog" ref="deleteReglementModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #eff7f8 ;">
                <div class="modal-header bg-secondary">
                    <h5 v-if="currentPatient" class="modal-title text-white">Reglement {{
                        currentPatient.patient.nomPatient }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        @click="closedeleteReglementModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-lg-6" v-if="currentPatient"
                            style="font-size: 20px; color: black; font-weight: bold;">
                            {{ currentPatient.patient.prenomPatient + " " + currentPatient.patient.nomPatient }}
                        </div>
                        <div class="col-lg-6" v-if="currentPatient"
                            style="font-size: 20px; color: black; font-weight: bold;">
                        </div>
                    </div>
                    <div class="row mt-4 ml-2" v-if="currentPatient">
                        <div class="table-responsive-md w-100">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Motif</th>
                                        <th>Montant</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="reglement in currentPatient.patient.reglement_facture"
                                        v-bind:key="reglement.id">
                                        <td contenteditable="false">{{ reglement.dateReglement }}</td>
                                        <td contenteditable="false">{{ reglement.motifVisite }}</td>
                                        <td>
                                            {{ reglement.montantReglement }} DH
                                        </td>
                                        <td>
                                            <span class="table-remove"><button type="button"
                                                    @click="deleteReglement(reglement)"
                                                    class="btn iq-bg-danger btn-rounded btn-sm my-0">Supprimer</button></span>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" style="font-size: 16px;" class="btn btn-danger" data-dismiss="modal"
                        @click="closedeleteReglementModal">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { useToast } from 'vue-toast-notification';
import { ref, computed } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { format } from 'date-fns';
import GestionRendezVous from "../RendezVous/GestionRendezVous2.vue";
import FooterDocteur from "../../../Layouts/Template/FooterDocteur.vue";
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";

const searchValue = ref("");
const searchField = ref(["nomPatient", "prenomPatient", "cinPatient"]);
const currentPatient = ref(null);
const currentPatientRD2 = ref(null);
const newRendezVousDate = ref(new Date());
const addReglementModal = ref(null);
const deleteReglementModal = ref(null);

const FactureModal = ref(null);
const isButtonDisabled = ref(false);
const props = defineProps({
    items: Object,
    rowPerPage: Number,
    formatedDate: "",
    docteurs: Object
});

const Reglement = useForm({
    dateReglement: '',
    montantReglement: '',
    modePaiement: 'Cash',
    motifVisite: '',
    patient_id: '',
    user_id: ''
});
const openFactureModal = (item) => {
    currentPatient.value = item;
    FactureModal.value.style.display = 'block';
};
const closeFactureModal = () => {
    FactureModal.value.style.display = 'none';
    currentPatient.value = null;
};

const showRow = (item) => {
    router.get(route("patients.show", item.patient));
};
const AddReglement = () => {
    const formattedDate = format(newRendezVousDate.value, 'yyyy-MM-dd');
    Reglement.dateReglement = formattedDate;
    Reglement.patient_id = currentPatient.value.patient.id;
    Reglement.user_id = currentPatient.value.docteur.id;
    Reglement.motifVisite = currentPatient.value.patient.statutPatient;
    isButtonDisabled.value = true;
    router.visit("ReglementFacture", {
        method: "post",
        data: Reglement,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        onProgress: (progress) => { },
        onSuccess: page => {
            useToast().success('Réglement Vous  Ajouter', { position: 'bottom-right', duration: 3000 });
            closeaddReglementModal();
            isButtonDisabled.value = false;
        },
        onError: errors => {
            useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 });
            isButtonDisabled.value = false;
        },
    });
};
const isMontantReglementValid = computed(() => {
    if (currentPatient.value) {
        const montantReglement = parseFloat(Reglement.montantReglement);
        const modePaiement = Reglement.modePaiement;
        if (
            montantReglement == 0 ||
            montantReglement < 0 ||
            calculateDifference(currentPatient.value) < montantReglement ||
            isNaN(montantReglement) ||
            !modePaiement
        ) {
            return false;
        }
    }
    return true;
});



props.items.forEach(item => {
    item.radioState = 'Primary'; // valeur initiale
});

const headers = [
    { text: "Nom", value: "patient.nomPatient", sortable: true },
    { text: "Prénom", value: "patient.prenomPatient", sortable: true },
    { text: "Assurance", value: "Patientassurance", sortable: true },
    { text: "Motif De Visite", value: "patient.statutPatient", sortable: true },
    // { text: "Docteur", value: "docteur.name", sortable: true },
    { text: "Montant", value: "montantFacture", sortable: true },
    { text: "Reglement", value: "montantReglement", sortable: true },
    { text: "Facture", value: "operation", sortable: true },
    { text: "Patient", value: "patient", sortable: true },

    { text: "Imprimer", value: "show", sortable: true },
    { text: "Rendez Vous", value: "rendezVous", sortable: true },
    { text: "Supprimer Reglement", value: "reglement", sortable: true },

];


const isDateValid = (dateString) => {
    const date = new Date(dateString);
    return !isNaN(date.getTime()) && date < new Date();
};


const calculateDifference = (item) => {
    const test = item.patient.TotalByDoctorToDay;
    for (let i = 0; i < test.length; i++) {
        if (item.user_id == test[i].id) {
            return test[i].total_factures - test[i].total_reglements;
        }

    }
};

const openReglementModal = (item) => {
    currentPatient.value = item;
    addReglementModal.value.style.display = 'block';
};

const closeaddReglementModal = () => {
    addReglementModal.value.style.display = 'none';
    currentPatient.value = null;
};


const opendeleteReglementModal = (item) => {
    currentPatient.value = item;
    deleteReglementModal.value.style.display = 'block';
};

const closedeleteReglementModal = () => {
    deleteReglementModal.value.style.display = 'none';
    currentPatient.value = null;
};




const GestionRendezVousModal = (item) => {
    currentPatientRD2.value = item.patient;
};


function formatDate(date) {
    if (!(date instanceof Date)) {
        return '';
    }
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();

    return `${day}-${month}-${year}`;
}

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
            closedeleteReglementModal();
        },
        onError: (errors) => {
            useToast().error('Erreur Lors de La  Suppression', { position: 'bottom-right', duration: 3000 });
        },
    })
};

</script>
<script>

export default {
    data() {
        return {
            showModal: null,
            modalTitle: "My Modal",
            modalCloseButton: "Close",
            modalSaveButton: "Save",
            locale: "",
            currentPatient: null,
            newRendezVousDate: new Date(),
            SelectedPatient: null,
        };
    },
    methods: {
        reverseDate(date) {
            return date.split('-').reverse().join('-');
        },
        printInvoice() {
            const printContents = document.getElementById('printable-contentFactureDone').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(`
        <html>
        <head>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 110px;
                    padding: 10px;
                }
                .invoice-details {
                    line-height: 1.9;
                }
                .invoice-details table td {
                    text-align: center;
                }
                .invoice-details table td, .invoice-details table th {
                    border: 1px solid black;
                }
            </style>
        </head>
        <body>
            <div class="print-container">${printContents}</div>
        </body>
        </html>
    `);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    },
    mounted() {
        document.addEventListener('DOMContentLoaded', () => {
            this.printInvoice();
        });
    },
};
</script>
<style>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 1000;
}

.modal {
    /* le reste de votre CSS modal ici */
    z-index: 2000;
}

#printable-contentFactureDone {
    margin-top: 300px;
}

.header {
    margin-top: 15%;
}

.custom-margin-left {
    margin-left: 50px;
}

h1.facture {
    font-size: 55px;
}
</style>
