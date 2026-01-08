<template>
    <AdminLayout>
        <div class="row">
            <div class="col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch">
                    <div class="iq-card-header d-flex justify-content-between color-template">
                        <div class="iq-header-title">
                            <h4 class="card-title text-white">Cabinet / Bloc Operatoire</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="report-lists m-0 p-0">
                            <div class="form-group">
                                <div class="d-flex gap-2 flex-wrap">
                                    <div
                                        class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                                        <input type="radio" id="customRadio-Cabinet" name="customRadio-10"
                                            class="custom-control-input bg-primary me-1" v-model="choix" checked
                                            value="Cabinet">
                                        <label style="font-size: 15px;" class="custom-control-label font-weight-bold"
                                            for="customRadio-Cabinet">Cabinet</label>
                                    </div>
                                    <div
                                        class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                                        <input type="radio" id="customRadio-BlocOperatioire" name="customRadio-10"
                                            class="custom-control-input bg-secondary me-1" v-model="choix"
                                            value="Bloc Operatoire">
                                        <label style="font-size: 15px;" class="custom-control-label font-weight-bold"
                                            for="customRadio-BlocOperatioire">Bloc Operatoire</label>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="iq-card iq-card-block iq-card-stretch ">
                    <div class="iq-card-header d-flex justify-content-between color-template">
                        <div class="iq-header-title">
                            <h4 class="card-title text-white">Filtrage</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="report-lists m-0 p-0">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="font-weight-bold">Selectionner un
                                    Docteur</label>
                                <select class="form-control" v-model="selectedDoctor">
                                    <option v-for="docteur in docteurs" :key="docteur.id" :value="docteur">
                                        {{ docteur.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dateInput" class="font-weight-bold">DU </label>
                                <input type="date" class="form-control" id="dateInput" v-model="dateDebut">
                            </div>
                            <div class="form-group">
                                <label for="monthInput" class="font-weight-bold">AU</label>
                                <input type="date" class="form-control" id="monthInput" v-model="dateFin">
                            </div>
                            <div class="form-group" v-if="choix === 'Bloc Operatoire'">
                                <label for="yearInput" class="font-weight-bold">Type Operation </label>
                                <select class="form-control" v-model="typeAOperationSelected">
                                    <option selected value="Tous">Tous</option>
                                    <option v-for="typeOperation in typeOperations" :key="typeOperation.id"
                                        :value="typeOperation.typeOperation">
                                        {{ typeOperation.typeOperation }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group" v-if="choix === 'Bloc Operatoire'">
                                <label for="yearInput" class="font-weight-bold">Cliniques </label>
                                <select class="form-control" v-model="cliniqueSelected">
                                    <option selected value="Tous">Tous</option>
                                    <option v-for="clinique in cliniques" :key="clinique.id" :value="clinique.id">
                                        {{ clinique.nomClinique }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="yearInput" class="font-weight-bold">Type Assurance </label>
                                <select class="form-control" v-model="typeAssuranceSelected">
                                    <option selected value="Tous">Tous</option>
                                    <option v-for="assurance in assurances" :key="assurance.id"
                                        :value="assurance.typeAssurance">
                                        {{ assurance.typeAssurance }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button type="button" @click="loadPage()" class="btn mb-3 btn-primary"><i
                                        class="ri-bill-fill"></i>Filtrer</button>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between color-template">
                        <div class="iq-header-title">
                            <h4 class="card-title text-white">Détails Rapport </h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                    <i class="ri-more-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Filter Cabinet -->
                    <div class="iq-card-body text-center" id="TableSelectedDateDay"
                        v-if="choix == 'Cabinet' && choixRequet == 'Cabinet'">
                        <img :src="$page.props.user.profile_photo_path" width="100" height="80" />
                        <h6 class="text-center mb-2">Rapport Caisse : DU <strong>{{ dateDebut }} </strong> AU <strong>{{
                            dateFin }}</strong>
                        </h6>
                        <h6 class="text-center mb-2">Docteur : <strong v-if="selectedDoctor">{{ selectedDoctor.name
                        }}</strong> <label class="font-weight-bold">
                            </label></h6>
                        <table class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Date </th>
                                    <th>Nom Prénom</th>
                                    <th>Mutuelle</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="reglement in caisse" :key="reglement.id">
                                    <td>{{ reglement.dateReglement }}</td>
                                    <td>{{ reglement.patient.nomPatient }} {{ reglement.patient.prenomPatient }}</td>
                                    <td>{{ reglement.typeAssurance }}</td>
                                    <td>{{ reglement.montantReglement }} DH</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="font-weight-bold">
                                    <td colspan="3">Total</td>
                                    <td class="f16"> {{ montantTotal }} DH</td>
                                </tr>
                            </tfoot>
                        </table>
                        <h1 class="mb-3"><a @click="generatePDF" v-if="choixRequet == 'Cabinet'"
                                class="dropdown-item text-center mb-2" style="font-size: 25px;" href="#"><i
                                    class="ri-file-download-fill mr-2 text-danger"></i>Telecharger PDF</a>
                        </h1>
                        
                    </div>
                    <!-- Filter Bloc -->
                    <div v-if="choixRequet == 'Bloc Operatoire' && choix == 'Bloc Operatoire'"
                        class="iq-card-body text-center" id="TableSelectedDateDay">
                        <img :src="$page.props.user.profile_photo_path" width="100" height="80" />
                        <h6 class="text-center mb-2">Rapport Cabinet : DU <strong>{{ dateDebut }} </strong> AU <strong>{{
                            dateFin }}</strong>
                        </h6>
                        <h6 class="text-center mb-2">Docteur : <strong v-if="selectedDoctor">{{ selectedDoctor.name
                        }}</strong> <label class="font-weight-bold">
                            </label></h6>
                        <table class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Date </th>
                                    <th>Nom Prénom</th>
                                    <th>Operation</th>
                                    <th>Assurance</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="reglement in caisse" :key="reglement.id">
                                    <td>{{ reglement.dateOperation }}</td>
                                    <td>{{ reglement.patient.nomPatient }} {{ reglement.patient.prenomPatient }}</td>
                                    <td>{{ reglement.nomOperation }}</td>
                                    <td>{{ reglement.typeAssurance }}</td>
                                    <td>{{ reglement.prixOperation }} DH</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="font-weight-bold">
                                    <td colspan="4">Total</td>
                                    <td class="f16"> {{ montantTotalBloc }} DH</td>
                                </tr>
                            </tfoot>
                        </table>
                        <h1 class="mb-3"><a @click="generatePDFbloc" v-if="choixRequet == 'Bloc Operatoire'" class="dropdown-item text-center mb-2"
                                style="font-size: 25px;" href="#"><i
                                    class="ri-file-download-fill mr-2 text-danger"></i>Telecharger PDF</a>
                        </h1>
                    </div>

                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import { ref, computed, watch, onMounted } from 'vue';
import { jsPDF } from "jspdf";
import "jspdf-autotable";
// import html2canvas from 'html2canvas';
import { Link, router, useForm } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';

const props = defineProps({
    docteurs: Object,
    caisse: Object,
    assurances: Object,
    typeOperations: Object,
    cliniques: Object,
    choixRequet: String
});
const selectedDoctor = ref(null);
const dateDebut = ref(null);
const dateFin = ref(null);
const typeAssuranceSelected = ref('Tous');
const typeAOperationSelected = ref('Tous');
const cliniqueSelected = ref('Tous')
const choix = ref('Cabinet');

const areDatesSelected = () => {
    return dateDebut.value && dateFin.value;
};


const loadPage = async () => {
    if (!areDatesSelected()) {
        useToast().error('Date Debut et Date Fin sont Obligatoire !!', { position: 'bottom-right', duration: 3000 });
        return;
    }

    try {
        const baseUrl = 'caisse';
        const queryParams = new URLSearchParams({
            choix: choix.value,
            docteur: selectedDoctor.value.id,
            dateDebut: dateDebut.value,
            dateFin: dateFin.value,
            assurance: typeAssuranceSelected.value
        });

        if (choix.value !== 'Cabinet') {
            queryParams.append('typeOperation', typeAOperationSelected.value);
            queryParams.append('clinique', cliniqueSelected.value);
        }

        const url = `${baseUrl}?${queryParams.toString()}`;

        router.visit(url, {
            method: "get",
            preserveScroll: true,
            preserveState: true
        });
    } catch (error) {
        console.error("Erreur lors du chargement de la page :", error);
    }
};


const montantTotal = computed(() => {
    return props.caisse.reduce((total, reglement) => {
        return total + reglement.montantReglement;
    }, 0);
});

const montantTotalBloc = computed(() => {
    return props.caisse.reduce((total, reglement) => {
        return total + reglement.prixOperation;
    }, 0);
});

onMounted(() => {
    if (props.docteurs && props.docteurs.length > 0) {
        selectedDoctor.value = props.docteurs[0];
    }
});

const generatePDF = () => {
    if (!areDatesSelected()) {
        useToast().error('Date Debut et Date FIn sont Obligatoire !!', { position: 'bottom-right', duration: 3000 });
        return;
    }
    const doc = new jsPDF({
        orientation: "portrait",
        unit: "mm",
        format: "a4",
    });

    const pageWidth = doc.internal.pageSize.getWidth();
    const center = pageWidth / 2;

    const headers = [['Date', 'Nom Prénom', 'Mutuelle', 'Montant']];

    const data = props.caisse.map(reglement => [
        reglement.dateReglement,
        `${reglement.patient.nomPatient} ${reglement.patient.prenomPatient}`,
        reglement.typeAssurance,
        `${reglement.montantReglement} DH`
    ]);

    data.push([
        { content: 'Total', colSpan: 3, styles: { halign: 'right', fontStyle: 'bold' } },
        { content: `${montantTotal.value} DH`, styles: { fontStyle: 'bold' } } // Mettre le montant en gras
    ]);

    const itemsPerPage = 25; // Nombre d'enregistrements par page
    let totalPages = Math.ceil(data.length / itemsPerPage);

    for (let page = 1; page <= totalPages; page++) {
        if (page > 1) {
            doc.addPage();
        }
        // Sélection des données pour la page actuelle
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = page * itemsPerPage;
        const pageData = data.slice(startIndex, endIndex);

        let currentYPosition = 20; // Position Y initiale pour le premier texte
        if (selectedDoctor.value && selectedDoctor.value.name) {
            doc.text(`Docteur : ${selectedDoctor.value.name}`, center, currentYPosition, { align: 'center' });
            currentYPosition += 10; // Incrémenter la position Y pour le prochain texte
        }
        // Ajout des dates du rapport
        let dateLineY = selectedDoctor.value && selectedDoctor.value.name ? 30 : 25; // Ajuster la position Y en fonction de la présence du nom du docteur
        // Ajout des informations supplémentaires (par exemple, en-tête) sur chaque page
        doc.text(`Rapport Caisse : DU : ${dateDebut.value}  AU :  ${dateFin.value}`, center, currentYPosition, { align: 'center' });
        currentYPosition += 10;

        // Ajout du tableau au document PDF
        doc.autoTable({
            head: headers,
            body: pageData,
            startY: 30, // Position y de départ du tableau
            margin: { top: 10 },
            styles: { cellPadding: 2, fontSize: 11, valign: 'middle' },
            columnStyles: {
                0: { halign: 'left' }, // Alignement de la première colonne
                3: { halign: 'right' }, // Alignement de la dernière colonne
            },
            startY: currentYPosition, // Position Y ajustée pour le début du tableau
        });
    }

    let nomRapport = 'rapport';
    if (selectedDoctor.value && selectedDoctor.value.name) { // Assurez-vous d'accéder correctement au nom
        nomRapport += `_${selectedDoctor.value.name}`;
    }
    if (typeAssuranceSelected.value) {
        nomRapport += `_${typeAssuranceSelected.value}`;
    }
    if (dateDebut.value) {
        nomRapport += `_${dateDebut.value}`;
    }
    if (dateFin.value) {
        nomRapport += `_${dateFin.value}`;
    }
    nomRapport += '.pdf';

    doc.save(nomRapport);
};

// Generate pdf Bloc
const generatePDFbloc = () => {
    if (!areDatesSelected()) {
        useToast().error('Date Debut et Date FIn sont Obligatoire !!', { position: 'bottom-right', duration: 3000 });
        return;
    }
    const doc = new jsPDF({
        orientation: "portrait",
        unit: "mm",
        format: "a4",
    });

    const pageWidth = doc.internal.pageSize.getWidth();
    const center = pageWidth / 2;

    const headers = [['Date', 'Nom Prénom', 'Operation','Mutuelles', 'Prix']];

    const data = props.caisse.map(reglement => [
        reglement.dateOperation,
        `${reglement.patient.nomPatient} ${reglement.patient.prenomPatient}`,
        reglement.nomOperation,
        reglement.typeAssurance,
        `${reglement.prixOperation} DH`,
       
       
    ]);

    data.push([
        { content: 'Total', colSpan: 4, styles: { halign: 'right', fontStyle: 'bold' } },
        { content: `${montantTotalBloc.value} DH`, styles: { fontStyle: 'bold' } } // Mettre le montant en gras
    ]);

    const itemsPerPage = 25; // Nombre d'enregistrements par page
    let totalPages = Math.ceil(data.length / itemsPerPage);

    for (let page = 1; page <= totalPages; page++) {
        if (page > 1) {
            doc.addPage();
        }
        // Sélection des données pour la page actuelle
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = page * itemsPerPage;
        const pageData = data.slice(startIndex, endIndex);

        let currentYPosition = 20; // Position Y initiale pour le premier texte
        if (selectedDoctor.value && selectedDoctor.value.name) {
            doc.text(`Docteur : ${selectedDoctor.value.name}`, center, currentYPosition, { align: 'center' });
            currentYPosition += 10; // Incrémenter la position Y pour le prochain texte
        }
        // Ajout des dates du rapport
        let dateLineY = selectedDoctor.value && selectedDoctor.value.name ? 30 : 25; // Ajuster la position Y en fonction de la présence du nom du docteur
        doc.text(`liste des opérations `, center, currentYPosition, { align: 'center' });  
        currentYPosition += 10;
        // Ajout des informations supplémentaires (par exemple, en-tête) sur chaque page
        doc.text(`DU : ${dateDebut.value}  AU :  ${dateFin.value}`, center, currentYPosition, { align: 'center' });
        currentYPosition += 10;
       

        // Ajout du tableau au document PDF
        doc.autoTable({
            head: headers,
            body: pageData,
            startY: 30, // Position y de départ du tableau
            margin: { top: 10 },
            styles: { cellPadding: 2, fontSize: 11, valign: 'middle' },
            columnStyles: {
                0: { halign: 'left' }, // Alignement de la première colonne
                3: { halign: 'right' }, // Alignement de la dernière colonne
            },
            startY: currentYPosition, // Position Y ajustée pour le début du tableau
        });
    }

    let nomRapport = 'rapport_Bloc_Operatoire';
    if (selectedDoctor.value && selectedDoctor.value.name) { // Assurez-vous d'accéder correctement au nom
        nomRapport += `_${selectedDoctor.value.name}`;
    }
    if (typeAssuranceSelected.value) {
        nomRapport += `_${typeAssuranceSelected.value}`;
    }
    if (dateDebut.value) {
        nomRapport += `_${dateDebut.value}`;
    }
    if (dateFin.value) {
        nomRapport += `_${dateFin.value}`;
    }
    nomRapport += '.pdf';

    doc.save(nomRapport);

}

</script>

