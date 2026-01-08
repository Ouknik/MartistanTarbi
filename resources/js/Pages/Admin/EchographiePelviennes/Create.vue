<template>
    <p hidden>{{ (EchographiePelviennes.patient = patient) }} {{ EchographiePelviennes.consultation_id= idConsultation }}
    </p>

    <div class="modal fade bd-EchographiePelvienne-modal-lg" tabindex="-1" id="addEchographiePelvienne" role="dialog"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Echographie Pelviennes
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <HeaderDocteur style="margin-bottom: -180px;"></HeaderDocteur>

                        <span hidden>
                            {{
                                (form.date = new Date()
                                    .toJSON()
                                    .slice(0, 10))
                            }}
                        </span>

                        <div id="printable-contentEP" class="custom-margin-left" style="padding-top:80px;">
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
                            <div class="row mt-3" v-for="GS in gestationnelle" v-bind:key="GS.id">
                                <div class="col-lg-12 text-left" style="font-size: 15px;">
                                    Date Des Dernieres Regles : <span class="text-dark font-weight-bold">{{
                                        GS.dateDernierRegle.split('-').reverse().join('-') }}</span>
                                </div>
                            </div>


                            <div class="ml-4" style="margin-left: 20px;">
                                <div class="mt-2">
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;"
                                            for="indicationEPA">INDICATION :</label>
                                        <input id="indicationEPA" type="text" v-model="EchographiePelviennes.indication"
                                            class="form-control text-dark" style="width: 300px; border: none; ">
                                    </div>
                                </div>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="vessieEPA">VESSIE
                                            :</label>
                                        <input id="vessieEPA" type="text" v-model="EchographiePelviennes.vessie"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;">
                                    </div>
                                </div>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="VAGINEPA">VAGIN
                                            ET COL :</label>
                                        <input id="VAGINEPA" type="text" v-model="EchographiePelviennes.vaginetcol"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; ">
                                    </div>
                                </div>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="indication">UTERUS
                                            :</label>
                                    </div>
                                </div>
                                <div class="ml-5">
                                    <div style="display: flex; align-items: center; ;">
                                        <label class="font-weight-bold " for="uterus_positionEPA"
                                            style="white-space: nowrap;">Position :
                                        </label>
                                        <input id="uterus_positionEPA" type="text" v-model="EchographiePelviennes.uterus_position"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold " for="uterus_contoursEPA"
                                            style="white-space: nowrap;">Contours :</label>
                                        <input id="uterus_contoursEPA" type="text" v-model="EchographiePelviennes.uterus_contours"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold " for="uterus_echo_structureEPA" style="white-space: nowrap;">
                                            Echo structure :
                                        </label>
                                        <input id="uterus_echo_structureEPA" type="text"
                                            v-model="EchographiePelviennes.uterus_echo_structure"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; ;">
                                        <label class="font-weight-bold" for="endometreEPA"
                                            style="white-space: nowrap;">Endomètre :</label>
                                        <input id="endometreEPA" type="text" v-model="EchographiePelviennes.endometre"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px;">
                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" for="uterine_caviteEPA"
                                            style="white-space: nowrap;">Cavite utérine :</label>
                                        <input id="uterine_caviteEPA" type="text" v-model="EchographiePelviennes.uterine_cavite"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px;">
                                    </div>
                                </div>



                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="mt-2 font-weight-bold" style="white-space: nowrap;"
                                            for="indication">OVAIRES :</label>
                                    </div>
                                </div>
                                <div class="ml-5">
                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold" for="OVAIRESDROITEPA" style="white-space: nowrap;">DROIT
                                            :
                                        </label>
                                        <input id="OVAIRESDROITEPA" type="text" v-model="EchographiePelviennes.ovaire_droit"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px;">
                                    </div>

                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" for="OVAIRESGAUCHEEPA"
                                            style="white-space: nowrap;">GAUCHE :</label>
                                        <input id="OVAIRESGAUCHEEPA" type="text" v-model="EchographiePelviennes.ovaire_gauche"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                </div>


                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="TROMPE">TROMPE
                                            :</label>
                                    </div>
                                </div>
                                <div class="ml-5">
                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold" for="DROITEPA" style="white-space: nowrap;">DROIT
                                            :
                                        </label>
                                        <input id="DROITEPA" type="text" v-model="EchographiePelviennes.trompe_droit"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px;">
                                    </div>

                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold" for="GAUCHEEPA"
                                            style="white-space: nowrap;">GAUCHE :</label>
                                        <input id="GAUCHEEPA" type="text" v-model="EchographiePelviennes.trompe_gauche"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px;">
                                    </div>

                                </div>


                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;"
                                            for="DOUGLASEPA">DOUGLAS :</label>
                                        <input id="DOUGLASEPA" type="text" v-model="EchographiePelviennes.douglass"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px;">

                                    </div>
                                </div>
                                <div style="display: flex; align-items: flex-start;">
                                    <label class="mt-3 font-weight-bold" for="conclusionEPA">Conclusion </label>
                                    <textarea v-model="EchographiePelviennes.conclusion" class="form-control ml-3 text-dark" id="conclusionEPA"
                                        style="border: none;"></textarea>
                                </div>



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

const EchographiePelviennes = useForm({
    indication: '',
    vessie: 'Vide',
    vaginetcol: 'RAS',
    uterus_position: 'antéversé',
    uterus_contours: 'réguliers',
    uterus_echo_structure: 'homogène',
    endometre: 'épaisseur normale',
    uterine_cavite: 'libre',
    ovaire_droit: 'RAS',
    ovaire_gauche: 'RAS',
    trompe_droit: 'RAS',
    trompe_gauche: 'RAS',
    douglass: 'libre',
    conclusion: 'Echographie pelvienne normale',
    consultation_id: props.idConsultation,
    patient: ""
})

const submit = () => {
    if (props.idConsultation == 0) {
        useToast().error('Veuillez Choisir une consultation ', { position: 'bottom-right', duration: 3000 });
        return false
    }
    router.visit('/EchographiePelviennes', {
        method: 'post',
        data: EchographiePelviennes,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Echographie Pelviennes Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#addEchographiePelvienne').modal('hide');
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
            const printableElement = document.getElementById('printable-contentEP');
            printableElement.classList.add('printable-contentEP-print');
            printJS({
                printable: 'printable-contentEP',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-contentEP-print');
            }, 1000);
        }
    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-EchographiePelvienne-modal-lg').addEventListener('shown.bs.modal', () => {
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

    #printable-contentEP {
        padding-top: 150px;
    }
}

.custom-margin-left {
    margin-left: 50px;
}
</style>
