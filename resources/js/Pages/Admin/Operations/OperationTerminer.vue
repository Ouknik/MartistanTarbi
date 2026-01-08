<template>
    <div class="row">
        <div class="col-lg-12 p-4">
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="4" alternating
                table-class-name="customize-table">
                <template #empty-message>
                    <a href="">Aucun patient avec les données saisie</a>
                </template>
                <template #item-etatOperation="item">
                   {{ item.etatOperation }}
                </template>
            </EasyDataTable>
        </div>
    </div>
</template>

<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { useToast } from 'vue-toast-notification';
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import { format } from 'date-fns';


const searchValue = ref("");
const searchField = ref(["nomPatient", "prenomPatient", "cinPatient"]);
const props = defineProps({
    patients: Object,
    ProchaineOperations: Object,
    items: Object,

});


const headers = [
    { text: "CIN", value: "cinPatient", sortable: true },
    { text: "Nom", value: "nomPatient", sortable: true },
    { text: "Prénom", value: "prenomPatient", sortable: true },
    { text: "Date Opération", value: "dateOperation", sortable: true },
    { text: "Prix Opération", value: "prixOperation", sortable: true },
    { text: "Type", value: "nomOperation", sortable: true },
    { text: "Clinique", value: "clinique", sortable: true },
    { text: "Etat", value: "etatOperation", sortable: true },

];
const currentPatient = ref(null);
const newRendezVousDate = ref(new Date());
const addRendezVousModal = ref(null);



const openAddRendezVousModal = (item) => {
    currentPatient.value = item;
    rendezvous.patient_id = item.id;
    addRendezVousModal.value.style.display = 'block';
};

const closeAddRendezVousModal = () => {
    addRendezVousModal.value.style.display = 'none';
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
const rendezvous = useForm({
    dateRendezVous: newRendezVousDate.value,
    patient_id: 1,
    docteur_id: 1
});

const updateStatus = (patient) => {
    router.visit(`/patientStateCons/${patient.id}`, {
        method: "put",
        data: { statutPatient: patient.radioState },
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => { useToast().success('Statut du patient modifié', { position: 'bottom-right', duration: 3000 }); },
    });
};
const addRendezVous = () => {
    const formattedDate = format(newRendezVousDate.value, 'yyyy-MM-dd'); // Formater la date au format 'yyyy-MM-dd'

  

    rendezvous.dateRendezVous = formattedDate;
    router.visit("/rendezVous", {
        method: "post",
        data: rendezvous,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        onProgress: (progress) => { },
        onSuccess: page => {
            useToast().success('Rendez Vous  Ajouter', { position: 'bottom-right', duration: 3000 });
            closeAddRendezVousModal(); // close the modal
        },

        onError: errors => {
            useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 });
        },
    });

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

        };
    },
    methods: {
        handleSave() {
            this.showModal = false;
        },

    },
};
</script>
<style>
.customize-table {
    --easy-table-body-row-font-size: 16px;
    --easy-table-header-font-size: 19px;
    --easy-table-header-height: 50px;
    --easy-table-body-row-hover-background-color: #eee;
    --easy-table-body-item-padding: 10px 15px;
    --easy-table-footer-font-color: #1d5d65;
    --easy-table-footer-font-size: 14px;
    --easy-table-footer-height: 50px;

    --easy-table-header-background-color: #f1f2f1 ;

}
</style>
