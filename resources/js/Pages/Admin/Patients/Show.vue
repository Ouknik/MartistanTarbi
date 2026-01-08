<template>
    <span hidden>
        {{ user = $page.props.user }}
    </span>
    <AdminLayout>
        <div class="row">
            <div class="col-md-12 col-lg-9">
                <HeaderStatistiquesDoctors :docteur="docteurs">
                </HeaderStatistiquesDoctors>
                <div class="row">
                    <div class="p-0 m-0 col-lg-3 row">
                        <div class="col-sm-12">
                            <div class="iq-card">
                                <div class="pt-0 pl-0 pr-0 iq-card-body">
                                    <div class="iq-card-block iq-card-stretch iq-user-profile-block">
                                        <div class="user-details-block">
                                            <div class="doc-profile-bg color-template" style="height: 100px"></div>
                                            <div class="text-center user-profile">
                                                <img :src="patient.sexePatient == 'Masculin'
                                                    ? '/images/user/14.jpg'
                                                    : '/images/user/11.png'
                                                    " alt="profile-img" class="rounded-circle img-fluid avatar-110" />

                                            </div>
                                            <div class="mt-2 text-center">
                                                <h5>
                                                    {{ patient.civilitePatient }} .<b>{{ patient.nomPatient }}
                                                        {{ patient.prenomPatient }}</b>
                                                </h5>
                                                <h5><b>{{ patient.villePatient }}</b> -<b>{{ patient.adressePatient
                                                        }}</b>
                                                </h5>
                                                <h5>
                                                    Âge : <b>{{ age }} Ans</b>
                                                </h5>
                                                <h5>
                                                    Tele : <b>{{ patient.telephonePatient }}</b>
                                                </h5>
                                            </div>
                                            <div class="mt-2 text-center">
                                                <h5>
                                                    Assurance : <b>{{ AssuranceData[0].typeAssurance }} </b>
                                                </h5>
                                                <h5 v-if="patient.conjointPatient">
                                                    Conjoint : <b>{{ patient.conjointPatient }} </b>
                                                </h5>
                                            </div>
                                            <div>
                                            </div>
                                            <div v-if="gestationnelle">
                                                <div v-for="GS in props.gestationnelle" :key="GS.id"
                                                    class="mt-2 ml-2 text-left" style="font-size: 15px;">
                                                    <span hidden>{{ DateGrossesse = GS.dateGrosesse }}</span>
                                                    <h6 style="margin-bottom: 15px;">
                                                        DDR : {{ GS.dateDernierRegle }}
                                                    </h6>
                                                    <div v-if="isDateValid(GS.dateAccouchement)">
                                                        <h6 style="margin-bottom: 15px;">
                                                            Grossesse : {{ DateGrossesse }}
                                                        </h6>
                                                        <h6>
                                                            Accouchement : {{ GS.dateAccouchement }}
                                                        </h6>
                                                    </div>
                                                    <div>
                                                        <h4> AGGSS : {{ patient.AGGSS }} </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-1 mt-2 text-center">
                                                <button type="button" class="btn btn-primary btn-block"
                                                    style="font-size: small;" data-toggle="modal"
                                                    data-target="#updatePatient">
                                                    <i class="ri-user-settings-fill"></i>Modifier Informations
                                                </button>
                                                <button type="button" @click="confirmDeletePatient(patient)"
                                                    class="btn btn-danger btn-block" style="font-size: small;">
                                                    <i class="ri-user-unfollow-fill"></i>Supprimer Le Patient
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="mt-2 iq-card">
                            <div class="p-0 iq-card-header d-flex justify-content-between color-template">
                                <div class="iq-header-title">
                                    <h4 class="p-2 text-white card-title"
                                        style="font-size: 25px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                                        Histoire Maladie
                                    </h4>
                                </div>
                                <div class="text-right">
                                    <button type="button" class="mt-3 mb-3 mr-2 text-black btn btn-outline-light"
                                        style="font-size: 20px;" @click="showcreateConsult = true">
                                        <i class="ri-add-fill"></i>
                                        Ajouter Consultation
                                    </button>
                                </div>
                            </div>
                            <div class="p-0 iq-card-body" style="min-height: 410px;">
                                <EasyDataTable buttons-pagination :items="consultations" :headers="headers"
                                    :search-value="searchValue" :search-field="searchField" :rows-per-page="4"
                                    table-class-name="customize-table" alternating>
                                    <template #header-dateConsultation="header">
                                        <div class="mb-3 mt-0">
                                            <i class="ri-calendar-2-line"></i>
                                            {{ header.text }}
                                        </div>

                                    </template>
                                    <template #header-motifConsultation="header">
                                        <div class="mb-3 mt-0">
                                            <i class="ri-contacts-book-line"></i>

                                            {{ header.text }}
                                        </div>
                                    </template>
                                    <template #header-operations="header">
                                        <div class="mb-1 mt-0">
                                            <i class="ri-settings-3-line"></i>
                                            {{ header.text }}
                                        </div>
                                    </template>
                                    <template #item-dateConsultation="item">
                                        <span v-if="ordonnanceConslt">
                                            <span v-if="ordonnanceConslt.id == item.id">
                                                <i class="ri-focus-2-fill text-success" style="font-size: 25px;"></i>
                                            </span>
                                        </span>
                                        {{ item.dateConsultation }}
                                    </template>
                                    <template #item-operations="item">
                                        <button @click="showConsultation(item)
                                            " class="m-2 btn btn-primary">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                        <button class="m-2 btn btn-secondary" @click="updateConsultationData(item)
                                            " type="button" data-toggle="modal" data-target="#updateConsultation">
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <button @click="confirmDelete(item)" class="m-2 btn btn-danger">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </template>
                                    <template #expand="item">
                                        <div style="padding: 15px">
                                            {{ item.descriptionConsultation }}
                                        </div>
                                    </template>
                                    <template #empty-message>
                                        <a href="">Aucune consultation pour ce patient</a>
                                    </template>
                                </EasyDataTable>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <AntecedentsUpdate :antecedentsPatientData="props.antecedentsPatient"></AntecedentsUpdate>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="iq-card" style="min-height: 1000px;">
                            <div class="iq-card-header d-flex justify-content-between color-template">
                                <div class="iq-header-title">
                                    <h4 class="text-white card-title"
                                        style="font-size: 25px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                                        Détails Consultation</h4>
                                </div>
                                <div class="text-right" v-if="ordonnanceConslt">
                                    <button type="button" class="mt-3 mb-3 ml-5 text-black btn btn-outline-light"
                                        style="font-size: 20px;" @click="gelAllConsultation">
                                        <i class="ri-focus-2-fill"></i>
                                        Toutes Les Consultations
                                    </button>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <ul class="mb-3 nav nav-pills nav-fill" id="pills-tab-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            style="font-size: 18px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;"
                                            id="pills-factures-tab-fill" data-toggle="pill" href="#pills-factures-fill"
                                            role="tab" aria-controls="pills-factures" aria-selected="false">Facture</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link "
                                            style="font-size: 18px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;"
                                            id="pills-ordonnances-tab-fill" data-toggle="pill"
                                            href="#pills-ordonnances-fill" role="tab" aria-controls="pills-ordonnances"
                                            aria-selected="true">Ordonnances</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            style="font-size: 18px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;"
                                            id="pills-certificats-tab-fill" data-toggle="pill"
                                            href="#pills-certificats-fill" role="tab" aria-controls="pills-certificats"
                                            aria-selected="false">Certificat</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            style="font-size: 18px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;"
                                            id="pills-echographies-tab-fill" data-toggle="pill"
                                            href="#pills-echographies-fill" role="tab"
                                            aria-controls="pills-echographies" aria-selected="false">Echographie</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            style="font-size: 18px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;"
                                            id="pills-documents-tab-fill" data-toggle="pill"
                                            href="#pills-documents-fill" role="tab" aria-controls="pills-documents"
                                            aria-selected="false">E-Documents</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            style="font-size: 18px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;"
                                            id="pills-analyses-tab-fill" data-toggle="pill" href="#pills-analyses-fill"
                                            role="tab" aria-controls="pills-analyses" aria-selected="false">Analyses</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent-1">
                                    <ListFactures :soinsF="soins"
                                        :factures="ordonnanceConslt == null ? factures : ordonnanceConslt.factures"
                                        :patient="patient">
                                    </ListFactures>
                                    <ListOrdonnances
                                        :ordonnances="ordonnanceConslt == null ? ordonnances : ordonnanceConslt.ordonnances"
                                        :patient="patient" :medicaments="medicaments"
                                        :idConsultation="ordonnanceConslt != null ? ordonnanceConslt.id : 0">
                                    </ListOrdonnances>
                                    <ListCertificat :certificats="certificats" :patient="patient" :age="age"
                                        :docteur="user">
                                    </ListCertificat>
                                    <ListEchographie :age="age" :gestationnelle="props.gestationnelle"
                                        :echographies="ordonnanceConslt == null ? Echographies : ordonnanceConslt.echographies"
                                        :idConsultation="ordonnanceConslt != null ? ordonnanceConslt.id : 0"
                                        :documents="documents" :patient="patient"
                                        :EchoDebutGrossesse="getEchographie(EchographieDG, 'echographie_debut_de_grossesse')"
                                        :EchoPelvienne="getEchographie(EchographieP, 'echographie_pelvienne')"
                                        :EchoPremierTrimestre="getEchographie(EchographiePT, 'echographie_premier_trimestre')"
                                        :EchoDeuxiemeTrimestre="getEchographie(EchographieDT, 'echographie_deuxieme_trimestre')"
                                        :EchoPremierTrimetreG="getEchographie(EchographiePTG, 'echographie_premier_trimestre_gem')"
                                        :EchoDeuxiemeTrimestreG="getEchographie(EchographieDTG, 'echographie_deuxieme_trimestre_gem')"
                                        :EchoMammaire="getEchographie(EchographieM, 'echographie_mammaire')"
                                        :EchoNormale="getEchographie(EchographieN, 'echographie_normale')"
                                        :EchoGynecologique="getEchographie(EchographieG, 'echographie_gynecologiques')"
                                        :test="ordonnanceConslt != null ? ordonnanceConslt.echographie_normale : null">
                                    </ListEchographie>
                                    <div v-if="ordonnanceConslt">
                                    </div>
                                    <ListAnalyse :consultations="consultations" :patient="patient"
                                        :familleanalyses="familleanalyses" :sousAnalyses="sousAnalyses"></ListAnalyse>
                                    <ListDocuments :documents="documents" :patient="patient"></ListDocuments>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- List Attente -->
            <div class="h-full col-lg-3">
                <ListAtt :patientsAtt="patientsAtt" :docteurs="docteurs"></ListAtt>
            </div>
        </div>
        <CreateDocument :patient="patient"></CreateDocument>
        <createCertificatConsultation :patient="patient" :docteur="docteur"></createCertificatConsultation>
        <CreateCertificatRepos :patient="patient" :docteur="docteur"></CreateCertificatRepos>
        <CreateCertificatGrossesse :DateGrossesse="DateGrossesse" :patient="patient" :docteur="docteur">
        </CreateCertificatGrossesse>
        <CreateCertificatAccompagnement :patient="patient" :docteur="docteur"></CreateCertificatAccompagnement>
        <CertificatView :patient="patient" :age="age" :user="user"></CertificatView>
        <Edit :patient="patient" :assurances="assurances" :motifVisite="motifVisite" :villes="villes"></Edit>
        <!-- Large modal -->
        <MyModal :show="showcreateConsult" @close="showcreateConsult = false">
            <template #title>
                <h5 class="text-white modal-title">
                    Dossier Medicales:
                    {{ patient.nomPatient + " " + patient.prenomPatient }}
                </h5>
            </template>
            <createConsultation :sousAnalyses="sousAnalyses" :familleanalyses="familleanalyses" :patient="patient"
                :medicaments="medicaments" :soins="soins" :traitements="traitements" :HistoireMaladies="consultations"
                @handelConsultation="handleConsultationAdded">
            </createConsultation>

        </MyModal>
        <updateConsultation v-if="ConsultationData" :consultation="ConsultationData"></updateConsultation>
    </AdminLayout>

