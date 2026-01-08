<template>
    <p hidden>{{ (EchographieGynecologique.patient = patient) }} 
    </p>
    <div class="modal fade" id="UpdateEchographieGynecologique" tabindex="-1" role="dialog"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">ECHOGRAPHIE GYNECOLOGIQUE
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
                        <div id="printable-contentEGE" class="custom-margin-left" style="padding-top:80px;">
                            <div class="header" style=" text-align: center; ">
                                <h1 class="font-weight-bold">ECHOGRAPHIE GYNECOLOGIQUE</h1>
                                <h6>Date : {{ formattedDate }}</h6>
                            </div>
                            <div class="row font-weight-bold mt-3" style="font-size: 15px;">
                                <div class="col-lg-10">
                                    NOM & PRENOM : <span class="text-dark">Mme {{ patient.nomPatient + " " +
                                        patient.prenomPatient }}</span>
                                </div>
                                <!-- <div class="col-lg-2">
                                    Âge : <span class="text-dark">{{ age }} Ans</span>
                                </div> -->
                            </div>
                            <!-- <div class="row mt-3" v-for="GS in gestationnelle" v-bind:key="GS.id">
                                <div class="col-lg-12 text-left" style="font-size: 15px;">
                                    Date Des Dernieres Regles : <span class="text-dark font-weight-bold">{{
                                        GS.dateDernierRegle.split('-').reverse().join('-') }}</span>
                                </div>
                            </div> -->
                            <div class="ml-4" style="margin-left: 20px;">
                                <div class="mt-4">
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;"
                                            for="indicationEPA">INDICATION :</label>
                                        <input id="indicationEPA" type="text" v-model="$props.EchographieGynecologique.indication"
                                            class="form-control text-dark" style="width: 300px; border: none; ">
                                    </div>
                                </div>
                                <div  class="mt-4">
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="vessieEPA">Utérus
                                            : </label>
                                        <input id="vessieEPA" type="text" v-model="$props.EchographieGynecologique.uterus"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -10px;">
                                    </div>
                                </div>
                                <div  class="mt-4">
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="VAGINEPA">Cavité utérine : </label>
                                        <input id="VAGINEPA" type="text" v-model="$props.EchographieGynecologique.caviteUterine"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -10px; ">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="VAGINEPA">Endomètre: </label>
                                        <input id="VAGINEPA" type="text" v-model="$props.EchographieGynecologique.endometre"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -10px; ">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="VAGINEPA">Annexe Gauche : </label>
                                        <input id="VAGINEPA" type="text" v-model="$props.EchographieGynecologique.annexeGauche"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -10px;">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="VAGINEPA">Annexe Droit : </label>
                                        <input id="VAGINEPA" type="text" v-model="$props.EchographieGynecologique.annexeDroite"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -10px; ">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="VAGINEPA">Cul de sac de douglas  : </label>
                                        <input id="VAGINEPA" type="text" v-model="$props.EchographieGynecologique.culDeSacDouglas"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -10px;">
                                    </div>
                                </div>
                                <div style="display: flex; align-items: flex-start;">
                                    <label class="mt-3 font-weight-bold" for="conclusionEPA">CONCLUSION: </label>
                                    <textarea v-model="$props.EchographieGynecologique.conclusion" class="form-control ml-3 text-dark" id="conclusionEPA"
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
                            <button @click="updateEchographieGynecologique($props.EchographieGynecologique)" style="font-size: 20px" type="submit" class="btn mt-3 btn-primary ml-4"
                                :disabled="form.processing">
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
    EchographieGynecologique: Object})



const updateEchographieGynecologique = (EchographieGynecologique) => {
    router.visit(`/EchographieGynecologique/${EchographieGynecologique.id}`, {
        method: 'PUT',
        data: EchographieGynecologique,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onProgress: progress => { },
        onSuccess: page => { useToast().success('Echographie Gynecologique Bien Modifier', { position: 'bottom-right', duration: 3000 });
        $('#UpdateEchographieGynecologique').modal('hide');

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
            const printableElement = document.getElementById('printable-contentEGE');
            printableElement.classList.add('printable-contentEGE-print');
            printJS({
                printable: 'printable-contentEGE',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-contentEGE-print');
            }, 1000);
        }
    },
    mounted() {
        // this.$nextTick(() => {
        //     document.querySelector('.bd-EchographieGynecologique-modal-lg').addEventListener('shown.bs.modal', () => {
        //         this.printInvoice();
        //     });
        // });
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
