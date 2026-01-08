<template>
    <AdminLayout>
        <div class="row">
            <div class="col-lg-12 ">
                <ul class="iq-edit-profile p-0 nav">
                    <li class="col-lg-3">
                        <a class="nav-link p-0 linkcss" data-toggle="pill" href="#prochaine-operations">
                            <div class="iq-card-block iq-card-height py-0 nav-pills">
                                <div class="iq-card-body iq-bg-primary rounded">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <i  class="ri-group-fill" style="font-size: 20px;"></i>
                                        <div class="text-left">
                                            <h4>Opérations</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="col-lg-3">
                        <a class="nav-link p-0 linkcss" data-toggle="pill" href="#reglement">
                            <div class="iq-card iq-card-block iq-card-height py-0 nav-pills">
                                <div class="iq-card-body iq-bg-info rounded">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <i class="ri-user-add-fill" style="font-size: 20px;"></i>
                                        <div class="text-left">
                                            <h4 >Reglement Opération</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="col-lg-3">
                        <a class="nav-link active p-0 linkcss" data-toggle="pill" href="#calendrier">
                            <div class="iq-card iq-card-block py-0 iq-card-height nav-pills">
                                <div class="iq-card-body iq-bg-warning rounded">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <i class="ri-calendar-todo-line" style="font-size: 20px;"></i>
                                        <div class="text-left">
                                            <h4 >Calendrier Opération</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="col-lg-3">
                        <a class="nav-link p-0 linkcss" data-toggle="pill" href="#statistiques">
                            <div class="iq-card iq-card-block py-0 iq-card-height nav-pills">
                                <div class="iq-card-body iq-bg-success rounded">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <i class="ri-bar-chart-fill" style="font-size: 20px;"></i>
                                        <div class="text-left">
                                            <h4>Statistique Opération</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-lg-12">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade" id="prochaine-operations" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between"
                                    style="background-color: #ceebee ;">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Opérations</h4>
                                    </div>
                                </div>
                                <ListProchaineOperation :items="operations" :cliniques="cliniques"
                                     ></ListProchaineOperation>

                            </div>
                        </div>
                        
                        <div class="tab-pane fade active show" id="calendrier" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between"
                                    style="background-color: #fae9dd">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Calendrier</h4>
                                    </div>
                                </div>
                                <CalendrierOperation :operationsPatient="operations"></CalendrierOperation>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="statistiques" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between"
                                    style="background-color: #e5fae5">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Statistiques Des Opérations</h4>
                                    </div>
                                </div>
                                <Statistiques :items="cliniques"></Statistiques>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="reglement" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between"
                                    style="background-color: #e5faff">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Réglement Des Opérations</h4>
                                    </div>
                                </div>
                               <ReglementOperations :items="cliniques"></ReglementOperations>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <CreateDocument :patient="patient"></CreateDocument> -->
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ListProchaineOperation from "./ProchaineOperation.vue";
import CalendrierOperation from "./CalendrierOperation.vue";
import Statistiques from "./StatistiquesOperation.vue";
import ReglementOperations from "./ReglementOperations.vue";



//var listAtt = ref(props.patientsAtt);
const props = defineProps({
    // patients: Object,
    operations: Object,
    cliniques: Object,
    // operations: Object,
    operationsPatient: Object,
});
</script>

<style scoped>
.small-text {
    font-size: 15px;
    /* Remplacez cette valeur par la taille de police souhaitée */
}
</style>
