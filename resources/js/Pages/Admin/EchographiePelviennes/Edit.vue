<template>
    <p hidden>{{ (EchographiePelviennes.patient = patient) }}</p>

    <div class="modal fade" id="UpdateEchographiePelviennes" tabindex="-1" role="dialog"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title  text-white">Echographie Pelviennes
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

                        <div id="printable-contentEPE" class="custom-margin-left" style="padding-top: 80px;">
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
                                            for="indication">INDICATION :</label>
                                        <input id="indication" type="text" v-model="$props.EchographiePelviennes.indication"
                                            class="form-control text-dark" style="width: 300px; border: none; ">
                                    </div>
                                </div>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="indication">VESSIE
                                            :</label>
                                        <input id="indication" type="text" v-model="$props.EchographiePelviennes.vessie"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;">
                                    </div>
                                </div>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="indication">VAGIN
                                            ET COL :</label>
                                        <input id="indication" type="text" v-model="$props.EchographiePelviennes.vaginetcol"
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
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Position :
                                        </label>
                                        <input id="indication2" type="text"
                                            v-model="$props.EchographiePelviennes.uterus_position"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold " for="indication3"
                                            style="white-space: nowrap;">Contours :</label>
                                        <input id="indication3" type="text"
                                            v-model="$props.EchographiePelviennes.uterus_contours"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                            Echo structure :
                                        </label>
                                        <input id="indication4" type="text"
                                            v-model="$props.EchographiePelviennes.uterus_echo_structure"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>

                                    <div style="display: flex; align-items: center; ;">
                                        <label class="font-weight-bold" for="indication5"
                                            style="white-space: nowrap;">Endomètre :</label>
                                        <input id="indication5" type="text" v-model="$props.EchographiePelviennes.endometre"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px;">
                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" for="indication5"
                                            style="white-space: nowrap;">Cavite utérine :</label>
                                        <input id="indication5" type="text"
                                            v-model="$props.EchographiePelviennes.uterine_cavite"
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
                                        <label class="font-weight-bold" for="indication2" style="white-space: nowrap;">DROIT
                                            :
                                        </label>
                                        <input id="indication2" type="text"
                                            v-model="$props.EchographiePelviennes.ovaire_droit"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px;">
                                    </div>

                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" for="indication3"
                                            style="white-space: nowrap;">GAUCHE :</label>
                                        <input id="indication3" type="text"
                                            v-model="$props.EchographiePelviennes.ovaire_gauche"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                </div>


                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;" for="indication">TROMPE
                                            :</label>
                                    </div>
                                </div>
                                <div class="ml-5">
                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold" for="indication2" style="white-space: nowrap;">DROIT
                                            :
                                        </label>
                                        <input id="indication2" type="text"
                                            v-model="$props.EchographiePelviennes.trompe_droit"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px;">
                                    </div>

                                    <div style="display: flex; align-items: center; ">
                                        <label class="font-weight-bold" for="indication3"
                                            style="white-space: nowrap;">GAUCHE :</label>
                                        <input id="indication3" type="text"
                                            v-model="$props.EchographiePelviennes.trompe_gauche"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px;">
                                    </div>

                                </div>


                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <label class="font-weight-bold" style="white-space: nowrap;"
                                            for="indication">DOUGLAS :</label>
                                        <input id="indication" type="text" v-model="$props.EchographiePelviennes.douglass"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px;">

                                    </div>
                                </div>
                                <div style="display: flex; align-items: flex-start;">
                                    <label class="mt-3 font-weight-bold" for="indication">Conclusion </label>
                                    <textarea v-model="$props.EchographiePelviennes.conclusion"
                                        class="form-control ml-3 text-dark" style="border: none;"></textarea>
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
                            <button @click="updateEchographiePelviennes($props.EchographiePelviennes)" style="font-size: 20px" type="submit" class="btn mt-3 btn-primary ml-4"
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
    EchographiePelviennes: Object
})

const updateEchographiePelviennes = (EchographiePelviennes) => {
    router.visit(`/EchographiePelviennes/${EchographiePelviennes.id}`, {
        method: 'PUT',
        data: EchographiePelviennes,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onProgress: progress => { },
        onSuccess: page => { useToast().success('Echographie Pelviennes Bien Modifier', { position: 'bottom-right', duration: 3000 });
        $('#UpdateEchographiePelviennes').modal('hide');

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
            const printableElement = document.getElementById('printable-contentEPE');
            printableElement.classList.add('printable-contentEPE-print');
            printJS({
                printable: 'printable-contentEPE',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-contentEPE-print');
            }, 1000);
        }
    },
    mounted() {
        // this.$nextTick(() => {
        //     document.querySelector('.bd-EchographiePelvienne-modal-lg').addEventListener('shown.bs.modal', () => {
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
