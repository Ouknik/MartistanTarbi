<template>
    <div class="tab-pane fade" id="pills-ordonnances-fill" role="tabpanel" aria-labelledby="pills-ordonnances-tab-fill">
        <div class="text-right"><button type="button" class="btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                data-toggle="modal" data-target=".bd-Addconsultations-modal-xl" style="font-size: 15px;"><i
                    class="ri-add-fill"></i> Ajouter Ordonnances </button></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">

                    <div class="iq-card-body">
                        fac
                        <div id="table" class="table-editable">
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Nombre Médicaments</th>
                                        <th>Aperçu</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="ordonnance in ordonnances" v-bind:key="ordonnance.id">

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

                                                        {{ medicament.pivot.NombreComprime + " CP x " +
                                                            medicament.pivot.quantiteParJour + " Jour " +
                                                            medicament.pivot.momentDePrise + " Pendant " +
                                                            medicament.pivot.dureeNombre + " " +
                                                            medicament.pivot.duree
                                                        }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" @click="showOrdonnanceModal(ordonnance)"
                                                data-toggle="modal" data-target=".bd-Ordonnanceview-modal-xl"
                                                class="btn btn-outline-success  mb-1 mt-3"><i
                                                    class="ri-eye-line"></i></button>
                                        </td>
                                        <td>
                                            <button type="button" @click="showEditOrdonnanceModal(ordonnance)"
                                                data-toggle="modal" data-target=".bd-OrdonnanceEdit-modal-xl"
                                                class="btn btn-outline-success  mb-1 mt-3"><i class="ri-edit-2-fill"></i>
                                            </button>
                                        </td>
                                        <!-- <td>
                                            <button @click="printInvoice(ordonnance)" type="button"
                                                class="btn btn-outline-primary  mb-1 mt-3"><i
                                                    class="ri-printer-line"></i></button>

                                        </td> -->
                                        <td>
                                            <button @click="deleteOrdonnance(ordonnance)" type="button"
                                                class="btn btn-outline-danger  mb-1 mt-3"><i
                                                    class="ri-delete-bin-6-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr v-for="facture in factures" v-bind:key="facture.id">
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
                                        <td>
                                            <button type="button" @click="showFactureModal(facture)" data-toggle="modal"
                                                data-target=".bd-Factureview-modal-xl"
                                                class="btn btn-outline-success  mb-1 mt-3"><i
                                                    class="ri-eye-line"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ordonnance-modal :patient="patient" :ordonnance="selectedOrdonnance"
                                @close="selectedOrdonnance = null" />
                            <edit-ordonnance :ordonnance="selectedOrdonnanceToEdit" @close="selectedOrdonnanceToEdit = null"
                                :medicaments="medicaments" />

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
import OrdonnanceModal from '../Ordonnances/ViewOrdonnance.vue';
import EditOrdonnance from '../Ordonnances/EditOdonnance.vue';


const searchValue = ref("");
defineProps({
    ordonnances: Object,
    patient: Object,
    medicaments: Object,
    factures: Object
})


</script>
<script>
export default {

    components: { OrdonnanceModal, EditOrdonnance },
    props: ["data", "errors"],
    data() {
        return {
            selectedOrdonnance: null,
            selectedOrdonnanceToEdit: null,

        };
    },
    methods: {
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
                    useToast().success("Bien Supprimer", {
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
