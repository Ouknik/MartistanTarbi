<template>
    <p hidden>{{ (EchographieeDeuxiemeTrimestre.patient = patient) }} {{ EchographieeDeuxiemeTrimestre.consultation_id=
    idConsultation }}</p>
    <div class="modal fade bd-EchographieDeuxiemeTrimestre-modal-lg" tabindex="-1" id="EchographieDeuxiemeTrimestre"
        role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Echographie Deuxieme Trimestre
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <HeaderDocteur></HeaderDocteur>
                        <span hidden>
                            {{
                                (form.date = new Date()
                                    .toJSON()
                                    .slice(0, 10))
                            }}
                        </span>
                        <div id="printable-content2TR" class="custom-margin-left" style="padding-top: 150px;">
                            <div class="header" style=" text-align: center; ">
                                <h1 class="font-weight-bold">ECHOGRAPHIE OBSTETRICALE</h1>
                                <h6>Date : {{ formattedDate }}</h6>
                            </div>

                            <div class="row font-weight-bold mt-3" style="font-size: 15px;">
                                <div class="col-lg-10">
                                    NOM & PRENOM : <span class="text-dark">Mme {{ patient.nomPatient + " " +
                                        patient.prenomPatient }}</span>
                                </div>
                                <div class="col-lg-2">
                                    Âge : <span class="text-dark">{{ age }} Ans</span>
                                </div>
                            </div>
                            <div class="row" v-for="GS in gestationnelle" v-bind:key="GS.id">
                                <div class="col-lg-12 text-left" style="font-size: 15px;">
                                    Date Des Dernieres Regles : <span class="text-dark font-weight-bold">{{
                                        GS.dateDernierRegle.split('-').reverse().join('-') }}</span>
                                </div>
                            </div>
                            <div>
                                <div style="display: flex; align-items: center;">
                                    <label class="font-weight-bold" style="white-space: nowrap;" for="indication">INDICATION
                                        :</label>
                                    <input id="indication" type="text" v-model="EchographieeDeuxiemeTrimestre.indication"
                                        class="form-control text-dark"
                                        style="width: 300px; border: none; margin-top: -7px; ">
                                </div>
                            </div>
                            <div class="mt-2">
                                <div style="display: flex; align-items: center;">
                                    <h4 class="font-weight-bold" style="white-space: nowrap;" for="indication">
                                        2 <sup>ème</sup> / 3 <sup>ème</sup> TRIMESTRE : </h4>
                                </div>
                            </div>
                            <div class="ml-4" style=" margin-top: 20px;">
                                <div style="display: flex; align-items: center; margin-top: 5px;;">
                                    <span
                                        style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                    <label class="font-weight-bold " for="indication2"
                                        style="white-space: nowrap;">Grossesse unique :
                                    </label>
                                    <input id="indication2" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.grossesse_unique"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap; margin-left: 45px;">
                                        Activité Cardiaque :
                                    </label>
                                    <select id="indication4" v-model="EchographieeDeuxiemeTrimestre.activite_cardiaque"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="positive" selected>positive</option>
                                        <option value="negative">negative</option>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-left: 60px;">
                                <div style="display: flex; align-items: center; margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication3" style="white-space: nowrap;">
                                        Mouvements actifs :</label>
                                    <select id="indication4" v-model="EchographieeDeuxiemeTrimestre.mouvements_actifs"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="positive" selected>présents</option>
                                        <option value="negative">absents</option>
                                    </select>
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Mouvements respiratoires :
                                    </label>
                                    <select id="indication4"
                                        v-model="EchographieeDeuxiemeTrimestre.mouvements_respiratoires"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="positive" selected>présents</option>
                                        <option value="negative">absents</option>
                                    </select>
                                </div>
                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Présentation :
                                    </label>
                                    <textarea cols="8" v-model="EchographieeDeuxiemeTrimestre.presentation"
                                    class="form-control ml-3 text-dark mt-2"
                                    style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </textarea>
                                    <!-- <input id="indication4" type="text" v-model="EchographieeDeuxiemeTrimestre.presentation"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; "> -->
                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Liquide amniotique :
                                    </label>
                                    <select id="indication4" v-model="EchographieeDeuxiemeTrimestre.liquide_amniotique"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="Normale" selected>Normale</option>
                                        <option value="Hydramnios">Hydramnios</option>
                                        <option value="Anomnios">Anomnios</option>
                                        <option value="Oligomios">Oligoamnios</option>
                                        <option value="Liquide Amniotique diminué">Liquide Amniotique diminué</option>

                                    </select>
                                    <!-- <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.liquide_amniotique"
                                        class="form-control text-dark"
                                        style="margin-left: 0px; width: 70px; border: none;margin-top: -8px; "> -->
                                </div>
                                <div>
                                    <div style="display: flex; align-items: center; margin-top: 5px;;">
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Placenta :
                                        </label>
                                    </div>
                                </div>
                                <div style="margin-left: 40px;">
                                    <div style="display: flex; align-items: center;  margin-top: 5px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                            Localisation :
                                        </label>
                                        <select id="indication4"
                                            v-model="EchographieeDeuxiemeTrimestre.placenta_localisation"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                            <option value="positive" selected>postérieur</option>
                                            <option value="negative">antérieur</option>
                                            <option value="negative">fundique</option>
                                        </select>
                                    </div>
                                    <div style="display: flex; align-items: center;  margin-top: 1px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                            Grade :
                                        </label>
                                        <input id="indication4" type="text"
                                            v-model="EchographieeDeuxiemeTrimestre.placenta_grade"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                    <div style="display: flex; align-items: center;  margin-top: 1px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                            Cordon :
                                        </label>
                                        <input id="indication4" type="text"
                                            v-model="EchographieeDeuxiemeTrimestre.placenta_cordon"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 60px;">
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Diamètre Bipariétal :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.diametre_biparietal"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.diametre_biparietal_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.diametre_biparietal_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>
                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Longueur Fémur :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.longueur_femur"
                                        class="form-control text-dark"
                                        style="margin-left: 30px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.longueur_femur_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.longueur_femur_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>
                                </div>
                                <!-- <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Diamètre Abd Trans :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.long_cranio_caudale"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.long_cranio_caudaleSoitSemaines"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.long_cranio_caudaleSoitJours"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div> -->
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Circonf Abdominale :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.long_cranio_caudale"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 70px; border: none;margin-top: -8px; text-align: right;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.long_cranio_caudaleSoitSemaines"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.long_cranio_caudaleSoitJours"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="ml-4" style=" margin-top: 10px;">
                                <div class="ml-1">
                                    <div style="display: flex; align-items: center; margin-top: 5px;;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Etudemorphologique
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 60px;">
                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Crane :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieeDeuxiemeTrimestre.crane"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 150px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Rachis :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieeDeuxiemeTrimestre.rachis"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 150px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Coeur :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieeDeuxiemeTrimestre.coeur"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 150px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Estomac :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieeDeuxiemeTrimestre.estomac"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width:  150px; border: none;margin-top: -8px;">

                                </div>

                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Vessie :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieeDeuxiemeTrimestre.vessie"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Reins :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieeDeuxiemeTrimestre.reins"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Membres :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieeDeuxiemeTrimestre.membres"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Paroi abdominale :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieeDeuxiemeTrimestre.paroi_abdominale"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                </div>
                            </div> -->
                            <div style="display: flex; align-items: flex-start; margin-top: 15px;">
                                <h4 class="font-weight-bold" for="indication" style="margin-top: 20px;">Conclusion </h4>
                                <textarea v-model="EchographieeDeuxiemeTrimestre.conclusion"
                                    class="form-control ml-3 text-dark mt-2"
                                    style="border: none; margin-top: -55px; color: black; font-weight: bold;">
                                    </textarea>
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
                            <button style="font-size: 20px" type="submit" class="btn mt-3 btn-primary ml-4"
                                :disabled="form.processing">
                                <i class="ri-bill-fill"></i>Ajouter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useForm, router, Link } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";
