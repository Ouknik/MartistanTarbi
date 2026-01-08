<template>
    <div v-if="isVisible" class="modal fade bd-example-modal-lg" id="AddMedicament" tabindex="-1" role="dialog"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Ajouter Médicament</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">                       
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02">Nom</label>
                                <input type="text" v-model="medicament.nomMedicament" class="form-control"
                                    id="validationDefault02">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02">Dosage</label>
                                <input type="text" v-model="medicament.dossageMedicament" class="form-control"
                                    id="validationDefault02" placeholder="Ex : 200, 500, 1000...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02">Unité Dosage</label>
                                <input type="text" v-model="medicament.unitedosageMedicament" class="form-control"
                                    id="validationDefault02" placeholder="Ex : MG / UI, MG, ML, %, µG...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05">Unité De Mesure</label>
                                <input type="text" v-model="medicament.uniteMessure" class="form-control"
                                    id="validationDefault05" placeholder="Ex : Comprimé, GELULE, Cuillère, Sachette ...">
                            </div>           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { useForm, router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
const isVisible = ref(false);
onMounted(() => {
    if (isVisible) {
        isVisible.value = true;
    }
});
const medicament = useForm({
    nomMedicament: '',
    dossageMedicament: '',
    unitedosageMedicament: '',
    uniteMessure: '',
});
const submit = () => {
    // if (validateMedicament(medicament)) {
        router.visit('/medicaments', {
            method: 'post',
            data: medicament,
            preserveState: true,
            preserveScroll: false,
            errorBag: null,
            forceFormData: true,
            onProgress: progress => { },
            onSuccess: page => {
                medicament.nomMedicament = '';
                medicament.unitedosageMedicament = '';
                medicament.dossageMedicament = '';
                medicament.uniteMessure = '';
                useToast().success('Bien Ajouter', { position: 'bottom-right', duration: 3000 });
                $('#AddMedicament').modal('hide');
            }, onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
        });
    // }
};
// const validateMedicament = (medicament) => {
//     if (
//         !medicament.nomMedicament ||
//         !medicament.dossageMedicament ||  !medicament.unitedosageMedicament  || !medicament.uniteMessure
//     ) {
//         useToast().error("Les champs Nom et Unité de mesure sont obligatoires", { position: 'bottom-right', duration: 3000 });
//         return false;
//     }
//     return true;
// };
</script>
