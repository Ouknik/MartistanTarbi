<template>
    <div class="tab-pane fade show" id="pills-ordonnances-fill" role="tabpanel"
        aria-labelledby="pills-ordonnances-tab-fill">
        <div class="text-right">
            <div class="dropdown">
                <button class="btn btn-outline-primary " type="button" id="dropdownMenuButton" data-toggle="modal"
                    data-target="#AddOrdonnance" aria-haspopup="true" aria-expanded="false">
                    Ajouter Ordonnance
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div id="table" class="table-editable">
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Date</th>
                                        <th>Nombre Médicaments</th>
                                        <th>Aperçu</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="ordonnance in paginatedOrdonnances" v-bind:key="ordonnance.id">
                                        <td>
                                            {{ ordonnance.id }}
                                        </td>
                                        <td contenteditable="false">
                                            {{ ordonnance.dateOrdonnance }}
                                        </td>
                                        <td contenteditable="false">
                                            <div v-for="medicament in ordonnance.medicaments" :key="medicament.id">
                                                <h6 class="text-left font-weight-bold"> {{ medicament.nomMedicament + " " +
                                                    medicament.dosageMedicament + " " + medicament.uniteDosageMedicament }}
                                                </h6>
                                                <ul>
                                                    <li style="text-align: left;">
                                                        {{ medicament.pivot.prescription
                                                        }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" @click="showOrdonnanceModal(ordonnance)"
                                                data-toggle="modal" data-target=".bd-Ordonnanceview-modal-lg"
                                                class="btn btn-outline-success  mb-1 mt-3"><i
                                                    class="ri-eye-line"></i></button>
                                        </td>
                                        <td>
                                            <button type="button" @click="showEditOrdonnanceModal(ordonnance)"
                                                data-toggle="modal" data-target=".bd-OrdonnanceEdit-modal-lg"
                                                class="btn btn-outline-success  mb-1 mt-3"><i class="ri-edit-2-fill"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteOrdonnance(ordonnance)" type="button"
                                                class="btn btn-outline-danger  mb-1 mt-3"><i
                                                    class="ri-delete-bin-6-line"></i></button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                <nav aria-label="Factures pagination" v-if="ordonnances.length > perPage">
                                    <ul class="pagination">
                                        <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                            <button class="page-link" @click="currentPage = 1" :disabled="currentPage === 1"
                                                aria-label="First">
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
                            <ordonnance-modal :patient="patient" :ordonnance="selectedOrdonnance"
                                @close="selectedOrdonnance = null" />
                            <edit-ordonnance :ordonnance="selectedOrdonnanceToEdit" :medicaments="medicaments" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <CreateOrdonnance :patient="patient.id" :medicaments="medicaments" :idConsultation="idConsultation"></CreateOrdonnance>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import OrdonnanceModal from '../Ordonnances/ViewOrdonnance.vue';
import EditOrdonnance from '../Ordonnances/EditOdonnance.vue';
import Pagination from 'vue-pagination-2';
import { useToast } from 'vue-toast-notification';
import CreateOrdonnance from "./CreateOrdonnances.vue";

const searchValue = ref("");
defineProps({
    ordonnances: Object,
    patient: Object,
    medicaments: Object,
    factures: Object,
    idConsultation: Number
})


</script>
<script>
export default {

    components: { OrdonnanceModal, EditOrdonnance, Pagination },
    props: ["data", "errors"],
    data() {
        return {
            selectedOrdonnance: null,
            selectedOrdonnanceToEdit: null,
            perPage: 10,
            currentPage: 1,
        };
    },
    computed: {
        paginatedOrdonnances() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.ordonnances.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.ordonnances.length / this.perPage);
        },
    },
    methods: {
        changePage(page) {
            this.currentPage = page;
        },
        getDocuments() {
            router.get("/ordonnances", data.ordonnances, {
                preserveState: true,
                preserveScroll: true,
            });
        },
        showOrdonnanceModal(ordonnance) {
            this.selectedOrdonnance = ordonnance;
        },
        showEditOrdonnanceModal(ordonnance) {
            this.selectedOrdonnanceToEdit = ordonnance;
        },

        deleteOrdonnance(ordonnance) {
            router.delete(`/ordonnances/${ordonnance.id}`, {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    useToast().info("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
            });
        },
        printInvoice(ordonnance) {
            this.selectedOrdonnance = ordonnance;
            const printContents = document.getElementById('printable-contentOrdonnance').innerHTML;
            const iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            document.body.appendChild(iframe);
            const iframeDoc = iframe.contentWindow.document;
            iframeDoc.open();
            // Add the CSS styles in the iframe document's head
            iframeDoc.write(`
        <!DOCTYPE html>
        <html>
          <head>
            <style>
            @page {
                size: 210mm 297mm;
      }
            #printable-contentFacture{
    padding:15px;


}
body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    // width: 148mm; /* Largeur A5 en mm */
                    // height: 210mm; /* Hauteur A5 en mm */
                    margin: 0;
                    background-color:red;
                }


.header {
    margin-top:31%;
    margin-left:5%;
    margin-bottom:10%;
    font-size:15px;
}

.header h1 {
    font-size: 28px;

}


.invoice-details {
    line-height : 2;
    padding-left:20px;
    padding-right:20px;
}
#footer-facture{
    font-size:18px;
}
.invoice-details p {

}

            </style>
          </head>
          <body>${printContents}</body>
        </html>
      `);
            iframeDoc.close();
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
            document.body.removeChild(iframe);
        },
    },
};
</script>
