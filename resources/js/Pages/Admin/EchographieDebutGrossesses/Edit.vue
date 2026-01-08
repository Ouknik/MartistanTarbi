<template>
    <div class="modal fade" id="UpdateEchographieGrossesse" tabindex="-1" role="dialog" style="display: none;"
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
                        <HeaderDocteur ></HeaderDocteur>

                        <span hidden>
                            {{
                                (form.date = new Date()
                                    .toJSON()
                                    .slice(0, 10))
                            }}
                        </span>

                        <div id="printable-contentEDGE" class="custom-margin-left" style="padding-top: 150px;">
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
                                    <input id="indication" type="text" v-model="$props.EchographieDebutGrossesse.indication"
                                        class="form-control text-dark" style="width: 300px; border: none; ">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div style="display: flex; align-items: center;">
                                    <h4 class="font-weight-bold" style="white-space: nowrap;">
                                        1<sup>er</sup> TRIMESTRE : </h4>
                                </div>
                            </div>
                            <div class="ml-4" style="margin-left: 20px; margin-top: 50px;">
                                <div class="ml-5">
                                    <div style="display: flex; align-items: center; margin-top: 15px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="uterus"
                                            style="white-space: nowrap;">Utérus :
                                        </label>
                                        <input id="uterus" type="text"
                                            v-model="$props.EchographieDebutGrossesse.uterus" class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; margin-top: 15px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="oeuf" style="white-space: nowrap;">OEuf
                                            Unique / Multiple :</label>
                                        <input id="oeuf" type="text" v-model="$props.EchographieDebutGrossesse.oeuf"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center;  margin-top: 15px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="Embryon" style="white-space: nowrap;">
                                            Embryon :
                                        </label>
                                        <input id="Embryon" type="text"
                                            v-model="$props.EchographieDebutGrossesse.embryon"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                </div>
                                <div style="display: flex; align-items: flex-start; margin-top: 60px;">
                                    <h3 class="mt-3 font-weight-bold" for="indication">Conclusion </h3>
                                    <textarea v-model="$props.EchographieDebutGrossesse.conclusion" id="indication"
                                        class="form-control ml-3 text-dark mt-2" style="border: none;">

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
                                @click="updateEchographieGrossesse($props.EchographieDebutGrossesse)">
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
import { ref } from "vue";
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";
import FooterDocteur from "../../../Layouts/Template/FooterDocteur.vue";

const props = defineProps({
    patient: Object,
    age: Number,
    gestationnelle: Object,
    EchographieDebutGrossesse: Object
})

const updateEchographieGrossesse = (echographieDebutGrossesse) => {
    router.visit(`/EchographieDebutGrossessess/${echographieDebutGrossesse.id}`, {
        method: "PUT",
        data: echographieDebutGrossesse,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: (page) => {
            useToast().success('Echographie Modifier', {
                position: 'bottom-right',
                duration: 3000
            });
            $('#UpdateEchographieGrossesse').modal('hide');

        },
    });
};
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
            const printableElement = document.getElementById('printable-contentEDGE');
            printableElement.classList.add('printable-contentEDGE-print');
            printJS({
                printable: 'printable-contentEDGE',
                type: 'html',
                targetStyles: ['*'],
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-contentEDGE-print');
            }, 1000);
        },
    },
    mounted() {
        // this.$nextTick(() => {
        //     document.querySelector('.bd-EchographieDebutGrossesse-modal-lg').addEventListener('shown.bs.modal', () => {
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

    #printable-contentEDGE {
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