</template>

<script setup>
import MyModal from "@/Components/ModalC.vue";
import { useForm, router, Link } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, onMounted, defineAsyncComponent, watch } from "vue";
import EasyDataTable from "vue3-easy-data-table";
import Swal from 'sweetalert2';
import "sweetalert2/dist/sweetalert2.min.css";
import HeaderStatistiquesDoctors from "../Statistiques/HeaderStat.vue";
import ListOrdonnances from "../Ordonnances/ListOrdonnance.vue";
import ListFactures from "../Factures/ListFacture.vue";
import ListEchographie from "../Documents/ListEchographie.vue";
import ListCertificat from "../Certificats/ListCertificat.vue";
import CertificatView from "../Certificats/ViewCertificat.vue";
import ListAnalyse from "../Analyses/ListAnalyse.vue";
import ListAtt from "./ListAtt.vue";
import ListDocuments from "../Documents/ListDocuments.vue";
//Import Edit
import Edit from "./Edit.vue";
import updateConsultation from "../Consultations/EditConsultation.vue";
//Import Create

const createCertificatConsultation = defineAsyncComponent(() =>
    import('../Certificats/CreateCertificatConsultation.vue')
)
const CreateCertificatGrossesse = defineAsyncComponent(() =>
    import('../Certificats/CreateCertificatGrossesse.vue')
)
const CreateCertificatRepos = defineAsyncComponent(() =>
    import('../Certificats/CreateCertificatRepos.vue')
)
const CreateCertificatAccompagnement = defineAsyncComponent(() =>
    import('../Certificats/CreateCertificatAccompagnement.vue')
)
const createConsultation = defineAsyncComponent(() =>
    import('../Consultations/CreateConsultation.vue')
)
const CreateDocument = defineAsyncComponent(() =>
    import('../Documents/CreateDocument.vue')
)
const AntecedentsUpdate = defineAsyncComponent(() =>
    import('../Patients/AntecedentsUpdate.vue')
)
const searchValue = ref("");
const searchField = ref(["motifConsultation", "id"]);
const showcreateConsult = ref(false);
const ordonnanceConslt = ref(null);
const ConsultationData = ref(null);
const props = defineProps({
    patientsAtt: Object,
    patient: Object,
    motifVisite: Object,
    soins: Object,
    consultations: Object,
    assurances: Object,
    antecedentsPatient: Object,
    ordonnances: Object,
    factures: Object,
    documents: Object,
    certificats: Object,
    medicaments: Array,
    sousAnalyses: Object,
    familleanalyses: Object,
    age: Number,
    assurance: Object,
    user: Object,
    gestationnelle: Object,
    traitements: Object,
    docteurs: Object,
    villes: Object,
    EchographieDG: Object,
    EchographieP: Object,
    EchographiePT: Object,
    EchographieDT: Object,
    EchographiePTG: Object,
    EchographieDTG: Object,
    EchographieM: Object,
    EchographieN: Object,
    EchographieG: Object,
    Echographies: Object,
    docteur: Object
});

