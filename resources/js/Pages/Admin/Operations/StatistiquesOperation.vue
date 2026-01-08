<template>
    <div class="row">
        <div class="col-lg-6 p-4">
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="3" alternating table-class-name="customize-table">
                <template #empty-message>
                    <a href="">Aucun patient avec les données saisies</a>
                </template>
                <template #item-TotalClinique="item">
                    {{ item.TotalClinique }} DH
                </template>
                <template #item-ReglementClinique="item">


                    {{ item.TotalReglement }} DH

                </template>
                <template #item-Reste="item">

                    <div v-if="item.TotalClinique - item.TotalReglement === 0">
                        <a class="iq-icons-list text-success mt-2" href="#">
                            <div data-icon="S" class="icon"></div>
                        </a>
                    </div>
                    <div v-else>
                        <a class="iq-icons-list text-warning mt-3" href="#">
                            <div data-icon="I" class="icon"></div>
                        </a>
                        {{ item.TotalClinique - item.TotalReglement }} DH
                    </div>
                </template>
                <!-- <template #item-print="item">
                    <button class="btn btn-success m-2" @click="showClinicOperations(item)">
                        <i class="ri-download-cloud-fill"></i>
                    </button>
                    <button class="btn btn-danger m-2" v-if="selectedClinic === clinic" @click="generatePDF(clinic)">
                        Imprimer PDF
                    </button>
                </template> -->
            </EasyDataTable>
        </div>

        <div class="col-lg-6">

            <div class="iq-card">

                <div class="iq-card-body">
                    <label for="monthInput" class="font-weight-bold">Filtrer par Mois</label>
                    <input type="month" class="form-control" id="dateInput" v-model="selectedDate"
                        @input="filterOperations">
                    <ul class="iq-timeline p-0 mt-2">
                        <li v-for="clinic in filteredOperations" :key="clinic.id">
                            <h4 class="float-left mb-2 text-dark"><i class="ri-hospital-line bg-primary"></i> Clinique {{
                                clinic.nomClinique }}</h4>
                            <small class="float-right mt-1">Validée</small>
                            <div class="d-inline-block w-100">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom du Patient</th>
                                            <th>Opération</th>
                                            <th>Date de l'Opération</th>
                                            <th>Prix de l'Opération</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="operation in clinic.operations" :key="operation.id">
                                            <td>{{ operation.patient.nomPatient }} {{ operation.patient.prenomPatient }}
                                            </td>
                                            <td>{{ operation.nomOperation }}</td>
                                            <td>{{ operation.dateOperation }}</td>
                                            <td>{{ operation.prixOperation }} DH</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { ref, computed } from "vue";
// import jsPDF from 'jspdf';
// import html2pdf from 'html2pdf.js';
// import html2canvas from 'html2canvas';

const searchValue = ref("");
const searchField = ref(["nomPatient", "prenomPatient", "cinPatient"]);
const selectedDate = ref("");
const selectedClinic = ref(null);

const props = defineProps({
    items: Object,
});

const headers = [
    { text: "Clinique", value: "nomClinique", sortable: true },
    { text: "Ville", value: "villeClinique", sortable: true },
    { text: "Opérations", value: "TotalOperations", sortable: true },
    { text: "Revenu", value: "TotalClinique", sortable: true },
    { text: "Reglement", value: "ReglementClinique", sortable: true },
    { text: "Reste", value: "Reste", sortable: true },

    // { text: "Rapport", value: "print", sortable: true },
];
const filteredOperations = computed(() => {
    if (!selectedDate.value) {
        return [];
    }

    return props.items.map((clinic) => ({
        ...clinic,
        operations: clinic.operations.filter((operation) => {
            const operationDate = operation.dateOperation.substring(0, 7);
            return operationDate === selectedDate.value;
        }),
    }));
});

// const showClinicOperations = (clinic) => {
//     selectedClinic.value = clinic.id;
// }

// const printTable = (clinicId) => {
//     const clinic = filteredOperations.value.find((c) => c.id === clinicId);
//     if (clinic) {
//         const table = document.getElementById('table');
//         const scale = 2;
//         const pdf = new jsPDF('p', 'mm', 'a4');
//         let yOffset = 20;
//         let pageHeight = pdf.internal.pageSize.getHeight();
//         const addNewPageIfNeeded = () => {
//             if (yOffset + pageHeight > pdf.internal.pageSize.getHeight()) {
//                 pdf.addPage();
//                 yOffset = 20;
//                 pdf.setFontSize(16);
//                 pdf.text('CLINIQUE ' + clinic.nomClinique, pdf.internal.pageSize.getWidth() / 2, 10, { align: 'center' });
//             }
//         };
//         html2canvas(table, { scale: scale }).then((canvas) => {
//             const image = canvas.toDataURL('image/jpeg', 1.0);
//             const numOperations = clinic.operations.length;
//             for (let i = 0; i < numOperations; i++) {
//                 addNewPageIfNeeded();
//                 pdf.addImage(image, 'JPEG', 10, yOffset, 190, 0);
//                 yOffset += canvas.height * scale + 10;
//             }
//             pdf.save('rapport_operations.pdf');
//         });
//     }
// };

</script>
  
<style scoped>
.iq-timeline {
    max-height: 300px;
    overflow-y: auto;
}

thead tr th {
    font-size: 12px;
}
</style>

 <!-- <div class="col-lg-4">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Recent Activity</h4>
                    </div>
                    
                </div>
                <div class="iq-card-body">
                    <ul class="iq-timeline p-3">
                        <li>
                            <div class="timeline-dots-fill"></div>
                            <h6 class="float-left mb-2 text-dark"><i class="ri-user-fill"></i> 5 min ago</h6>
                            <small class="float-right mt-1">Active</small>
                            <div class="d-inline-block w-100">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque </p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots-fill bg-success"></div>
                            <h6 class="float-left mb-2 text-dark"><i class="ri-user-fill"></i> 6 min ago</h6>
                            <small class="float-right mt-1">Away</small>
                            <div class="d-inline-block w-100">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque</p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots-fill bg-info"></div>
                            <h6 class="float-left mb-2 text-dark"><i class="ri-user-fill"></i> 10 min ago</h6>
                            <small class="float-right mt-1">Active</small>
                            <div class="d-inline-block w-100">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque</p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots-fill bg-warning"></div>
                            <h6 class="float-left mb-2 text-dark"><i class="ri-user-fill"></i> 15 min ago</h6>
                            <small class="float-right mt-1">Offline</small>
                            <div class="d-inline-block w-100">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque</p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots-fill bg-danger"></div>
                            <h6 class="float-left mb-2 text-dark"><i class="ri-user-fill"></i> 18 min ago</h6>
                            <small class="float-right mt-1">Away</small>
                            <div class="d-inline-block w-100">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque</p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots-fill bg-danger"></div>
                            <h6 class="float-left mb-2 text-dark"><i class="ri-user-fill"></i> 18 min ago</h6>
                            <small class="float-right mt-1">Away</small>
                            <div class="d-inline-block w-100">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque</p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots-fill bg-danger"></div>
                            <h6 class="float-left mb-2 text-dark"><i class="ri-user-fill"></i> 18 min ago</h6>
                            <small class="float-right mt-1">Away</small>
                            <div class="d-inline-block w-100">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->