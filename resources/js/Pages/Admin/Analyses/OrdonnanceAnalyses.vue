<template>
    <div class="modal fade bd-OronnanceAnalyses-modal-lg" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Analyses
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
                        <div id="printable-contentOrdonnanceAnalyse" class="custom-margin-left" style="padding-top: 200px;">
                            <div class="header" style=" text-align: center;">
                                <h4 style="font-size: 18px;"> Taroudant Le : {{ currentDate }} : تارودانت في </h4>
                                <h1 class="ordonnance mt-1">Analyses</h1>
                                <h4 class="mt-1" style="font-size: 18px;"> {{ patient.nomPatient + " " +
                                    patient.prenomPatient }}
                                </h4>
                            </div>
                            <div
                                style="font-size: 20px; font-family: Verdana, Geneva, Tahoma, sans-serif; color: black; text-align: justify;margin-top: 65px;margin-left: 15px;">
                                <table>
                                    <tr>
                                        <td contenteditable="false">
                                            <div v-for="fa in familleanalyses" v-bind:key="fa.id">
                                                <template v-if="hasMatchingAnalyse(fa.id)">
                                                    <!-- <h6 class="text-left font-weight-bold familleAnalyse"
                                                        v-if="!faAlreadyDisplayed(fa.id)">
                                                        {{ fa.familleanalyse }}
                                                    </h6> -->
                                                    <span v-for="analyse in filteredAnalyses(fa.id)"
                                                        v-bind:key="analyse.id">
                                                        <ul>
                                                            <li class="Analyse" style="text-align: left;">
                                                                {{ analyse.nomAnalyse }}
                                                            </li>
                                                        </ul>
                                                        <span v-for="sousAnalyse in sousAnalyses"
                                                            v-bind:key="sousAnalyse.id">
                                                            <ul v-if="sousAnalyse.analyse_id == analyse.id">
                                                                <li class="sousAnalyse ml-4">{{ sousAnalyse.nomSousAnalyse }}</li>
                                                            </ul>
                                                        </span>
                                                    </span>
                                                </template>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
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
    analyses: Object,
    sousAnalyses: Object,
    familleanalyses: Object
})

</script>
<script>
import printJS from 'print-js';

export default {
    data() {
        return {
            currentDate: new Date(),
            formattedDate: '',
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

            let content = document.getElementById('printable-contentOrdonnanceAnalyse').outerHTML;

            printWindow.document.open();
            printWindow.document.write(`
        <html>
            <head>
                <title>Ordonnance</title>
                <style>
                    h1.ordonnance {
                        font-size: 35px !important;
                    }
                    #printable-contentOrdonnanceAnalyse{
                        margin-top:-100px;
                    }
                    .Analyse{
                        font-size:15px;

                    }
                    .sousAnalyse{
                        margin-left:20px;
                        font-size:12px;
                    }
                    .familleAnalyse{
                        font-size:13px;
                        margin-bottom:-10px;
                        margin-top:-10px;
                    }

                </style>
            </head>
            <body onload="window.print();window.close()">
                ${content}
            </body>
        </html>
    `);
            printWindow.document.close();
        },
        faAlreadyDisplayed(faId) {
            let displayedIds = [];
            for (let i = 0; i < this.familleanalyses.length; i++) {
                if (displayedIds.includes(this.familleanalyses[i].id)) {
                    continue;
                }
                if (this.familleanalyses[i].id === faId) {
                    displayedIds.push(faId);
                    return false;
                }
                displayedIds.push(this.familleanalyses[i].id);
            }
            return true;
        },
        hasMatchingAnalyse(faId) {
            return this.analyses.some(analyse => analyse.famille_analyse_id === faId);
        },
        filteredAnalyses(faId) {
            return this.analyses.filter(analyse => analyse.famille_analyse_id === faId);
        }

    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-OronnanceAnalyses-modal-lg').addEventListener('shown.bs.modal', () => {
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
