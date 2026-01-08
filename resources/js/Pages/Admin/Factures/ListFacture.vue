<template>
    <div class="tab-pane fade show active" id="pills-factures-fill" role="tabpanel"
        aria-labelledby="pills-factures-tab-fill">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">

                    <div class="iq-card-body">
                        <div id="table" class="table-editable">
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Date</th>
                                            <th>Détails Soin</th>
                                            <th>Montant Total</th>
                                            <th>Modifier</th>
                                            <th>Aperçu & Impression</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="facture in paginatedFactures" v-bind:key="facture.id" >
                                       
                                        <tr v-if="facture.soins != null">
                                            <td contenteditable="false">
                                                {{ facture.id }}
                                            </td>
                                            <td contenteditable="false">
                                                {{ facture.dateFacture }}
                                            </td>
                                            <td>
                                                <ol class="mt-3">
                                                    <li v-for="soin in JSON.parse(facture.soins)"
                                                        style="list-style: square; text-align: left;">
                                                        {{ soin.libelleSoin }} -
                                                        {{ soin.montantSoin }} DH
                                                    </li>
                                                </ol>
                                            </td>
                                            <td contenteditable="false">
                                                {{ facture.montantFacture }}
                                            </td>
                                            <td v-if="$page.props.user.type == 'docteur'">
                                                <button type="button" @click="showFactureModal(facture)" data-toggle="modal"
                                                    data-target=".bd-EditFacture-modal-lg"
                                                    class="btn btn-outline-success  mb-1 mt-3"><i
                                                        class="ri-edit-line"></i></button>
                                            </td>
                                            <td v-else>
                                                <i style="font-size: 30px;" class="ri-close-line text-danger"></i>
                                            </td>
                                            <td>
                                                <button type="button" @click="showFactureModal(facture)" data-toggle="modal"
                                                    data-target=".bd-Factureview-modal-lg"
                                                    class="btn btn-outline-primary  mb-1 mt-3"><i
                                                        class="ri-eye-line"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    <nav aria-label="Factures pagination" v-if="factures.length > perPage">
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
                            <facture-modal :patient="patient" :facture="selectedFacture" @close="selectedFacture = null" />
                            <EditFacture :patient="patient" :facture="selectedFacture" :soins="soinsF"></EditFacture>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Pagination from 'vue-pagination-2';
import FactureModal from '../Factures/ViewFacture.vue';
import EditFacture from "../Factures/EditFacture.vue";
const props = defineProps({
    factures: Object,
    patient: Object,
    configuration: Object,
    soinsF: Object
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
        soins() {
            return JSON.parse(this.factures[0].soins);
        },
        paginatedFactures() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.factures.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.factures.length / this.perPage);
        },
    },
    methods: {
        changePage(page) {
            this.currentPage = page;
        },
        getFactures() {
            router.get("/Factures", data.factures, {
                preserveState: true,
                preserveScroll: true,
            });
        },
        showFactureModal(facture) {
            this.selectedFacture = facture;
        },
        deleteFacture(facture) {
            router.delete(`/factures/${facture.id}`, {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
            });
        },
    },
};
</script>
