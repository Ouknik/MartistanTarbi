<template>
    <p hidden>{{ (EchographieDebutGrossesse.patient = patient.id) }} {{ EchographieDebutGrossesse.consultation_id= idConsultation }}</p>
    <div class="modal fade bd-EchographieDebutGrossesse-modal-lg" tabindex="-1" id="EchographieDebutGrossesse" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Echographie Debut Grossesse
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

                        <div id="printable-contentEDG" class="custom-margin-left" style="padding-top: 150px;">
                            <div class="header" style=" text-align: center; ">
                                <h1 id="print-title" class="font-weight-bold display-5">ECHOGRAPHIE OBSTETRICALE</h1>
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

                            <div class="mt-2">
                                <div style="display: flex; align-items: center;">
                                    <label class="font-weight-bold mt-2" style="white-space: nowrap;"
                                        for="indication">INDICATION
                                        :</label>
                                    <input id="indication" type="text" v-model="EchographieDebutGrossesse.indication"
                                        class="form-control text-dark" style="width: 300px; border: none; ">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div style="display: flex; align-items: center;">
                                    <h4 class="font-weight-bold" style="white-space: nowrap;" for="indication">
                                        1<sup>er</sup> TRIMESTRE : </h4>
                                </div>
                            </div>
                            <div class="ml-4" style="margin-left: 20px; margin-top: 50px;">
                                <div class="ml-5">
                                    <div style="display: flex; align-items: center; margin-top: 15px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Utérus :
                                        </label>
                                        <input id="indication2" type="text" v-model="EchographieDebutGrossesse.uterus"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; margin-top: 15px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication3" style="white-space: nowrap;">OEuf
                                            Unique / Multiple :</label>
                                        <input id="indication3" type="text" v-model="EchographieDebutGrossesse.oeuf"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center;  margin-top: 15px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                            Embryon :
                                        </label>
                                        <input id="indication4" type="text" v-model="EchographieDebutGrossesse.embryon"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                </div>
                                <div style="display: flex; align-items: flex-start; margin-top: 60px;">
                                    <h3 class="mt-3 font-weight-bold" for="indication">Conclusion </h3>
                                    <textarea v-model="EchographieDebutGrossesse.conclusion"
                                        class="form-control ml-3 text-dark mt-2" style="border: none;">

                                        Sac gestationnel {{ EchographieDebutGrossesse.gestationnelle }} SA à contrôler {{ EchographieDebutGrossesse.aControler }}
                                    </textarea>
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
import { ref } from "vue";
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";
import FooterDocteur from "../../../Layouts/Template/FooterDocteur.vue";

const props = defineProps({
    patient: Object,
    age: Number,
    gestationnelle: Object,
    idConsultation:Number,
})
const EchographieDebutGrossesse = useForm({
    indication: 'Grossesse',
    uterus: 'Gravide ',
    oeuf: '1',
    embryon: 'non vu',
    sacGestationnel: '04-05',
    aControler: '15 jrs',
    consultation_id: props.idConsultation,
    conclusion:'sac gestationnel de ',
    patient:props.patient
})
const submit = () => {
    if(props.idConsultation==0)
    {
        useToast().error('Veuillez Choisir une consultation ', { position: 'bottom-right', duration: 3000 });
       return false
    }

    router.visit('/EchographieDebutGrossessess', {
        method: 'post',
        data: EchographieDebutGrossesse,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => { useToast().success('Echographie Debut Grossesse Bien Ajouter avec ', { position: 'bottom-right', duration: 3000 });
        $('#EchographieDebutGrossesse').modal('hide');
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
            const printableElement = document.getElementById('printable-contentEDG');
            printableElement.classList.add('printable-contentEDG-print');
            printJS({
                printable: 'printable-contentEDG',
                type: 'html',
                targetStyles: ['*'],
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-contentEDG-print');
            }, 1000);
        }
    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-EchographieDebutGrossesse-modal-lg').addEventListener('shown.bs.modal', () => {
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

    #printable-contentEDG {
        padding-top: 150px;
    }

    h2.font-weight-bold {
        font-size: 30px !important;
    }

    div.font-weight-bold {
        font-size: 100px !important;
    }

    #print-title {
        font-size: 3em;
    }
}

.custom-margin-left {
    margin-left: 50px;
}
</style>
