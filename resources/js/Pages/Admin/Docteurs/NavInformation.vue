<template>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-bg-primary rounded">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-2-line"></i></div>
                        <div class="text-left">
                            <h5 class="mb-0"><span class="counter">Total Patients </span></h5>
                            <h5>( {{ totalConsultation }} / {{ total }} )</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-bg-warning rounded">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-time-line"></i></div>
                        <div class="text-left">
                            <h5 class="mb-0"><span class="counter">Salle d'attente</span></h5>
                            <h5> ( {{ totalSalleAttente }} )</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-bg-danger rounded">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-calendar-2-line"></i>
                        </div>
                        <div class="text-left">
                            <h5 class="mb-0"><span class="counter">Rendez-Vous</span>
                            </h5>
                            <h5>( {{ totalRendezVous }} )</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-bg-info rounded">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="rounded-circle iq-card-icon bg-info"><i class="ri-exchange-dollar-line"></i>
                        </div>
                        <div class="text-left">
                            <h5 class="mb-0"><span class="counter">Total revenu</span></h5>
                            <h5 v-if="totalsByDate">( {{ totalsByDate['2023-06-27'] }} DH )</h5>
                            <h5 v-else>( 0 DH)</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ListAtt from "../Patients/ListAtt.vue";
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';



const props = defineProps({
    patientsAtt: Object,
    docteurs: Object,
    revenueToday: Number,
    revenueYesterday: Number,
    chartAH: Object,
    totalsByDate: Array,
    totalRevenu: Object,
    totalRendezVous: Object,
    totalSalleAttente: Object,
    totalConsultation: Object,
    total: Object,

});

</script>
