<template>
            <p hidden>{{ (EchographiePremierTrimestre.patient = patient) }}{{ EchographiePremierTrimestre.consultation_id= idConsultation }}</p>

    <div class="modal fade bd-EchographiePremierTrimestre-modal-lg" tabindex="-1" id="EchographiePremierTrimestre" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white ">Echographie Premier Trimestre
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

                        <div id="printable-content1TR" class="custom-margin-left" style="padding-top: 150px;">
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
                                    <input id="indication" type="text" v-model="EchographiePremierTrimestre.indication"
                                        class="form-control text-dark"
                                        style="width: 300px; border: none; margin-top: -7px; ">
                                </div>
                            </div>
                            <div class="mt-2">
                                <div style="display: flex; align-items: center;">
                                    <h4 class="font-weight-bold" style="white-space: nowrap;" for="indication">
                                        1<sup>er</sup> TRIMESTRE : </h4>

                                </div>
                            </div>


                            <div class="ml-4" style=" margin-top: 20px;">
                                <div class="ml-1">
                                    <div style="display: flex; align-items: center; margin-top: 5px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Utérus :
                                        </label>
                                        <input id="indication2" type="text" v-model="EchographiePremierTrimestre.uterus"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; margin-top: 5px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication3" style="white-space: nowrap;">OEuf
                                            Unique / Multiple :</label>
                                        <input id="indication3" type="text" v-model="EchographiePremierTrimestre.oeufUnique"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                </div>

                            </div>
                            <div style="margin-left: 60px;">
                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Aspect :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographiePremierTrimestre.aspect"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Vésicule ombilicale :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographiePremierTrimestre.vesicule_ombilicale"
                                        class="form-control text-dark"
                                        style="margin-left: 0px; width: 70px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        mm
                                    </label>
                                </div>
                            </div>

                            <div class="ml-4" style=" margin-top: 20px;">
                                <div class="ml-1">
                                    <div style="display: flex; align-items: center; margin-top: 5px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Embryon Unique/Multiple :
                                        </label>
                                        <input id="indication2" type="text"
                                            v-model="EchographiePremierTrimestre.embryonUnique"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    </div>
                                </div>
                            </div>

                            <div style="margin-left: 120px;">
                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Activité cardiaque :
                                    </label>
                                    <select id="indication4" v-model="EchographiePremierTrimestre.activite_cardiaque"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="positive" selected>positive</option>
                                        <option value="negative">negative</option>
                                    </select>
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        /Mouvement Actives :
                                    </label>
                                    <select id="indication4" v-model="EchographiePremierTrimestre.mouvements_actifs"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="présents" selected>présents</option>
                                        <option value="absent">absent</option>
                                    </select>
                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Clarté nucale :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographiePremierTrimestre.clarte_nucale"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;  text-align: right;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        mm
                                    </label>
                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Long cranio-caudale :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographiePremierTrimestre.long_cranio_caudale"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm, soit
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographiePremierTrimestre.long_cranio_caudaleSoitSemaines"
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
                                        v-model="EchographiePremierTrimestre.long_cranio_caudaleSoitJours"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Diamètre Bipariétal :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographiePremierTrimestre.diametre_biparietal"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 79px; border: none;margin-top: -8px;text-align: right; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm, soit
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographiePremierTrimestre.diametre_biparietalSoitSemaines"
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
                                        v-model="EchographiePremierTrimestre.diametre_biparietalSoitJours"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>
                                </div>
                            </div>
                            <div class="ml-4" style=" margin-top: 10px;">
                                <div class="ml-1">
                                    <div style="display: flex; align-items: center; margin-top: 5px;;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Annexe Gauche :
                                        </label>
                                        <input id="indication2" type="text"
                                            v-model="EchographiePremierTrimestre.annexe_gauche"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4" style=" margin-top: 10px;">
                                <div class="ml-1">
                                    <div style="display: flex; align-items: center; margin-top: 5px;;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Annexe Droite :
                                        </label>
                                        <input id="indication2" type="text"
                                            v-model="EchographiePremierTrimestre.annexe_droite"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    </div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; margin-top: 15px;">
                                <h4 class="font-weight-bold" for="indication" style="margin-top: 22px;">Conclusion </h4>
                                <textarea v-model="EchographiePremierTrimestre.conclusion"
                                    class="form-control ml-3 text-dark mt-2" style="border: none; margin-top: -55px;">

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
    idConsultation:Number
})

const EchographiePremierTrimestre = useForm({
    indication: 'RAS',
    uterus: 'Gravide ',
    oeufUnique: '1',
    aspect: 'non vu',
    vesicule_ombilicale: '04-05',
    embryonUnique: '15 jrs',
    activite_cardiaque: 'positive',
    mouvements_actifs: 'présents',
    clarte_nucale: '',
    long_cranio_caudale: '',
    diametre_biparietal: '',
    long_cranio_caudaleSoitSemaines: '07',
    long_cranio_caudaleSoitJours: '05',
    diametre_biparietalSoitSemaines: 'RAS',
    diametre_biparietalSoitJours: 'RAS',
    annexe_gauche: 'RAS ',
    annexe_droite: '1RAS',
    conclusion: 'Grossesse évolutive de',
    conclusionde: '07SA et 05j',
    consultation_id: props.idConsultation,
    patient: ""
})

const submit = () => {
    if(props.idConsultation==0)
    {
        useToast().error('Veuillez Choisir une consultation ', { position: 'bottom-right', duration: 3000 });
       return false
    }
    router.visit('/EchographiePremierTrimestres', {
        method: 'post',
        data: EchographiePremierTrimestre,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => { useToast().success('Echographie Premier Trimestre Bien Ajouter', { position: 'bottom-right', duration: 3000 }); 
        $('#EchographiePremierTrimestre').modal('hide');},
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
            const printableElement = document.getElementById('printable-content1TR');
            printableElement.classList.add('printable-content1TR-print');
            printJS({
                printable: 'printable-content1TR',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-content1TR-print');
            }, 1000);
        }
    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-EchographiePremierTrimestre-modal-lg').addEventListener('shown.bs.modal', () => {
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
        /* Cela peut aider à garder le texte et les deux points sur la même ligne */
    }

    #printable-contentEDG {
        padding-top: 150px;
    }
}

.custom-margin-left {
    margin-left: 50px;
}</style>
