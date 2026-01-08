<template>
    <div class="tab-pane fade show" id="pills-certificats-fill" role="tabpanel"
        aria-labelledby="pills-certificats-tab-fill">
        <div class="text-right">

            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="certificatDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ajouter Certificat
                </button>
                <div class="dropdown-menu" aria-labelledby="certificatDropdown">
                    <a class="dropdown-item" href="#" @click="selectCertificate('Consultation')">Certificat Consultation</a>
                    <a class="dropdown-item" href="#" @click="selectCertificate('Repos')">Certificat Repos</a>
                    <a class="dropdown-item" href="#" @click="selectCertificate('Grossesse')">Certificat Grossesse</a>
                    <a class="dropdown-item" href="#" @click="selectCertificate('Accompagnement')">Certificat
                        Accompagnement</a>
                </div>
            </div>

            <!-- end -->
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
                                        <th>Date </th>                                      
                                        <th>Certificat</th>                                       
                                        <th colspan="4">Opération</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="certificat in paginatedCertificats" v-bind:key="certificat.id">
                                        <td contenteditable="false">
                                            {{ certificat.id }}
                                        </td>
                                        <td contenteditable="false">
                                            {{ formatDate(certificat.dateCertificat) }}
                                        </td>
                                       
                                        <td contenteditable="false">
                                            {{ certificat.typeCertificat }}
                                        </td>                                     
                                        <td>
                                            <button type="button" @click="showCertificatModal(certificat)"
                                                data-toggle="modal" data-target=".bd-certificatview-modal-lg"
                                                class="btn btn-outline-success  mb-1 mt-3"><i
                                                    class="ri-eye-line"></i></button>
                                        </td>
                                        <td>
                                            <button @click="deleteCertificat(certificat)" type="button"
                                                class="btn btn-outline-danger  mb-1 mt-3"><i
                                                    class="ri-delete-bin-6-line"></i></button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                    <nav aria-label="Factures pagination" v-if="certificats.length > perPage">
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
                            <certificat-modal :age="age" :patient="patient" :docteur="docteur"
                                :certificat="selectedCertificat" @close="selectedCertificat = null" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script setup>
import { ref } from 'vue';
import CertificatModal from '../Certificats/ViewCertificat.vue';
import { useToast } from 'vue-toast-notification';
import Pagination from 'vue-pagination-2';


import { Link, router } from '@inertiajs/vue3';
const searchValue = ref("");
defineProps({
    certificats: Object,
    patient: Object,
    docteur: Object,
    age: Number
})

const formatDate = (timestamp)=> {
            return new Date(timestamp).toLocaleDateString("en-GB");
        }
// added code
const selectCertificate = (type) => {
  switch (type) {
    case 'Consultation':
      // Open Consultation modal
      openModal('#AddCertificatConsultation');
      break;
    case 'Repos':
      // Open Repos modal
      openModal('#AddCertificatRepos');
      break;
    case 'Grossesse':
      // Open Grossesse modal
      openModal('#AddCertificatGrossesse');
      break;
    case 'Accompagnement':
      // Open Accompagnement modal
      openModal('#AddCertificatAccompagnement');
      break;
    default:
      break;
  }
}

const openModal = (modalId) => {
  // Use JavaScript to open the specified modal
  const modal = document.querySelector(modalId);
  if (modal) {
    $(modal).modal('show'); // Using jQuery to trigger Bootstrap modal show
  }
}


</script>
<script>
export default {
    components: { CertificatModal },
    props: ["data", "errors"],
    data() {
        return {
            selectedCertificat: null,
            perPage: 5,
            currentPage: 1,
        };
    },
    computed: {
        paginatedCertificats() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.certificats.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.certificats.length / this.perPage);
        },
    },
    methods: {
        getAntecedents() {
            router.get("/certificats", data.certificats, {
                preserveState: true,
                preserveScroll: true,
            });
        },
        showCertificatModal(certificat) {
            this.selectedCertificat = certificat;
        },
        deleteCertificat(certificat) {
            router.delete(`/certificats/${certificat.id}`, {
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
        printInvoice() {
            const printContents = document.getElementById('printable-content').innerHTML;
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
            #printable-content{
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
    margin-bottom: 20px;
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

<style scoped>
@media print {
    @page {
        size: A4; /* ou A5 ou toute autre taille de page supportée */
        /* Autres propriétés si nécessaire */
    }
}
</style>