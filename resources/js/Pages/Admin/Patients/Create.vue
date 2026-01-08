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
                                    <div class="col-lg-12 text-center">
                                        <div class="iq-card-body">
                                            <div v-for="docteur in docteurs" v-bind:key="docteur.id"
                                                class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                                                <input type="radio" :id="'customRadio-' + docteur.id" name="customRadio-10"
                                                    class="custom-control-input bg-primary" v-model="patient.docteur_id"
                                                    :value="docteur.id" >
                                                    <span hidden>{{ patient.docteur_id=docteur.id }}</span>
                                                <label class="custom-control-label" :for="'customRadio-' + docteur.id"
                                                    style="font-size: 15px; font-weight: bold;">Dr. {{ docteur.name }}</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div v-if="!patient.docteur_id" class="text-danger text-center font-weight-bold">Veuillez Affecter Le Patient a Un Docteur !</div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label for="cinPatient" class="control-label align-self-center mb-1"> CIN</label>
                                        <input type="text" class="form-control" id="cinPatient" placeholder="CIN"
                                            v-model="patient.cinPatient" />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="nomPatient"><span
                                                class="text-danger font-size-16">* </span>Nom</label>
                                        <input type="text" class="form-control" id="nomPatient" placeholder="Nom"
                                            v-model="patient.nomPatient" @input="validateName" />
                                        <p class="error-message" v-if="nameError">{{ nameError }}</p>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="prenomPatient"><span
                                                class="text-danger font-size-16">* </span>Prénom</label>
                                        <input type="text" class="form-control" id="prenomPatient" placeholder="Prénom"
                                            v-model="patient.prenomPatient" @input="validatePrenom" />
                                        <p class="error-message" v-if="prenomError">{{ prenomError }}</p>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1"> Genre:</label>
                                        <div class="row ml-1 mt-1">
                                            <div id="genre" class="pt-2">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadio6" name="customRadio1"
                                                        class="custom-control-input" v-model="patient.sexePatient"
                                                        value="Masculin" />
                                                    <label class="custom-control-label" for="customRadio6">Masculin</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadio7" name="customRadio1"
                                                        class="custom-control-input" v-model="patient.sexePatient"
                                                        value="Féminin" />
                                                    <label class="custom-control-label" for="customRadio7">Féminin</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" > Civilité:</label>
                                        <div class="row ml-1 mt-1">
                                            <div id="genre" class="pt-2">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadio8" name="customRadio2"
                                                        class="custom-control-input" v-model="patient.civilitePatient"
                                                        value="M" :disabled="patient.sexePatient == 'Féminin'" />
                                                    <label class="custom-control-label" for="customRadio8">M</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadio9" name="customRadio2"
                                                        class="custom-control-input" v-model="patient.civilitePatient"
                                                        value="Mlle" :disabled="patient.sexePatient == 'Masculin'" />
                                                    <label class="custom-control-label" for="customRadio9">Mlle</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadio10" name="customRadio2"
                                                        class="custom-control-input" v-model="patient.civilitePatient"
                                                        value="Mme" :disabled="patient.sexePatient == 'Masculin'" />
                                                    <label class="custom-control-label" for="customRadio10">Mme</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label for="conjointPatient" class="control-label align-self-center "> Conjoint</label>
                                        <input type="text" class="form-control" id="conjointPatient" placeholder="Conjoint"
                                            v-model="patient.conjointPatient" />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="exampleInputdate">Date
                                            Naissance</label>
                                        <input type="date" class="form-control" id="exampleInputdate"
                                            v-model="patient.dateNaissancePatient" :max="today" />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1"> Ville</label>
                                        <select class="form-control" id="VillePatient" v-model="patient.villePatient">
                                            <option v-for="ville in villes" v-bind:key="ville.id" :value="ville.nomVille">
                                                {{ ville.nomVille }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1"> <span
                                                class="text-danger font-size-16">* </span>Assurance</label>
                                        <select v-model="selectedAssurance" name="assurance_id" class="form-control"
                                            id="assurance_id">
                                            <option v-for="(assurance, index) in assurances" :value="assurance.id"
                                                v-bind:key="index">
                                                {{ assurance.typeAssurance }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="cname">Téléphone</label>
                                        <input type="text" class="form-control" id="cname" placeholder="Téléphone"
                                            v-model="patient.telephonePatient" />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="add2">Nationnalité</label>
                                        <select class="form-control" id="nationnalitePatient"
                                            v-model="patient.nationalitePatient">
                                            <option selected value="Marocaine">
                                                Marocaine
                                            </option>
                                            <option value="Française">Française</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1"><span
                                                class="text-danger font-size-16">* </span>Status:</label>
                                        <select class="form-control" id="statutPatient" 
                                            v-model="patient.statutPatient">
                                            <option v-for="(motif, index) in motifVisite" :value="motif.motifVisite"
                                                v-bind:key="index">
                                                {{ motif.motifVisite }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="emailPatient">Email:</label>
                                        <input type="email" class="form-control" id="emailPatient" placeholder="Email"
                                            v-model="patient.emailPatient" />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label>Groupe Sanguin:</label>
                                        <select class="form-control" id="groupeSanguinPatient"
                                            v-model="patient.groupeSanguinPatient">
                                            <option value="0"></option>
                                            <option value="O-">O-</option>
                                            <option value="O+">O+</option>
                                            <option value="A-">A-</option>
                                            <option value="A+">A+</option>
                                            <option value="B-">B-</option>
                                            <option value="B+">B+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="AB+">AB+</option>
                                        </select>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="add1COD">Code Patient
                                            <div hidden>
                                                {{
                                                    (patient.codePatient =
                                                        patient.dateNaissancePatient.split(
                                                            "-"
                                                        )[2] +
                                                        patient.dateNaissancePatient.split(
                                                            "-"
                                                        )[1] +
                                                        patient.dateNaissancePatient.split(
                                                            "-"
                                                        )[0] +
                                                        new Date().getHours() +
                                                        new Date().getMinutes() +
                                                        new Date().getDay() +
                                                        new Date().getMonth() +
                                                        new Date().getFullYear())
                                                }}
                                            </div>
                                        </label>
                                        <input type="text" class="form-control" id="add1COD" placeholder="Code Patient"
                                            v-model="patient.codePatient" disabled />
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="add2">Adresse</label>
                                        <textarea class="form-control" id="add2" placeholder="Adresse" rows="2"
                                            v-model="patient.adressePatient"></textarea>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1"
                                            for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            placeholder="Description" rows="2"
                                            v-model="patient.descriptionPatient"></textarea>
                                    </div>
                                </div>
                                <hr />
                                <div v-if="patient.sexePatient === 'Féminin'">
                                    <div class=" row mt-2">
                                        <div class="form-group col-md-4 col-lg-4">
                                            <div class="timeline-dots-fill"></div>
                                            <h6 class="float-left mb-2 text-dark">
                                                <i class="ri-user-fill text-danger"></i>
                                                Dernières règles
                                            </h6>
                                            <small class="float-right mt-1"></small>
                                            <div class="d-inline-block w-100">
                                                <input type="date" @change="calculDate" class="form-control"
                                                    v-model="insertedDate" id="exampleInputdate" :max="getCurrentDate()" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <div class="timeline-dots-fill bg-success"></div>
                                            <h6 class="float-left mb-2 text-dark">
                                                <i class="ri-heart-fill text-danger"></i>
                                                Grossesse
                                            </h6>
                                            <small class="float-right mt-1"></small>
                                            <div class="d-inline-block w-100">
                                                <input disabled type="date" class="form-control" id="dateGrossesse" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">

                                            <div class="timeline-dots-fill bg-info"></div>
                                            <h6 class="float-left mb-2 text-dark">
                                                <i class="ri-user-fill text-danger"></i>
                                                Accouchement
                                            </h6>
                                            <small class="float-right mt-1"></small>
                                            <div class="d-inline-block w-100">
                                                <input disabled type="date" class="form-control" value=""
                                                    id="dateAccouchement" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-12 text-center">
                                            <span style="font-weight: bold; color: black; margin-right: 20px;"
                                                v-if="nbrWeeks != null && !isNaN(nbrWeeks)">{{ nbrWeeks }}
                                                Semaine(s)</span>
                                            <span style="font-weight: bold; color: black;"
                                                v-if="nbrDays != null && !isNaN(nbrDays)"> {{ nbrDays }} Jour(s)</span>
                                        </div>
                                    </div>
                                    <hr />
                                </div>

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
                                                v-model="patient.dateRendezVous" v-bind:required="!radioChecked" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4"></div>
                                <button type="submit" class="btn mb-3 btn-primary">
                                    <i class="ri-bill-fill"></i>Ajouter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Antecedents Forms -->
        <div class="col-lg-4 p-1">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between" style="background-color: #e5faff">
                    <div class="iq-header-title">
                        <h4 class="card-title">Les antécédents</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="row">
                        <div class="col-lg-10" v-for="antecedent in $props.antecedents" v-bind:key="antecedent.id">
                            <div class="custom-control custom-switch custom-switch-text custom-switch-color mt-3">
                                <h5 for="nomAntecedent" class="ml-4">
                                    {{ antecedent.nomAntecedent }}
                                </h5>

                                <div v-if="antecedent.typeAntecedent == 'true'">
                                    <p hidden>
                                        {{
                                            antecedent.valeurAntecedent == 1
                                            ? (antecedent.valeurAntecedent = true)
                                            : (antecedent.valeurAntecedent = false)
                                        }}
                                    </p>
                                    <input type="checkbox" class="custom-control-input bg-danger" :id="antecedent.id"
                                        :checked="antecedent.valeurAntecedent"
                                        @change="antecedent.valeurAntecedent = $event.target.checked"
                                        style="font-size: 8px;" />
                                    <label class="custom-control-label ml-4 pl-5" :for="antecedent.id" data-on-label="OUI"
                                        data-off-label="Non"></label>
                                </div>
                                <input v-else-if="antecedent.typeAntecedent == 'valeur'" type="text"
                                    class="form-control ml-3 text-dark font-weight-bold"
                                    style=" height: 35px; background-color: #e0e0e0" :id="antecedent.id"
                                    :value="antecedent.valeurAntecedent"
                                    @input="antecedent.valeurAntecedent = $event.target.value" />

                                <div v-else-if="antecedent.typeAntecedent == 'text'" class="col">
                                    <textarea class="form-control" style="width: 100%;" rows="3"
                                    :value="antecedent.valeurAntecedent"
                                    @input="antecedent.valeurAntecedent = $event.target.value"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Antecedents Form -->
    </div>
</template>
<script setup>
import { useForm, router, usePage } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import AntecedentP from "./AntecedentP.vue";
import { ref, onMounted, watch,computed } from "vue";
const props = defineProps({
    antecedents: Object,
    docteurs: Object,
    assurances: Object,
    villes: Object,
    motifVisite:Object
});
let selectedAssurance = ref(null);
let selectedDocteur = ref(null);
onMounted(() => {
    if (props.assurances && Object.keys(props.assurances).length > 0) {
        const firstAssuranceKey = Object.keys(props.assurances)[0];
        selectedAssurance.value = props.assurances[firstAssuranceKey].id;
    }

});

const gestationnelle = useForm({
    dateDernierRegle: "",
    dateGrossesse: "",
    dateAccouchement: "",
    patient: ""

});
const patient = useForm({
    codePatient1420: "",
    cinPatient: "",
    nomPatient: "",
    prenomPatient: "",
    sexePatient: "Féminin",
    statutPatient: "Consultation",
    emailPatient: "",
    adressePatient: "",
    telephonePatient: "",
    dateNaissancePatient: "",
    nationalitePatient: "Marocaine",
    villePatient: "Taroudant",
    nationalitePatient: "Marocaine",
    descriptionPatient: "",
    adressePatient: "",
    assurance_id: selectedAssurance,
    docteur_id: '',
    dateRendezVous: "",
    antecedents: props.antecedents,
    isActive: "",
    groupeSanguinPatient: "",
    conjointPatient: "",
    civilitePatient: "Mlle",
    gestationnelle: gestationnelle
});



let nameError = ref("");
let prenomError = ref("");

const validateName = () => {
    let regex = /^[a-zA-Z\s-_']*$/;
    if (!regex.test(patient.nomPatient)) {
        nameError.value = "Le nom ne doit contenir que des lettres";
    } else {
        nameError.value = "";
    }
};

const validatePrenom = () => {
    let regex = /^[a-zA-Z\s-_]*$/;
    if (!regex.test(patient.prenomPatient)) {
        prenomError.value = "Le prénom ne doit contenir que des lettres";
    } else {
        prenomError.value = "";
    }
};

watch(() => patient.nomPatient, validateName);
watch(() => patient.prenomPatient, validatePrenom);
watch(() => patient.sexePatient, (newVal, oldVal) => {
    if (newVal === 'Masculin') {
        patient.civilitePatient = 'M';
    } else if (newVal === 'Féminin' && (patient.civilitePatient === 'M' || patient.civilitePatient === null)) {
        patient.civilitePatient = 'Mlle'; // or 'Mme', choose what should be the default for 'Féminin'
    }
});

const resetForm = () => {
    patient.reset();
    patient.assurance_id = selectedAssurance.value;
    patient.docteur_id = selectedDocteur.value;
};

let today = ref(null);

onMounted(() => {
    const date = new Date();
    const day = date.getDate() < 10 ? `0${date.getDate()}` : date.getDate();
    const month = date.getMonth() + 1 < 10 ? `0${date.getMonth() + 1}` : date.getMonth() + 1;
    const year = date.getFullYear();

    today.value = `${year}-${month}-${day}`;
});

const submit = () => {
    if (patient.docteur_id && !nameError.value && !prenomError.value) {
        router.visit("/patients", {
            method: "post",
            data: patient,
            preserveState: true,
            preserveScroll: true,
            errorBag: null,
            forceFormData: true,
            onProgress: (progress) => { },
            onSuccess: page => {
                useToast().success('Patient a été Bien Ajouter', { position: 'bottom-right', duration: 3000 });
                resetForm();
            },
            onError: errors => {
                useToast().error('Les champs Nom et Prénom sont Obligatoire !', { position: 'bottom-right', duration: 4000 });
            },
        });
    } else {
        if (!patient.docteur_id) {
            useToast().error('Veuillez Affecter Le Patient a Un Docteur !.', { position: 'bottom-right', duration: 4000 });
        }
        if (nameError.value) {
            useToast().error('Nom incorrect !', { position: 'bottom-right', duration: 4000 });
        }
        if (prenomError.value) {
            useToast().error('Prénom incorrect !', { position: 'bottom-right', duration: 4000 });
        }
    }
};

const insertedDate = ref(new Date());
const nbrWeeks = ref(0);
const nbrDays = ref(0);
const dateNow = ref(new Date());

function diffDays(dt2, dt1) {
    const diff = (dt2.getTime() - dt1.getTime()) / 1000;
    return Math.abs(Math.round(diff / (60 * 60 * 24)));
}


function getCurrentDate() {
    const today = new Date();
    const year = today.getFullYear();
    let month = today.getMonth() + 1;
    let day = today.getDate();

    if (month < 10) {
        month = '0' + month;
    }

    if (day < 10) {
        day = '0' + day;
    }

    return `${year}-${month}-${day}`;
}


function calculDate() {
    const dateNow = new Date();
    const dateInserted = new Date(insertedDate.value);

    const diffTime = Math.abs(dateNow - dateInserted);
  
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Number of days

    const weeks = Math.floor(diffDays / 7);
    const days = diffDays % 7;

    // Adding 14 days to dateInserted
    const dateGrossesse = new Date(dateInserted);
    dateGrossesse.setDate(dateGrossesse.getDate() + 14);

    // Adding 40 weeks - 14 days (total 40 weeks from the beginning)
    const dateAccouchement = new Date(dateGrossesse);
    dateAccouchement.setDate(dateAccouchement.getDate() + (40 * 7 - 14));

    document.getElementById("dateGrossesse").value = dateGrossesse.toISOString().split("T")[0];
    document.getElementById("dateAccouchement").value = dateAccouchement.toISOString().split("T")[0];

    nbrWeeks.value = weeks; // Number of weeks
    nbrDays.value = days; // Remaining days
}


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

.error-message {
    min-height: 20px;
    /* Adjust this value based on your needs */
    color: red;
}
</style>
