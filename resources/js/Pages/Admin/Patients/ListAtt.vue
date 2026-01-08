<template>
    <span hidden>{{ user= $page.props.user }}</span>
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
        <div class="iq-card-header d-flex justify-content-between  color-template">
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <h4 class="text-white font-weight-bold">
                    Liste Attente
                </h4>
            </div>
        </div>
        <div class="iq-card-body scroller">
            <div class="chat-sidebar-channel scroller" style="min-height: 1100px;">
                    <div v-for="(patient, index) in patientsAttData" v-bind:key="patient.id" class="tasks-card">
                        <label class="font-size-16 font-weight-bold p-1">{{ index+1 }}</label>
                        <img :src="patient.sexePatient == 'Masculin'
                            ? '/images/user/14.jpg'
                            : '/images/user/02.jpg'
                            " alt="story-img" class="rounded-circle avatar-40" style="margin-top: -28px;" />
                        <label class="ml-2" style="margin-bottom: 0px;">
                            <Link :href="'/patients/' + patient.id" as="button" class="btn btn-Light"
                                style="color: black; font-weight: bold; font-size: medium; margin-left: -19px;"
                                preserve-scroll preserve-state>
                            {{ patient.nomPatient }}
                            {{ patient.prenomPatient }}
                            </Link>
                            <p class="text-primary font-weight-bold">{{ patient.statutPatient }}</p>

                        </label>
                        <Link :href="'/patientsAtt/' + patient.id + '/' + patient.suiviPar + '/' + patient.statutPatient"
                            method="put" as="button" class="close ml-auto" preserve-scroll preserve-state>
                        <i style="font-size: 35px;" class="ri-close-line text-danger"></i>
                        </Link>
                    </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
const props = defineProps({
    patientsAtt: Array,
    docteurs: Object,
});
const getStatusClass = (status) => {
    switch (status) {
        case 'Consultation':
            return 'text-warning font-weight-bold';
        case 'Contrôle':
            return 'text-primary font-weight-bold';
        case 'Bilan':
            return 'text-info font-weight-bold';
        case 'Urgent':
            return 'text-danger font-weight-bold';
        case 'Nouvelle Consultation':
            return 'text-warning font-weight-bold';
        case 'IRM':
            return 'text-info font-weight-bold';
        case 'Mammographie':
            return 'text-dark font-weight-bold';
        default:
            return '';
    }
};
let patientsAttData = ref(props.patientsAtt);
onMounted(() => {
    patientsAttData.value = props.patientsAtt;
    window.Echo.channel('add-to-list').listen('AddToListAtt', (e) => {
        patientsAttData.value = e.patientsAtt;
    });
});
</script>