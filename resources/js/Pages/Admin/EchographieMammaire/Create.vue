<template>
    <p hidden>{{ (EchographieMammaire.patient = patient) }} {{ EchographieMammaire.consultation_id= idConsultation }}</p>
    <div class="modal fade bd-EchographieMammaire-modal-lg" tabindex="-1" id="EchographieMammaire" role="dialog"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Echographie Mammaire
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

                        <div id="printable-contentEM" class="custom-margin-left" style="padding-top: 130px;">
                            <div class="header" style=" text-align: center; ">
                                <h1 class="font-weight-bold">ECHOGRAPHIE MAMMAIRE</h1>
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
                            <!-- <div style="display: flex; align-items: center;">
                                <label class="font-weight-bold mt-2" style="white-space: nowrap;" for="indication">Motif
                                    de l'examen :</label>
                                <input id="indication" type="text" v-model="EchographieMammaire.motif_examen"
                                    class="form-control text-dark" style="width: 900px; border: none; ">
                            </div> -->
                            <h3 class="font-weight-bold text-left" style="margin-top: 35px;"> INDICATION :</h3>
                            <div style="display: flex; align-items: flex-start; margin-top: 10px;">
                                <textarea v-model="EchographieMammaire.compte_rendu"
                                    class="form-control ml-1 text-dark mt-2 mr-4" style="border: none; font-size: 20px; "
                                    rows="3">
                                    </textarea>
                            </div>
                            <h3 class="mt-3 font-weight-bold text-center" for="indication">Conclusion </h3>
                            <div style="display: flex; align-items: flex-start; margin-top: 10px;">
                                <textarea v-model="EchographieMammaire.conclusion"
                                    class="form-control ml-1 text-dark mt-2 mr-4 text-center" style="border: none; font-size: 17px; "
                                    rows="4">

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
const EchographieMammaire = useForm({
    motif_examen: '',
    DDR: ' ',
    compte_rendu: '',
    embryon: '',
    conclusion: 'Echographie mammaire sans particularités ce jour.',
    consultation_id: "",
    patient: ""
})
const submit = () => {
    if(props.idConsultation==0)
    {
        useToast().error('Veuillez Choisir une consultation ', { position: 'bottom-right', duration: 3000 });
       return false
    }
    router.visit('/EchographieMammaires', {
        method: 'post',
        data: EchographieMammaire,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Echographie Mammaire Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#EchographieMammaire').modal('hide');
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
            const printableElement = document.getElementById('printable-contentEM');
            printableElement.classList.add('printable-contentEM-print');
            printJS({
                printable: 'printable-contentEM',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-contentEM-print');
            }, 1000);
        }
    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-EchographieMammaire-modal-lg').addEventListener('shown.bs.modal', () => {
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
}
.custom-margin-left {
    margin-left: 50px;
}</style>
