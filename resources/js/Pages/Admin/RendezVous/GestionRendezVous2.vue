<template>
    <div class="modal fade bd-GestionRendezVous2-modal-lg" tabindex="-1" role="dialog" id="ModalAddRendezVous2">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content" style="background-color: #eff7f8 ;">
                <div class="modal-header" style="background-color: #ffb177;">
                    <h5 class="modal-title">Gestion Des Rendez-vous</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills nav-fill mb-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="patientAddRendeVous2-tab" data-toggle="pill"
                                href="#patientAddRendeVous2" role="tab" aria-controls="patientAddRendeVous2"
                                aria-selected="true"><i class="fas fa-file-invoice"></i>Ajouter Rendez-Vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="patientRendezVousList2-tab" data-toggle="pill"
                                href="#patientRendezVousList2" role="tab" aria-controls="patientRendezVousList2"
                                aria-selected="false"><i class="fas fa-hand-holding-usd"></i>Liste Des Rendez-Vous</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="patientRendezVousList2" role="tabpanel"
                            aria-labelledby="patientRendezVousList2-tab" v-if="currentPatient">
                            <div class="iq-card">
                                <div class="iq-card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Date Rendez Vous</th>
                                                    <th>Docteur</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="rendezVous in currentPatient.RendezVous">
                                                    <td>{{rendezVous.dateRendezVous}}</td>
                                                    <td>{{ rendezVous.docteur.name }}</td>
                                                    <td>
                                                        <button @click="deleteRendezVous(rendezVous.id)" type="button"
                                                            class="btn btn-danger m-2" title="Ajouter à la Liste d'attente">
                                                            <i class="ri-delete-bin-2-line"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="patientAddRendeVous2" role="tabpanel"
                            aria-labelledby="patientAddRendeVous2-tab" v-if="currentPatient">
                            <div class="row text-center">
                                <div class="col-lg-6" style="font-size: 20px; color: black; font-weight: bold;">
                                    {{ currentPatient.nomPatient + " " + currentPatient.prenomPatient }}
                                   
                                </div>
                                <div class="col-lg-6" v-if="currentPatient"
                                    style="font-size: 20px; color: black; font-weight: bold;">
                                    {{ formatDate(newRendezVousDate) }}
                                </div>
                            </div>
                            <div class="row m-4">
                                <div class="col-lg-12">
                                    <DatePicker v-model="newRendezVousDate" mode="date" :min-date="new Date()" expanded>
                                    </DatePicker>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-lg-12">
                                <label class="control-label align-self-center mb-1"><span
                                        style="color: red; font-size: 1.5em;">*
                                    </span><span style="font-size: 20px; color: black; font-weight: bold;">Docteur
                                        :</span></label>
                                <select name="DocteurAddRendezVous" class="form-control" id="DocteurAddRendezVous"
                                    v-model="rendezvous.docteur_id" required>
                                    <option disabled selected>
                                        Selectioner Un Docteur
                                    </option>
                                    <option v-for="docteur in docteurs" :value="docteur.id" v-bind:key="docteur.id">
                                        {{ docteur.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="font-size: 16px;" class="btn btn-warning text-dark" @click="addRendezVous">
                        Enregistrer Le Rendez Vous
                    </button>
                    <button type="button" style="font-size: 16px;" class="btn btn-secondary" data-dismiss="modal">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useToast } from 'vue-toast-notification';
import { ref, watch } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { DatePicker } from 'v-calendar';
import { format } from 'date-fns';
const newRendezVousDate = ref(new Date());
const props = defineProps({
    currentPatient: Object,
    docteurs: Object
});
const PID = ref(props.currentPatient);

//UseForm rendez-vous
const rendezvous = useForm({
    dateRendezVous: newRendezVousDate.value,
    patient_id: PID,
    docteur_id: ''
});
watch(() => props.currentPatient, (newPatient) => {
    PID.value = newPatient.id;
})

//Add Rendez-vous Patient
const addRendezVous = () => {
    const formattedDate = format(newRendezVousDate.value, 'yyyy-MM-dd');
    rendezvous.dateRendezVous = formattedDate;
    if (rendezvous.docteur_id) {
        router.visit("/rendezVous", {
            method: "post",
            data: rendezvous,
            preserveState: true,
            preserveScroll: true,
            errorBag: null,
            forceFormData: false,
            onProgress: (progress) => { },
            onSuccess: page => {
                useToast().success('Rendez Vous  Ajouter', { position: 'bottom-right', duration: 3000 });
                $('#ModalAddRendezVous2').modal('hide');
            },
            onError: errors => {
                useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 });
            },
        });
    }
    else {
        useToast().error('Veuillez Selectionner Un Docteur ', { position: 'bottom-right', duration: 5000 });
    }

};
//Delete Rendez-vous Patient
const deleteRendezVous = (rendezvous) => {
    router.delete(`/RendezVous/${rendezvous}`, {
        preserveState: true,
        preserveScroll: true,
        data: rendezvous,
        onSuccess: page => {
            useToast().info('Rendez Vous Supprimer', { position: 'bottom-right', duration: 3000 });
            $('#ModalAddRendezVous2').modal('hide');
        },
    })
}
function formatDate(date) {
    if (!(date instanceof Date)) {
        return '';
    }
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();

    return `${day}-${month}-${year}`;
}
</script>
