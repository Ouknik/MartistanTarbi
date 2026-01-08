<template>
    <div class="modal fade bd-Ordonnanceview-modal-lg" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Ordonnance
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="ordonnance">
                        <HeaderDocteur v-if="ordonnance.ConsultationDocteurID && ordonnance.ConsultationDocteurID == 1">
                        </HeaderDocteur>
                        <span hidden>
                            {{
                                (form.date = new Date()
                                    .toJSON()
                                    .slice(0, 10))
                            }}
                        </span>
                        <div id="printable-contentOrdonnance" style="padding-top: 120px;">
                            <div class="header" style=" text-align: center;">

                                <h4 style="font-size: 18px;"> Taroudant Le : {{ ordonnance.dateOrdonnance }} : تارودانت في
                                </h4>
                                <h1 class="ordonnance mt-1">Ordonnance</h1>
                                <h4 class="mt-1" style="font-size: 18px;"> {{ patient.nomPatient + " " +
                                    patient.prenomPatient }}
                                </h4>
                            </div>
                            <div class="medicaments"
                                style="font-size: 20px; font-family: Verdana, Geneva, Tahoma, sans-serif; color: black; text-align: justify;margin-top: 15px;margin-left: 15px;">
                                <table v-if="ordonnance">
                                    <tr>
                                        <td contenteditable="false">
                                            <div v-for="ordonnanc in ordonnance.medicaments" v-bind:key="ordonnanc.id">
                                                <h6 class="text-left font-weight-bold"
                                                    style="font-size: 12px; margin-top: 20px;"> {{
                                                        ordonnanc.nomMedicament + " " +
                                                        ordonnanc.dosageMedicament + " " + ordonnanc.uniteDosageMedicament }}
                                                </h6>
                                                <ul>
                                                    <li class="detailsM" style="text-align: left;">
                                                        {{ ordonnanc.pivot.prescription }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-dark float-right mr-5"
                                v-if="patient.RendezVous[0] && new Date(patient.RendezVous[0].dateRendezVous) > new Date()">
                                RDV Prochain:
                                <span style="font-size: 14px; margin-top: 55px;"> {{ patient.RendezVous[0].dateRendezVous }}
                                </span>
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
    ordonnance: Object
})

</script>
<script>
import printJS from 'print-js';

export default {
    data() {
        return {
            formattedDate: '',
            currentDate: new Date(),
            form: {
            }
        }
    },
    methods: {
        printInvoice() {
            let width = 800;
            let height = 800;
            let left = (screen.width - width) / 2;
            let top = (screen.height - height) / 2;
            let printWindow = window.open('', '', `width=${width},height=${height},top=${top},left=${left}`);
            let content = document.getElementById('printable-contentOrdonnance').outerHTML;
            printWindow.document.open();
            printWindow.document.write(`
            <html>
                <head>
                    <title>Ordonnance</title>
                    <style>
                        h1.ordonnance {
                            font-size: 35px !important;
                        }
                        #printable-contentOrdonnance{
                            margin-top:10px;
                        }
                        .detailsM{
                            margin-top:-25px;
                            font-size:10px;
                        }
                        .medicaments{
                            margin-top:-40px;
                        }
                    </style>
                </head>
                <body onload="window.print();window.close()">
                    ${content}
                </body>
            </html>
    `);
            printWindow.document.close();
        }

    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-Ordonnanceview-modal-lg').addEventListener('shown.bs.modal', () => {
                this.printInvoice();
            });
        });
        const date = new Date();
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        this.currentDate = `${day < 10 ? '0' + day : day}-${month < 10 ? '0' + month : month}-${year}`;
    }
};
</script>
<style>
@media print {
    label {
        display: inline-block;
    }

    #printable-contentOrdonnance {
        padding-top: 200px;
    }

    #printable-contentOrdonnance h1.ordonnance {
        font-size: 75px !important;
        /* Adjust as needed */
    }

    .text-left {
        font-size: 20px !important;
        /* Adjust as needed */
    }

    h1.ordonnance {
        font-size: 75px !important;
        /* Ajustez selon vos besoins */
    }
}

.custom-margin-left {
    margin-left: 50px;
}

h1.ordonnance {
    font-size: 55px;
    /* adjust as needed */
}
</style>
