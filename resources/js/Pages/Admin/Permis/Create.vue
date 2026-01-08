<template>
    <div class="row">
        <div class="col-lg-8">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between" style="background-color: #e5faff">
                    <div class="iq-header-title">
                        <h4 class="card-title">Ajouter Patient</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="new-user-info row">
                        <div class="col-lg-12">
                            <form @submit.prevent="submit">
                                <div class="row">
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label for="lname" class="control-label align-self-center mb-1"> N° Dossier
                                            :</label>
                                        <input type="text" class="form-control" id="cin" placeholder="145/2023"
                                            v-model="patient.numeroDossier"/>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">

                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="lname"><span
                                                style="color: red; font-size: 1.2em;">*</span> Nom</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Nom"
                                            v-model="patient.nom" />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="fname"><span
                                                style="color: red; font-size: 1.2em;">*</span> Prénom</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Prénom"
                                            v-model="patient.prenom" />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="exampleInputdate">Date
                                            Naissance</label>
                                        <input type="date" class="form-control" id="exampleInputdate"
                                            v-model="patient.dateNaissance" />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="genre"> Genre:</label>
                                        <div id="genre" class="pt-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadio6" name="customRadio1"
                                                    class="custom-control-input" v-model="patient.genre" value="Masculin" />
                                                <label class="custom-control-label" for="customRadio6">
                                                    Masculin
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadio7" name="customRadio1"
                                                    class="custom-control-input" v-model="patient.genre" value="Féminin"
                                                    checked />
                                                <label class="custom-control-label" for="customRadio7">
                                                    Féminin
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="exampleInputdate">Date
                                            Visite :</label>
                                        <input type="date" class="form-control" id="exampleInputdate"
                                            v-model="patient.dateVisite" disabled/>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="exampleInputdate">Montant A
                                            Payer
                                        </label>
                                        <input type="text" class="form-control" id="exampleInputdate"
                                            v-model="patient.montantAPayer" />
                                    </div>

                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                                            <span class="mb-1 mr-3 text-dark"
                                                style="font-size: 15px ; font-style: normal;  font-weight: bold;"> Ajouter a
                                                la liste d'attente
                                            </span>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch-1"
                                                v-model="radioChecked" checked="">
                                            <label class="custom-control-label" for="customSwitch-1">
                                                <span class="switch-icon-left"><i class="fa fa-check"></i></span>
                                                <span class="switch-icon-right"><i class="fa fa-check"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                    <span hidden>{{ patient.isActive=radioChecked }}</span>
                                    <div class="col-lg-6">
                                        <div class="form-group" v-show="!radioChecked">
                                            <label class="control-label align-self-center mb-1" for="exampleInputdate"
                                                style="font-weight: bold;">
                                                Programmer un Rendez-Vous</label>
                                            <input type="date" class="form-control" id="dateRendezVous"
                                                v-model="patient.dateRendezVous" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4"></div>
                                <button type="submit" @click="submit" class="btn mb-3 btn-primary">
                                    <i class="ri-bill-fill"></i>Ajouter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between" style="background-color: #e5faff">
                    <div class="iq-header-title">
                        <h4 class="card-title">Les antecedants</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>
<!-- <div class="col-lg-4">
            <form>
                <AntecedentP
                    :patient="patient"
                    :antecedents="patient.antecedents"
                ></AntecedentP>
            </form>
        </div> -->
<script setup>
import { useForm, router, usePage } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import { ref, onMounted } from "vue";
const props = defineProps({
    antecedents: Object,
    docteurs: Object,
    assurances: Object,
    villes: Object,
});

const patient = useForm({
    numeroDossier: "",
    nom: "",
    prenom: "",
    dateNaissance: "",
    genre: "",
    dateVisite: "",
    montantAPayer: "",
});

const submit = () => {
    router.visit("/permis", {
        method: "post",
        data: patient,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: (progress) => { },
        onSuccess: page => {
            useToast().success('Patient a été Bien Ajouter', { position: 'bottom-right', duration: 3000 });
        },
        onError: errors => {
            useToast().error('Les champs Nom et Prénom sont Obligatoire !', { position: 'bottom-right', duration: 4000 });
        },
    });
};


// Function to get today's date in the format required by the input (YYYY-MM-DD)
function getTodayDate() {
  const today = new Date().toISOString().split('T')[0];
  return today;
}

// Initialize patient.dateVisite with today's date when the component is mounted
onMounted(() => {
  patient.dateVisite = getTodayDate();
});





</script>
<script>
export default {
    data() {
        return {
            radioChecked: true,
        };
    },
    methods: {
    },

};
</script>
<style>
hr {
    padding-top: 2px;
    padding-bottom: 4px;

    border: none;
    height: px;
    width: 100%;
    height: 50px;
    margin-top: 0;
    border-bottom: 1px solid #9accd1;
    box-shadow: 0 1px 1px -1px #333;
    margin: -50px auto 10px;
}
</style>
