<template>
    <div class="modal fade" id="Gestationnel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Suivi de grossesse, Matérnité
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="submit">
                    <div class="modal-body">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body">
                                <ul class="iq-timeline">
                                    <li>
                                        <div class="timeline-dots-fill"></div>
                                        <h6 class="float-left mb-2 text-dark">
                                            <i class="ri-user-fill"></i>
                                            Dernières règles
                                        </h6>
                                        <small class="float-right mt-1"></small>
                                        <div class="d-inline-block w-100">
                                            <input type="date" @change="calculDate" class="form-control"
                                                v-model="insertedDate" id="exampleInputdate" max="" />
                                            <span style="font-weight: bold; color: black; margin-right: 20px;"
                                                v-if="nbrWeeks != null && !isNaN(nbrWeeks)">{{ nbrWeeks }}
                                                Semaine(s)</span>
                                            <span style="font-weight: bold; color: black;"
                                                v-if="nbrDays != null && !isNaN(nbrDays)"> {{ nbrDays }} Jour(s)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-dots-fill bg-success"></div>
                                        <h6 class="float-left mb-2 text-dark">
                                            <i class="ri-heart-fill bg-color-red"></i>
                                            Grossesse
                                        </h6>
                                        <small class="float-right mt-1"></small>
                                        <div class="d-inline-block w-100">
                                            <input disabled type="date" class="form-control" id="exampleInputdate2" />
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-dots-fill bg-info"></div>
                                        <h6 class="float-left mb-2 text-dark">
                                            <i class="ri-user-fill"></i>
                                            Accouchement
                                        </h6>
                                        <small class="float-right mt-1"></small>
                                        <div class="d-inline-block w-100">
                                            <input disabled type="date" class="form-control" value=""
                                                id="exampleInputdate3" />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Fermer
                        </button>
                        <button v-if="$page.props.patient" type="submit" class="btn btn-primary">
                            Enregistrer </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

import { useForm, router, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from 'vue-toast-notification';


const props = defineProps({
    patient: Object,
});


const insertedDate = ref(new Date());
const nbrWeeks = ref(0);
const nbrDays = ref(0);
const dateNow = ref(new Date());
function diffDays(dt2, dt1) {
    const diff = (dt2.getTime() - dt1.getTime()) / 1000;
    return Math.abs(Math.round(diff / (60 * 60 * 24)));
}
function calculDate() {
    dateNow.value = new Date();
    const dateInserted = new Date(insertedDate.value);
    const diffTime = Math.abs(dateNow.value - dateInserted);
    const nbrDay = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    const newDate = new Date(dateInserted);
    newDate.setDate(newDate.getDate() + 14);
    document.getElementById("exampleInputdate2").value = formatDate(newDate);

    gestationnelle.dateGrosesse = formatDate(newDate);

    const newDate2 = new Date(newDate);
    newDate2.setDate(newDate2.getDate() + (40 * 7 - 14));
    document.getElementById("exampleInputdate3").value = formatDate(newDate2);

    gestationnelle.dateAccouchement = formatDate(newDate2);
    gestationnelle.dateDernierRegle = formatDate(dateInserted);

    nbrWeeks.value = Math.floor(nbrDay / 7); // Calculate weeks without rounding
    nbrDays.value = nbrDay % 7;
}

// Function to format date as YYYY-MM-DD
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
}
const gestationnelle = useForm({
    dateDernierRegle: "",
    dateGrosesse: "",
    dateAccouchement: "",
    patient: ""

});
const submit = () => {
    if (!gestationnelle.dateDernierRegle) {
        useToast().error("Veuillez saisir la date de Dernières règles", { position: 'bottom-right', duration: 3000 });
        return; 
    }
    gestationnelle.patient = props.patient ? props.patient.id : null
    router.visit("/gestationnelles", {
        method: "post",
        data: gestationnelle,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        onProgress: (progress) => { },
        onSuccess: page => {
            useToast().success(' Bien Ajouté', { position: 'bottom-right', duration: 3000 });
            // gestationnelle.dateAccouchement="";
            // gestationnelle.dateDernierRegle="";
            // gestationnelle.dateGrosesse="";
            $('#Gestationnel').modal('hide');

        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
};
</script>