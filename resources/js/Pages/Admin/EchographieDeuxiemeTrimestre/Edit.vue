<template>
    <div class="modal fade" id="UpdateEchographieDeuxiemeTrimestre" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
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

                        <div id="printable-content2TRE" class="custom-margin-left" style="padding-top: 150px;">
                            <div class="header" style=" text-align: center; ">
                                <h1 class="font-weight-bold">ECHOGRAPHIE OBSTETRICALE</h1>
                                <h6>Date : {{ $props.EchographieeDeuxiemeTrimestre.date }}</h6>
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
                                    <input id="indication" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.indication"
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
                                    <label class="font-weight-bold " for="indication1"
                                        style="white-space: nowrap;">Grossesse unique :
                                    </label>
                                    <input id="indication1" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.grossesse_unique"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication2"
                                        style="white-space: nowrap; margin-left: 45px;">
                                        Activité Cardiaque :
                                    </label>
                                    <select id="indication2"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.activite_cardiaque"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="positive">positive</option>
                                        <option value="negative">negative</option>
                                    </select>
                                </div>

                            </div>
                            <div style="margin-left: 60px;">
                                <div style="display: flex; align-items: center; margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication3" style="white-space: nowrap;">
                                        Mouvements actifs :</label>
                                    <select id="indication3"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.mouvements_actifs"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="positive">présents</option>
                                        <option value="negative">absents</option>
                                    </select>
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Mouvements respiratoires :
                                    </label>
                                    <select id="indication4"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.mouvements_respiratoires"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="positive">présents</option>
                                        <option value="negative">absents</option>
                                    </select>

                                </div>


                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication" style="white-space: nowrap;">
                                        Présentation :
                                    </label>
                                    <input id="indication5" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.presentation"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication6" style="white-space: nowrap;">
                                        Liquide amniotique :
                                    </label>
                                    <select id="indication6"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.liquide_amniotique"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="Normale">Normale</option>
                                        <option value="Hydramnios">Hydramnios</option>
                                        <option value="Anomnios">Anomnios</option>
                                        <option value="Oligomios">Oligoamnios</option>
                                        <option value="Liquide Amniotique diminué">Liquide Amniotique diminué</option>

                                    </select>
                                    <!-- <input id="indication4" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.liquide_amniotique"
                                        class="form-control text-dark"
                                        style="margin-left: 0px; width: 70px; border: none;margin-top: -8px; "> -->
                                </div>

                                <div>
                                    <div style="display: flex; align-items: center; margin-top: 5px;;">
                                        <label class="font-weight-bold " for="indicationPlacenta"
                                            style="white-space: nowrap;">Placenta :
                                        </label>
                                    </div>
                                </div>

                                <div style="margin-left: 40px;">
                                    <div style="display: flex; align-items: center;  margin-top: 5px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication7" style="white-space: nowrap;">
                                            Localisation :
                                        </label>
                                        <select id="indication7"
                                            v-model="$props.EchographieeDeuxiemeTrimestre.placenta_localisation"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                            <option value="positive">postérieur</option>
                                            <option value="negative">antérieur</option>
                                            <option value="negative">fundique</option>
                                        </select>
                                    </div>
                                    <div style="display: flex; align-items: center;  margin-top: 1px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication8" style="white-space: nowrap;">
                                            Grade :
                                        </label>
                                        <input id="indication8" type="text"
                                            v-model="$props.EchographieeDeuxiemeTrimestre.placenta_grade"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                    <div style="display: flex; align-items: center;  margin-top: 1px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication9" style="white-space: nowrap;">
                                            Cordon :
                                        </label>
                                        <input id="indication9" type="text"
                                            v-model="$props.EchographieeDeuxiemeTrimestre.placenta_cordon"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                </div>

                            </div>
                            <div style="margin-left: 60px;">
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication10" style="white-space: nowrap;">
                                        Diamètre Bipariétal :
                                    </label>
                                    <input id="indication10" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.diametre_biparietal"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication11"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication11" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.diametre_biparietal_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication12" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.diametre_biparietal_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication12"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication15" style="white-space: nowrap;">
                                        Longueur Fémur :
                                    </label>
                                    <input id="indication15" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.longueur_femur"
                                        class="form-control text-dark"
                                        style="margin-left: 30px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.longueur_femur_sa"
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
                                        v-model="$props.EchographieeDeuxiemeTrimestre.longueur_femur_j"
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
                                        v-model="$props.EchographieeDeuxiemeTrimestre.long_cranio_caudale"
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
                                        v-model="$props.EchographieeDeuxiemeTrimestre.long_cranio_caudaleSoitSemaines"
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
                                        v-model="$props.EchographieeDeuxiemeTrimestre.long_cranio_caudaleSoitJours"
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
                                        v-model="$props.EchographieeDeuxiemeTrimestre.long_cranio_caudale"
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
                                        v-model="$props.EchographieeDeuxiemeTrimestre.long_cranio_caudaleSoitSemaines"
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
                                        v-model="$props.EchographieeDeuxiemeTrimestre.long_cranio_caudaleSoitJours"
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
                                    <input id="indication4" type="text" v-model="$props.EchographieeDeuxiemeTrimestre.crane"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 150px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Rachis :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.rachis" class="form-control text-dark"
                                        style="margin-left: 5px; width: 150px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Coeur :
                                    </label>
                                    <input id="indication4" type="text" v-model="$props.EchographieeDeuxiemeTrimestre.coeur"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 150px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Estomac :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.estomac"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width:  150px; border: none;margin-top: -8px;">

                                </div>

                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Vessie :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.vessie" class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Reins :
                                    </label>
                                    <input id="indication4" type="text" v-model="$props.EchographieeDeuxiemeTrimestre.reins"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Membres :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.membres"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Paroi abdominale :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="$props.EchographieeDeuxiemeTrimestre.paroi_abdominale"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                </div>
                            </div> -->

                            <div style="display: flex; align-items: flex-start; margin-top: 15px;">
                                <h4 class="font-weight-bold" for="conclusionUE2T" style="margin-top: 20px;">Conclusion </h4>
                                <textarea v-model="$props.EchographieeDeuxiemeTrimestre.conclusion" id="conclusionUE2T"
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
                                @click="updateEchographieDeuxiemeTrimestres($props.EchographieeDeuxiemeTrimestre)">
                                <i class="ri-bill-fill"></i>Modifier
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
    EchographieeDeuxiemeTrimestre: Object
})
const updateEchographieDeuxiemeTrimestres = (echographieeDeuxiemeTrimestre) => {
    router.visit(`/EchographieDeuxiemeTrimestres/${echographieeDeuxiemeTrimestre.id}`, {
        method: "PUT",
        data: echographieeDeuxiemeTrimestre,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => { useToast().success('Echographie Deuxieme Trimestre Bien Modifier', { position: 'bottom-right', duration: 3000 });
        $('#UpdateEchographieDeuxiemeTrimestre').modal('hide');

    },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
};
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
            const printableElement = document.getElementById('printable-content2TRE');
            printableElement.classList.add('printable-content2TRE-print');
            printJS({
                printable: 'printable-content2TRE',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-content2TRE-print');
            }, 1000);
        }
    },
    mounted() {
        // this.$nextTick(() => {
        //     document.querySelector('.bd-EchographieDeuxiemeTrimestre-modal-lg').addEventListener('shown.bs.modal', () => {
        //         this.printInvoice();
        //     });
        // });
        // const today = new Date();
        // const dateParts = today.toJSON().slice(0, 10).split('-');
        // this.formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
        // this.gestationnelle.reverse();

    }
};
</script>
<style>
@media print {
    label {
        display: inline-block;
    }

    /* #printable-contentEDG {
        padding-top: 150px;
    } */
}

.custom-margin-left {
    margin-left: 50px;
}
</style>
