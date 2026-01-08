<template>
    <div class="modal" id="CreatePrescription" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Creer Prescriptions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-lg-6 mb-3">
                                <h4>{{ $props.medicament.nomMedicament }} {{ $props.medicament.dosageMedicament }} {{
                                    $props.medicament.uniteDosageMedicament }}</h4>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-11 mb-3">
                                <input type="text" v-model="prescription.contenuPrescription" class="form-control"
                                    id="champPrescriptionAdd">
                            </div>
                            <div class="col-lg-1 mt-1">
                                <button @click="addPrescription" type="button" class="btn btn-primary mb-3"><i
                                        class="ri-add-circle-line"></i></button>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 mb-3">
                                <div class="iq-card">
                                    <div class="iq-card-header bg-secondary d-flex justify-content-between">
                                        <div class="iq-header-title">
                                            <h4 class="card-title text-white">Liste Prescriptions</h4>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <ul class="doctors-lists m-0 p-0">
                                            <li v-for="prescription in medicament.prescriptions"
                                                class="d-flex mb-4 align-items-center">
                                                <input type="text" class="form-control mr-4"
                                                    v-model="prescription.prescription" id="validationDefault03">
                                                <button type="button" @click="updatePrescription(prescription)"
                                                    class="btn btn-success mt-0 mr-2"><i class="ri-edit-line"></i></button>
                                                <button type="button" @click="deletePrescription(prescription)"
                                                    class="btn btn-danger mt-0 mr-2"><i
                                                        class="ri-delete-bin-line"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { router, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
const props = defineProps({
    medicament: Object
});

const prescription = useForm({
    contenuPrescription: "",
    medicament: "",
});

const addPrescription = () => {
    if (!prescription.contenuPrescription.trim()) {
        useToast().error('Le champ de prescription ne doit pas être vide', { position: 'bottom-right', duration: 3000 });
        return;
    }
    prescription.medicament = props.medicament.id;
    router.visit('/prescriptions', {
        method: 'post',
        data: prescription,
        preserveState: true,
        preserveScroll: false,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#CreatePrescription').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
};

const updatePrescription = (prescription) => {
    router.visit(`/prescriptions/${prescription.id}`, {
        method: "put",
        data: prescription,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Prescription Modifier', { position: 'bottom-right', duration: 3000 });
            $('#UpdateAssurance').modal('hide');
        },
    })
}

const deletePrescription = (prescription) => {
    router.delete(`/prescriptions/${prescription.id}`, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().info('Prescription Supprimer', { position: 'bottom-right', duration: 3000 });
            $('#CreatePrescription').modal('hide');
        },
    })
}
</script>

<style scoped>
.d-flex {
    display: flex;
    align-items: center;
}
.btn-small {
    padding: 5px 10px;
    margin-right: 8px;
}
</style>