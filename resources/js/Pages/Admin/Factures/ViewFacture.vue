<template>
    <div class="modal fade bd-Factureview-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">
                            Note d'honoration

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="facture">
                        <HeaderDocteur></HeaderDocteur>

                        <div id="printable-contentFacture">
                            <div class="header" style=" text-align: center; ">
                                <!-- <h4 style="font-size: 15px; "> {{ facture.dateFacture }} </h4>
                                <h4 v-if="$props.patient" class="mt-2" style="font-size: 18px;"> {{ patient.nomPatient + " "
                                    + patient.prenomPatient }}
                                </h4>
                                <h1 class="facture mt-2">Note d'honoration</h1> -->
                                <h4 style="font-size: 18px;"> Taroudant Le : {{ facture.dateFacture }} : تارودانت في
                                </h4>
                                <h1 class="ordonnance mt-1">Note d'honoration</h1>
                                <h4 class="mt-1" style="font-size: 18px;"> {{ patient.nomPatient + " " +
                                    patient.prenomPatient }}
                                </h4>
                                

                            </div>
                            <div class="invoice-details"
                                style="font-size: 23px; font-family: Verdana, Geneva, Tahoma, sans-serif; color: black; text-align: justify;">
                                <table border="1" style="width: 100%;">

                                    <thead class="text-center">
                                        <tr>
                                            <th>N°</th>
                                            <th>Désignation</th>
                                            <th>Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="facture" class="text-center">

                                        <tr v-for="(soin, index) in JSON.parse(facture.soins)" :key="index">
                                            <td class="center">{{ index + 1 }}</td>
                                            <td> {{ soin.libelleSoin }}</td>
                                            <td class="center text-center"> {{ soin.montantSoin + " DH" }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2" class="text-start font-weight-bold center">Total </td>
                                            <td class="center font-weight-bold">{{ facture.montantFacture + " DH" }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <p v-if="facture" class="text-left text-black" id="footer-facture" style="font-size: 12px;">
                                    Arrêter la Présente Note à la Somme de
                                    <span> {{ facture.montantLettre }}</span> Dirhams
                                    (<span>{{ facture.montantFacture }}</span> DH )
                                </p>

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
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";
import FooterDocteur from "../../../Layouts/Template/FooterDocteur.vue";

const props = defineProps({
    patient: Object,
    facture: Object,
})
</script>
<script>
import printJS from 'print-js';

export default {
    data() {
        return {
            formattedDate: '',
            sumDays: 0,
            currentDate: '',
        }
    },
    methods: {
        printInvoice() {
            let printContents = document.getElementById('printable-contentFacture').innerHTML;
            let mywindow = window.frames["print_frame"];

            mywindow.document.body.innerHTML = `
            <style>
                body {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 110px;
                    padding : 10px;
                }
                .invoice-details {
                    line-height: 1.9; /* Adjust this value to change the line spacing */
                }
                .invoice-details table td {
                    text-align: center;
                }
                .invoice-details table td, .invoice-details table th {
                    border: 1px solid black;
                }

            </style>
            <div class="print-container">` + printContents + `</div>`;

            mywindow.focus();
            mywindow.print();
        },
    },
    mounted() {
        const date = new Date();
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        this.currentDate = `${day < 10 ? '0' + day : day}-${month < 10 ? '0' + month : month}-${year}`;
    }
};
</script>
<style>
#printable-contentFacture {
    margin-top: 300px;
}

.header {
    margin-top: 15%;
}

.custom-margin-left {
    margin-left: 50px;
}

h1.facture {
    font-size: 55px;
}
</style>