function showConsultation(consultation) {
    ordonnanceConslt.value = consultation;
}
function updateConsultationData(consultation) {
    ConsultationData.value = consultation;
}
const confirmDelete = (consultation) => {
    Swal.fire({
        title: 'Suppression',
        text: 'Voulez-vous vraiment supprimer cette Consultation ?',
        icon: 'question',
        showCancelButton: true,
    }).then((result) => {

        if (result.isConfirmed) {
            deleteConsultation(consultation);
        }
    });
    const deleteConsultation = (consultation) => {
        router.delete(`/consultations/${consultation.id}`, {
            preserveState: false,
            preserveScroll: false,
            errorBag: null,
            forceFormData: false,
            onProgress: (progress) => { },
            onSuccess: (page) => {
                useToast().info("Consultation Supprimer", {
                    position: "bottom-right",
                    duration: 3000,
                });
            },
            onError: (errors) => {
                alert("Erreurs");
            },
        });
    };
}
const isDateValid = (dateString) => {
    const date = new Date(dateString);
    return !isNaN(date.getTime()) && date >= new Date();
};
const confirmDeletePatient = (patient) => {
    Swal.fire({
        title: 'Suppression',
        text: 'Voulez-vous vraiment supprimer ? ' + patient.nomPatient + ' ' + patient.prenomPatient,
        icon: 'question',
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            deletePatient(patient);
        }
    });

    const deletePatient = (patient) => {
        router.delete(`/patients/${patient.id}`, {
            preserveState: false,
            preserveScroll: false,
            errorBag: null,
            forceFormData: false,
            onProgress: (progress) => { },
            onSuccess: (page) => {
                useToast().success("Patient Supprimer", {
                    position: "bottom-right",
                    duration: 3000,
                });
                $('#exampleModal').modal('hide');
            },
            onError: (errors) => {
                alert("Erreurs");
            },
        });
    };
}
function getEchographie(type, echographieType) {
    if (!ordonnanceConslt.value) {
        return type;
    }
    return ordonnanceConslt.value[echographieType];
}
const headers = [
    { text: "Date Consultation", value: "dateConsultation", sortable: true },
    { text: "Motif Consultation", value: "motifConsultation", sortable: true },
    { text: "Operations", value: "operations" },
];
function gelAllConsultation() {
    ordonnanceConslt.value = null;
}
let DateGrossesse = ref();
const gestationnelle = useForm({
    dateDernierRegle: "",
    dateGrosesse: "",
    dateAccouchement: "",
    patient: props.patient.id
});
let PatientData = ref(props.patient);
let AssuranceData = ref(props.assurance);
watch(() => props.patient, (newValue, oldValue) => {
    PatientData.value = newValue;
});
onMounted(() => {
    window.Echo.channel('consultations-patient-done').listen('Consultations', (e) => {
        gelAllConsultation;
    });
    window.Echo.channel('patient-show').listen('PatientEvent', (e) => {
        PatientData.value = e.patient;
        AssuranceData.value = e.assurance;
    });
});

const handleConsultationAdded = () => {
    showcreateConsult.value = false;
    // console.log('emit Consultation',showcreateConsult.value);

};
window.addEventListener('handelConsultation', handleConsultationAdded);
</script>
<style scoped>
.customize-table {
    --easy-table-header-item-padding: 0px 26px;
    --easy-table-header-font-size: 16px;
    --easy-table-header-font-color: #010101;
    --easy-table-header-background-color: #ceebee;
    --easy-table-body-row-hover-background-color: #eee;
    --easy-table-body-item-padding: 0px 26px;
    --easy-table-footer-font-color: #1d5d65;
    --easy-table-footer-font-size: 14px;
    --easy-table-footer-height: 50px;
    --easy-table-body-row-font-size: 16px;
    --easy-table-body-row-hover-font-color: #002561;
    --easy-table-body-row-hover-background-color: #ceeedc;
    --easy-table-border: none;
}
</style>