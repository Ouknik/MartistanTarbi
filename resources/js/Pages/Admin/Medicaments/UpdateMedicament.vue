<template>
    <div class="modal" id="EditMedicament" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Modifier Médicament</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <!-- <div class="col-md-6 mb-3">
                                <label for="validationDefault01">Code </label>
                                <input type="text" v-model="$props.medicament.codeMedicament" class="form-control"
                                    id="validationDefault01">
                            </div> -->
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02">Nom</label>
                                <input type="text" v-model="$props.medicament.nomMedicament" class="form-control"
                                    id="validationDefault02">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02">Dosage</label>
                                <input type="text" v-model="$props.medicament.dosageMedicament" class="form-control"
                                    id="validationDefault02">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02">Unité Dosage</label>
                                <input type="text" v-model="$props.medicament.uniteDosageMedicament" class="form-control"
                                    id="validationDefault02">
                            </div>
                            <!-- <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Forme</label>
                                <input type="text" v-model="$props.medicament.formeMedicament" class="form-control"
                                    id="validationDefault03">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Présentation</label>
                                <input type="text" v-model="$props.medicament.presentationMedicament" class="form-control"
                                    id="validationDefault03">
                            </div> -->
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05">Unité De Messure</label>
                                <input type="text" v-model="$props.medicament.uniteMessure" class="form-control"
                                    id="validationDefault05">
                            </div>
                            <!-- <div class="col-md-6 mb-3">
                                <label for="validationDefault05">Prix</label>
                                <input type="text" v-model="$props.medicament.prixMedicament" class="form-control"
                                    id="validationDefault05">
                            </div> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" @click="updateMedicament($props.medicament)"
                            class="btn btn-primary">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
const props = defineProps({
    medicament: Object
});

const updateMedicament = (medicament) => {
    router.visit(`/medicaments/${medicament.id}`, {
        method: "put",
        data: medicament,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Medicament Modifier', { position: 'bottom-right', duration: 3000 });
            $('#EditMedicament').modal('hide');
        },
    })
}


</script>

