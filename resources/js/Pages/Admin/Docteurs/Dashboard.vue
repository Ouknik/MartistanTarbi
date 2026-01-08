<template>
    <AdminLayout>
        <HeaderStatistiquesDoctors :docteur="docteurs"></HeaderStatistiquesDoctors>

        <div class="row">
            <div class="col-md-12 col-lg-9">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="iq-card" style="background-color: #ffffff;">
                            <div class="iq-card-header d-flex justify-content-between color-template">
                                <div class="iq-header-title ">
                                    <h3 class="card-title text-white">Total Revenu Hier {{ hier }}</h3>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <h3 class="mb-4 display-5 font-weight-bolder text-center "></h3>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="iq-card">
                                            <div class="iq-card-body iq-bg-primary rounded-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rounded-circle iq-card-icon bg-primary"><i
                                                            class="ri-user-fill"></i></div>
                                                    <div class="text-end">
                                                        <h2 class="mb-0"><span class="counter">{{ countConsultationYesterday
                                                        }}</span></h2>
                                                        <h5 class="">Patient</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="iq-card">
                                            <div class="iq-card-body iq-bg-success rounded-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rounded-circle iq-card-icon bg-success"><i class="ri-exchange-dollar-line fa-2x"></i></div>
                                                    <div class="text-end">
                                                        <h2 class="mb-0"><span class="counter">{{ montantTotalYesterday + " DH" }}</span></h2>
                                                        <h5 class="">Revenu Total</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="iq-card">
                                            <div class="iq-card-body iq-bg-danger rounded-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rounded-circle iq-card-icon bg-danger"><i
                                                            class="ri-group-fill"></i></div>
                                                    <div class="text-end">
                                                        <h2 class="mb-0"><span class="counter">{{ montantTotalNonAssureYesterday + " DH"}}</span></h2>
                                                        <h5 class="">Non Mutualiste </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="iq-card">
                                            <div class="iq-card-body iq-bg-info rounded-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rounded-circle iq-card-icon bg-info"><i
                                                            class="ri-hospital-line"></i></div>
                                                    <div class="text-end">
                                                        <h2 class="mb-0"><span class="counter">{{
                                                            montantTotalAssureYesterday
                                                        }} DH</span></h2>
                                                        <h5 class="">Mutualiste </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>     
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <Link :href="route('statistique')" class="btn btn-primary  btn-block">Plus de
                                Statistiques</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="iq-card" style="background-color: #ffffff;">
                            <div class="iq-card-header d-flex justify-content-between color-template">
                                <div class="iq-header-title ">
                                    <h3 class="card-title text-white">Total Revenu Aujourdhui {{ aujourdhui }}</h3>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <h3 class="mb-4 display-5 font-weight-bolder text-center "></h3>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="iq-card">
                                            <div class="iq-card-body iq-bg-primary rounded-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rounded-circle iq-card-icon bg-primary"><i
                                                            class="ri-user-fill"></i></div>
                                                    <div class="text-end">
                                                        <h2 class="mb-0"><span class="counter">{{ countConsultationToday
                                                        }}</span></h2>
                                                        <h5 class="">Patient</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="iq-card">
                                            <div class="iq-card-body iq-bg-success rounded-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rounded-circle iq-card-icon bg-success"><i class="ri-exchange-dollar-line fa-2x"></i></div>
                                                    <div class="text-end">
                                                        <h2 class="mb-0"><span class="counter">{{ montantTotalToday + " DH" }}</span></h2>
                                                        <h5 class="">Revenu Total</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="iq-card">
                                            <div class="iq-card-body iq-bg-danger rounded-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rounded-circle iq-card-icon bg-danger"><i
                                                            class="ri-group-fill"></i></div>
                                                    <div class="text-end">
                                                        <h2 class="mb-0"><span class="counter">{{ montantTotalNonAssureToday + " DH"}}</span></h2>
                                                        <h5 class="">Non Mutualiste </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                              
                                    <div class="col-md-6 col-lg-6">
                                        <div class="iq-card">
                                            <div class="iq-card-body iq-bg-info rounded-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rounded-circle iq-card-icon bg-info"><i
                                                            class="ri-hospital-line"></i></div>
                                                    <div class="text-end">
                                                        <h2 class="mb-0"><span class="counter">{{
                                                            montantTotalAssureToday
                                                        }} DH</span></h2>
                                                        <h5 class="">Mutualiste </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <Link :href="route('statistique')" class="btn btn-primary  btn-block">Plus de
                                Statistiques</Link>
                                    </div>
                                </div>
                            </div>
                               
                            
                        </div>
                        
                    </div>
                    
                   
                    
                </div>
            </div>
            <div class="col-lg-3 h-full">
                <ListAtt :patientsAtt="patientsAtt" :docteurs="docteurs"></ListAtt>
            </div>
        </div>


    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ListAtt from "../Patients/ListAtt.vue";
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import HeaderStatistiquesDoctors from "../Statistiques/HeaderStat.vue";



const props = defineProps({
    patientsAtt: Object,
    docteurs: Object,

    countConsultationToday: Number,
    countConsultationYesterday: Number,

    montantTotalAssureToday: Number,
    montantTotalAssureYesterday: Number,

    montantTotalNonAssureToday: Number,
    montantTotalNonAssureYesterday: Number,

    montantTotalYesterday: Number,
    montantTotalToday: Number,

    operationsToday: Object,
    operationsYesterday: Object,

});


const aujourdhui = ref('');
const hier = ref('');

onMounted(() => {
    getDates();
});

function getDates() {
    const today = new Date();
    const yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);

    aujourdhui.value = today.toISOString().split('T')[0];
    hier.value = yesterday.toISOString().split('T')[0];
}
</script>
<style>
.vertical-divider {
    position: absolute;
    display: table;
    text-align: center;

    height: 180px;
    width: 100%;

    .center-element {
        position: relative;
        display: table-cell;
        vertical-align: middle;

        &:before,
        &:after {
            position: absolute;
            content: "";
            width: 1px;
            left: 50%;
            border-left: 1px solid black;
        }

        &:before {
            bottom: 50%;
            top: 0;
            margin-bottom: 20px;
        }

        &:after {
            top: 50%;
            bottom: 0;
            margin-top: 20px;
        }
    }
}

.underline-text {
    text-decoration: underline;
}
</style>