import FooterDocteur from "../../../Layouts/Template/FooterDocteur.vue";
const props = defineProps({
    patient: Object,
    age: Number,
    gestationnelle: Object,
    idConsultation: Number

})
const EchographieeDeuxiemeTrimestre = useForm({
    indication: '',
    grossesse_unique: '',
    activite_cardiaque: '',
    mouvements_actifs: '',
    mouvements_respiratoires: '',
    presentation: '',
    liquide_amniotique: '',
    placenta_localisation: '',
    placenta_grade: '',
    placenta_cordon: '',
    diametre_biparietal: '',
    diametre_biparietal_sa: '',
    diametre_biparietal_j: '',
    longueur_femur: '',
    longueur_femur_sa: '',
    longueur_femur_j: '',
    diam_abd_trans: '',
    diam_abd_trans_sa: '',
    diam_abd_trans_j: '',
    circonf_abd: '',
    circonf_abd_sa: '',
    circonf_abd_j: '',
    crane: '',
    rachis: '',
    coeur: '',
    estomac: '',
    vessie: '',
    reins: '',
    membres: '',
    paroi_abdominale: '',
    conclusion: 'Grossesse évolutive de 05 SA',
    consultation_id: props.idConsultation,
    patient: ""
})

const submit = () => {
    if (props.idConsultation == 0) {
        useToast().error('Veuillez Choisir une consultation ', { position: 'bottom-right', duration: 3000 });
        return false
    }
    router.visit('/EchographieDeuxiemeTrimestres', {
        method: 'post',
        data: EchographieeDeuxiemeTrimestre,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Echographie Deuxieme Trimestre Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#EchographieDeuxiemeTrimestre').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
}
</script>
<script>
import printJS from 'print-js';
export default {
    data() {
        return {
            formattedDate: '',
            form: {
            }
        }
    },
    methods: {
        printInvoice() {
            const printableElement = document.getElementById('printable-content2TR');
            printableElement.classList.add('printable-content2TR-print');
            printJS({
                printable: 'printable-content2TR',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-content2TR-print');
            }, 1000);
        }
    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-EchographieDeuxiemeTrimestre-modal-lg').addEventListener('shown.bs.modal', () => {
                this.printInvoice();
            });
        });
        const today = new Date();
        const dateParts = today.toJSON().slice(0, 10).split('-');
        this.formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
        this.gestationnelle.reverse();

    }
};
</script>
<style>
@media print {
    label {
        display: inline-block;
    }
}

.custom-margin-left {
    margin-left: 50px;
}
</style>
