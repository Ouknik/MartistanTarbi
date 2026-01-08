<template>
    <div class="modal fade" id="UpdateEchographieNormale" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title  text-white">Echographie Normale
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <HeaderDocteurE></HeaderDocteurE>

                        <span hidden>
                            {{
                                (form.date = new Date()
                                    .toJSON()
                                    .slice(0, 10))
                            }}
                        </span>
                        <div id="printable-contentEN" class="custom-margin-left" style="padding-top: 110px;">
                            <div class="header" style=" text-align: center; ">
                                <h1 class="font-weight-bold">ECHOGRAPHIE NORMALE</h1>
                                <h6>Date : {{ $props.EchographieNormale.date }}</h6>
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
                                <textarea v-model="$props.EchographieNormale.compte_rendu"
                                    class="form-control ml-1 text-dark mt-2 mr-4" style="border: none; font-size: 15px;" id="conclutionUEDG"
                                    rows="12">
                            </textarea>
                            </div>
                            <h3 class="mt-3 font-weight-bold text-center" for="Conclusion">Conclusion </h3>
                            <div style="display: flex; align-items: flex-start; margin-top: 30px;">
                                <textarea v-model="$props.EchographieNormale.conclusion" id="Conclusion"
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
                                @click="updateEchographieNormale($props.EchographieNormale)">
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
import HeaderDocteurE from "../../../Layouts/Template/HeaderDocteur.vue";
import FooterDocteur from "../../../Layouts/Template/FooterDocteur.vue";

defineProps({
    patient: Object,
    EchographieNormale: Object,
    age: Number,
    gestationnelle: Object
})



const updateEchographieNormale = (EchographieNormale) => {
    router.visit(`/EchographieNormales/${EchographieNormale.id}`, {
        method: 'PUT',
        data: EchographieNormale,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onProgress: progress => { },
        onSuccess: page => { useToast().success('Echographie Normale Bien Modifier', { position: 'bottom-right', duration: 3000 });
        $('#UpdateEchographieNormale').modal('hide');

    },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
}
</script>
<script>
import printJS from 'print-js';
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";

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
            const printableElement = document.getElementById('printable-contentEN');
            printableElement.classList.add('printable-contentEN-print');
            printJS({
                printable: 'printable-contentEN',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-contentEN-print');
            }, 1000);
        }
    },
    mounted() {
        // this.$nextTick(() => {
        //     document.querySelector('.bd-EchographieNormale-modal-lg').addEventListener('shown.bs.modal', () => {
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
    }

    #printable-contentEN {
        padding-top: 150px;
        margin-top: 200px;
    }
}

.custom-margin-left {
    margin-left: 50px;
}
</style>
