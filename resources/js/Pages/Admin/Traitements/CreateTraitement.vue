<template>
    <div class="modal fade bd-example-modal-xl" id="AddTraitement" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form @submit.prevent="submit">
                <div class="modal-content" >
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Ajouter Traitement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body"  style="min-height: 500px;">
                        <div class="row pt-2 ml-1">
                            <div class="col-lg-6">
                                <label class="typo__label"> selectionner medicaments</label>
                                <MultiSelect v-model="selectedMedicamentNormal" :options="medicaments" label="nomMedicament"
                                    :multiple="true" :custom-label="customLabel" tag-position="bottom" track-by="id">
                                </MultiSelect>
                            </div>
                            <div class="col-md-3 mb-3 col-lg-6">
                                <label for="validationCustom02">Nom Traitement</label>
                                <input type="text" class="form-control" v-model="trait.nomTraitement"
                                    id="validationCustom02" required placeholder="Saisir le nom Du Traitement...">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>

                        </div>

                        <div class="row  justify-content-center">

                            <div v-if="selectedMedicamentNormal">
                                <div v-for="(medicament, index) in selectedMedicamentNormal" :key="medicament.id">
                                    <div class="row mt-4">
                                        <div class="col-lg-11">
                                            <h5 style="font-weight: bold">
                                                {{ customLabel(medicament) }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="input1">Dose</label>
                                                <input type="text" class="form-control" style="width: 50px" id="input1"
                                                    v-model="medicament.NombreComprime" required />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="input1">U.M</label>
                                                <input type="text" class="form-control" style="width: 150px" id="input1"
                                                    v-model="medicament.uniteMessure" disabled />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="input2">Par/j</label>
                                                <input type="text" class="form-control" id="input2" placeholder=""
                                                    v-model="medicament.quantiteParJour" required />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="input3">Moment de
                                                    prise</label>
                                                <select class="form-control form-control-md"
                                                    v-model="medicament.momentDePrise" required>
                                                    <option  value="Avant Repas">Avant Repas</option>
                                                    <option value="Milieu Repas">Milieu Repas</option>
                                                    <option value="Aprés Repas">Aprés Repas</option>
                                                </select>
                                               
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="input1">Durée</label>
                                                <input type="text" class="form-control" id="input1"
                                                    v-model="medicament.dureeNombre" required />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="input3">Durée de
                                                    Prise</label>
                                                <select class="form-control form-control-md" v-model="medicament.duree" required>
                                                    <option value="Jours">Jours</option>
                                                    <option value="Semaines">Semaines</option>
                                                    <option value="Mois">Mois</option>
                                                </select>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
import { ref, computed, watch, onMounted } from "vue";
import { Link, router, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
import MultiSelect from "vue-multiselect";

const selectedMedicamentNormal = ref(null);


const props = defineProps({
    medicaments: Object,
    headers: Object,
    medicament: Object
});

const submit = () => {
    router.visit('/traitements', {
        method: 'post',
        data: trait,
        preserveState: true,
        preserveScroll: false,
        errorBag: null,
        forceFormData: false,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('le Traitement a été Bien Ajouté', { position: 'bottom-right', duration: 3000 });
            $('#AddTraitement').modal('hide');
            trait.medicaments = null;
        },
        onError: errors => {
            useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 });
        },
    });
}
const trait = useForm({
    nomTraitement: '',
    medicaments: selectedMedicamentNormal,
})


const customLabel = ({
    nomMedicament,
    dosageMedicament,
    uniteDosageMedicament,
}) => {
    return `${nomMedicament} – ${dosageMedicament} ${uniteDosageMedicament}`;
};
</script>

<style>
@import "vue-multiselect/dist/vue-multiselect.css";

.medicament-list {
    max-height: 150px;
    width: 500px;
    overflow-y: auto;
    position: relative;
    z-index: 10;
}
</style>
