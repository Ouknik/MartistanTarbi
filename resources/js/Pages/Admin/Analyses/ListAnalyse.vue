<template>
    <div class="tab-pane fade" id="pills-analyses-fill" role="tabpanel" aria-labelledby="pills-analyses-tab-fill">
        <div class="text-right">
            <!-- <button type="button" class="btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                data-toggle="modal" data-target=".bd-AddAnalyses-modal-xl" style="font-size: 15px;"><i
                    class="ri-add-fill"></i> Ajouter Analyses </button> -->

            <button type="button" class="btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                @click="parentModalVisible = true">Ajouter Analyses</button>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">

                    <div class="iq-card-body">
                        <div id="table" class="table-editable">
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Détails Analyse</th>
                                            <th>Aperçu & Impression</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="consultation in paginatedConsultations" v-bind:key="consultation.id">
                                            <td>
                                                {{ consultation.dateConsultation }}
                                            </td>
                                            <td>
                                                <ul v-for="analyse in consultation.analyse" v-bind:key="analyse.id">
                                                    <li class="text-dark text-left" style="margin-top: -10px;"> {{
                                                        analyse.nomAnalyse }}</li>
                                                    <ul v-for="Sousanalyse in consultation.sous_analyses"
                                                        v-bind:key="Sousanalyse.id">
                                                        <span v-if="analyse.id == Sousanalyse.analyse_id">
                                                            <li class="text-danger  text-left "> {{
                                                                Sousanalyse.nomSousAnalyse
                                                            }}</li>
                                                        </span>
                                                    </ul>
                                                </ul>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    <nav aria-label="Factures pagination" v-if="consultations.length > perPage">
                                        <ul class="pagination">
                                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                                <button class="page-link" @click="currentPage = 1"
                                                    :disabled="currentPage === 1" aria-label="First">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">First</span>
                                                </button>
                                            </li>
                                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                                <button class="page-link" @click="currentPage -= 1"
                                                    :disabled="currentPage === 1" aria-label="Previous">
                                                    <span aria-hidden="true">&lsaquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </button>
                                            </li>
                                            <li class="page-item" v-for="page in totalPages" :key="page"
                                                :class="{ 'active': currentPage === page }">
                                                <button class="page-link" @click="currentPage = page"
                                                    :disabled="currentPage === page">{{ page }}</button>
                                            </li>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <button class="page-link" @click="currentPage += 1"
                                                    :disabled="currentPage === totalPages" aria-label="Next">
                                                    <span aria-hidden="true">&rsaquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </button>
                                            </li>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <button class="page-link" @click="currentPage = totalPages"
                                                    :disabled="currentPage === totalPages" aria-label="Last">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Last</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <button type="button" class="btn btn-primary" @click="parentModalVisible = true">Extra large
        modal</button> -->
    <MyModal :show="parentModalVisible" maxWidth="modal-xl"  @close="parentModalVisible = false">
        <template #title>
            <h5 class="text-white modal-title">
                Spécifier les Analyses Pour <span>
                {{ patient.sexePatient === 'Masculin' ? 'Mr' : 'Mme' }}
                </span>:
                {{ patient.nomPatient + " " + patient.prenomPatient }}
            </h5>
        </template>
        <!-- <button type="button" class="btn btn-primary" @click="childModalVisible = true">Imprimer Analyse</button> -->
        <AddAnalyses :familleanalyses="familleanalyses" :sousAnalyses="sousAnalyses" :patient="patient">
        </AddAnalyses>

    </MyModal>
    <!-- <MyModal :show="childModalVisible" maxWidth="modal-xl"  @close="childModalVisible = false">

        
    </MyModal> -->
</template>

<script setup>
import MyModal from "@/Components/ModalC.vue";

import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import FactureModal from '../Factures/ViewFacture.vue';
import Pagination from 'vue-pagination-2';
import AddAnalyses from './AddAnalyses.vue';
import printAnalyses from "./OrdonnanceAnalyses.vue";
const parentModalVisible = ref(false);
const childModalVisible = ref(false);

defineProps({
    consultations: Object,
    patient: Object,
    familleanalyses: Object,
    sousAnalyses: Object
})


</script>
<script>
export default {
    components: { FactureModal, Pagination },
    props: ["data", "errors"],
    data() {
        return {
            selectedFacture: null,
            perPage: 10,
            currentPage: 1,

        };
    },
    computed: {
        
        paginatedConsultations() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.consultations.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.consultations.length / this.perPage);
        },
    },
    methods: {
        changePage(page) {
            this.currentPage = page;
        },

    },
};
</script>
