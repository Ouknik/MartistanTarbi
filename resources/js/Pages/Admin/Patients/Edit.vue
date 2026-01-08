<template>
    <div class="modal fade" id="updatePatient" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header color-template">
                        <h5 class="modal-title text-white">Modifier Les Informations du patient : {{ $props.patient.nomPatient +' '+ $props.patient.prenomPatient }}
                        </h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="new-user-info row">
                            <div class="col-lg-12">
                                <form @submit.prevent="submit">
                                    <div class="row">
                                        <div class="form-group col-md-4 col-lg-3">
                                            <label for="lname" class="control-label align-self-center mb-1"> CIN</label>
                                            <input type="text" class="form-control" id="cin" placeholder="CIN"
                                                v-model="$props.patient.cinPatient" />
                                        </div>
                                        <div class="form-group col-md-4 col-lg-3">
                                            <label class="control-label align-self-center mb-1" for="lname"><span
                                                    style="color: red; font-size: 1.2em;">*</span> Nom</label>
                                            <input type="text" class="form-control" id="lname" placeholder="Nom"
                                                v-model="$props.patient.nomPatient" />
                                        </div>
                                        <div class="form-group col-md-4 col-lg-3">
                                            <label class="control-label align-self-center mb-1" for="fname"><span
                                                    style="color: red; font-size: 1.2em;">*</span> Prénom</label>
                                            <input type="text" class="form-control" id="fname" placeholder="Prénom"
                                                v-model="$props.patient.prenomPatient" />
                                        </div>
                                        <div class="form-group col-md-4 col-lg-3">
                                            <label for="lname" class="control-label align-self-center "> Conjoint</label>
                                            <input type="text" class="form-control" id="cin" placeholder="Conjoint"
                                                v-model="$props.patient.conjointPatient" />
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1" for="exampleInputdate">Date
                                                Naissance</label>
                                            <input type="date" class="form-control" id="exampleInputdate"
                                                v-model="$props.patient.dateNaissancePatient" />
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1" for="genre"> Genre:</label>
                                            <div class="row">
                                                <div id="genre" class="pt-2">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadio6" name="customRadio1"
                                                            class="custom-control-input"
                                                            v-model="$props.patient.sexePatient" value="Masculin" />
                                                        <label class="custom-control-label" for="customRadio6">
                                                            Masculin
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadio7" name="customRadio1"
                                                            class="custom-control-input"
                                                            v-model="$props.patient.sexePatient" value="Féminin" />
                                                        <label class="custom-control-label" for="customRadio7">
                                                            Féminin
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                        <label class="control-label align-self-center mb-1" for="genre"> Civilité:</label>
                                        <div class="row ml-1 mt-1">
                                            <div id="genre" class="pt-2">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadio8" name="customRadio2"
                                                        class="custom-control-input" v-model="$props.patient.civilitePatient"
                                                        value="M" :disabled="$props.patient.sexePatient == 'Féminin'" />
                                                    <label class="custom-control-label" for="customRadio8">M</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadio9" name="customRadio2"
                                                        class="custom-control-input" v-model="$props.patient.civilitePatient"
                                                        value="Mlle" :disabled="$props.patient.sexePatient == 'Masculin'" />
                                                    <label class="custom-control-label" for="customRadio9">Mlle</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadio10" name="customRadio2"
                                                        class="custom-control-input" v-model="$props.patient.civilitePatient"
                                                        value="Mme" :disabled="$props.patient.sexePatient == 'Masculin'" />
                                                    <label class="custom-control-label" for="customRadio10">Mme</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1"> Ville</label>
                                            <select class="form-control" id="selectcountry" v-model="patient.villePatient">
                                                <option v-for="ville in villes" v-bind:key="ville.id"
                                                    :value="ville.nomVille">
                                                    {{ ville.nomVille }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1"> Assurance</label>

                                            <select v-model="$props.patient.assurance_id" name="assurance_id"
                                                class="form-control" id="assurance_id">
                                                <option v-for="(assurance, index) in assurances" :value="assurance.id"
                                                    v-bind:key="index">
                                                    {{ assurance.typeAssurance }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1"
                                                for="cname">Téléphone</label>
                                            <input type="text" class="form-control" id="cname" placeholder="Téléphone"
                                                v-model="$props.patient.telephonePatient" />
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1"
                                                for="add2">Nationnalité</label>
                                            <select class="form-control" id="selectcountry"
                                                v-model="$props.patient.nationalitePatient">
                                                <option selected value="Marocaine">
                                                    Marocaine
                                                </option>
                                                <option value="Française">Française</option>
                                                <option value="Autre">Autre</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1">Status:</label>
                                            <select class="form-control" id="exampleFormControlSelect4"
                                                v-model="$props.patient.statutPatient">
                                                <option v-for="(motif, index) in motifVisite" :value="motif.motifVisite"
                                                v-bind:key="index">
                                                {{ motif.motifVisite }}
                                            </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1" for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email"
                                                v-model="$props.patient.emailPatient" />
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label>Groupe Sanguin:</label>
                                            <select class="form-control" id="exampleFormControlSelect4"
                                                v-model="$props.patient.groupeSanguinPatient">
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
                                                 <!-- code patient -->
                                                </div>
                                            </label>
                                            <input type="text" class="form-control" id="add1COD" placeholder="Code Patient"
                                                v-model="$props.patient.codePatient" disabled />
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1" for="add2">Adresse</label>
                                            <textarea class="form-control" id="add2" placeholder="Adresse" rows="2"
                                                v-model="$props.patient.adressePatient"></textarea>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label align-self-center mb-1"
                                                for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1"
                                                placeholder="Description" rows="2"
                                                v-model="$props.patient.descriptionPatient"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" @click="updatePatient($props.patient)"
                            class="btn color-template text-white">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import {  router } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import {  watch } from "vue";

const props = defineProps({
    patient: Object,
    assurances: Object,
    villes: Object,
    motifVisite:Object
});

watch(() => props.patient.sexePatient, (newVal, oldVal) => {
    if (newVal === 'Masculin') {
        props.patient.civilitePatient = 'M';
    } else if (newVal === 'Féminin' && (props.patient.civilitePatient === 'M' || props.patient.civilitePatient === null)) {
        props.patient.civilitePatient = 'Mlle'; 
    }
});

const updatePatient = (patient) => {
    router.visit(`/patients/${patient.id}`, {
        method: "put",
        data: patient,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Patient Modifier', { position: 'bottom-right', duration: 3000 });
            $('#updatePatient').modal('hide');
        },
    })
}
</script>

