<template>
    <p hidden>{{ (EchographieNormale.patient = patient) }}  {{ EchographieNormale.consultation_id= idConsultation }}</p>

    <div class="modal fade bd-EchographieNormale-modal-lg" tabindex="-1" id="EchographieNormale" role="dialog"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white ">Echographie Normale
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
                        <div id="printable-contentENedit" class="custom-margin-left" style="padding-top: 110px;">
                            <div class="header" style=" text-align: center; ">
                                <h1 class="font-weight-bold">ECHOGRAPHIE NORMALE</h1>
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
                            <h3 class="font-weight-bold text-center" style="margin-top: 20px;"> COMPTE RENDU</h3>
                            <div style="display: flex; align-items: flex-start; margin-top: 10px;">
                                <textarea v-model="EchographieNormale.compte_rendu"
                                    class="form-control ml-1 text-dark mt-2 mr-4" style="border: none; font-size: 15px; "
                                    rows="12">
                                    </textarea>
                            </div>
                            <h3 class="mt-3 font-weight-bold text-center" for="indication">Conclusion </h3>
                            <div style="display: flex; align-items: flex-start; margin-top: 30px;">
                                <textarea v-model="EchographieNormale.conclusion"
                                    class="form-control ml-1 text-dark mt-2 mr-4" style="border: none; font-size: 17px; "
                                    rows="3">
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
    idConsultation:Number,
})
const EchographieNormale = useForm({
    compte_rendu: '',
    conclusion: '',
    consultation_id: props.idConsultation,
    patient: ""
})


EchographieNormale.conclusion = ' Echographie Abdomino-pelvienne normale';

EchographieNormale.compte_rendu = `* Foie de volume normal, de contour régulier et d'échostructure finement homogène
* Vésicule biliaire à paroi fine non lithiasique.
* VBP et VBIH non dilatées.
* Pancréas de taille normale, aux contours nets et d'échostructure homogène.
* Rate de taille normale, bien limitée par une capsule dense et d'échostructure parenchymateuse homogène.
* Reins de taille normale, aux contours réguliers présentant une bonne différenciation cortico-médullaire.
* Vessie de contenu transsonique et à paroi régulière.
* Utérus de volume normal, aux contours réguliers et échostructure homogène.
* Vacuité de la cavité utérine.
* Pas d'épanchement péritonéal.`;



const submit = () => {
    if(props.idConsultation==0)
    {
        useToast().error('Veuillez Choisir une consultation ', { position: 'bottom-right', duration: 3000 });
       return false
    }
    router.visit('/EchographieNormales', {
        method: 'post',
        data: EchographieNormale,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Echographie Normale Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#EchographieNormale').modal('hide');
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
            const printableElement = document.getElementById('printable-contentENedit');
            printableElement.classList.add('printable-contentEN-print');
            printJS({
                printable: 'printable-contentENedit',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-contentEN-print');
            }, 1000);
        }
    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-EchographieNormale-modal-lg').addEventListener('shown.bs.modal', () => {
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

    #printable-contentEN {
        padding-top: 150px;
    }
}

.custom-margin-left {
    margin-left: 50px;
}
</style>
