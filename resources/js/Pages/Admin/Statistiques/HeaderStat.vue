<template>
    <span hidden>{{ user= $page.props.user }}</span>
    <div class="col-lg-12 mt-4">
        <ul class="iq-edit-profile  nav" style="margin-top: -25px; ">
            <li class="col-lg-3 col-md-6 col-sm-12" >
                <a class="nav-link p-0 linkcss" data-toggle="pill" >
                    <div class="iq-card-block iq-card-height py-0 nav-pills">
                        <div class="iq-card-body iq-bg-primary rounded">
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="ri-user-2-line " style="font-size: 20px;"></i>
                                <div class="text-right ml-2">
                                    <h6 class="">Total Patients ( {{ DocteurState[0].totalConsultation }} / {{
                                        DocteurState[0].totalPatients + DocteurState[0].totalConsultation }} )</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="col-lg-3 col-md-6 col-sm-12">
                <a class="nav-link p-0 linkcss" data-toggle="pill">
                    <div class="iq-card iq-card-block iq-card-height py-0 nav-pills">
                        <div class="iq-card-body iq-bg-primary rounded">
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="ri-time-line" style="font-size: 20px;"></i>
                                <div class="text-right ml-1">
                                    <h6 class="">Salle d'attente ( {{ DocteurState[0].totalSalleAttente }} )</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="col-lg-3 col-md-6 col-sm-12">
                <a class="nav-link p-0 linkcss" data-toggle="pill" >
                    <div class="iq-card iq-card-block py-0 iq-card-height nav-pills">
                        <div class="iq-card-body iq-bg-primary rounded">
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="ri-calendar-2-line" style="font-size: 20px;"></i>
                                <div class="text-right ml-1">
                                    <h6 class="">Rendez-Vous ( {{  DocteurState[0].totalRendezVous }} )</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>

            <!-- <li class="col-lg-3 col-md-6 col-sm-12" data-intro='Voici où vous pouvez voir la liste des patients.' data-step='4' hidden>
                <a class="nav-link p-0 linkcss" data-toggle="pill" >
                    <div class="iq-card iq-card-block py-0 iq-card-height nav-pills">
                        <div class="iq-card-body iq-bg-primary rounded">
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="ri-exchange-dollar-line" style="font-size: 20px;"></i>
                                <div class="text-right ml-1">
                                    <h6 class="m-0">Revenu Permis ( {{ DocteurState[0].TotalRevenuPermis }} DH )</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li> -->
        
            <li class="col-lg-3 col-md-6 col-sm-12">
                <a class="nav-link p-0 linkcss" data-toggle="pill" >
                    <div class="iq-card iq-card-block py-0 iq-card-height nav-pills">
                        <div class="iq-card-body iq-bg-success rounded">
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="ri-exchange-dollar-line" style="font-size: 20px;"></i>
                                <div class="text-right ml-1">
                                    <h6 class="m-0">Revenu Total ( {{ DocteurState[0].totalRevenu }} DH )</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>

        </ul>
    </div>
</template>
<script setup>
import { Link, router, useForm } from "@inertiajs/vue3";
import { onMounted, ref, computed } from "vue";

const props = defineProps({
    docteur: Object,
});

let DocteurState = ref(props.docteur);

onMounted(() => {
    DocteurState.value = props.docteur;
    window.Echo.channel('header-statistiques-doctor').listen('HeaderStatistiquesDoctor', (e) => {
        DocteurState.value = e.docteur;
    });
});







</script>
