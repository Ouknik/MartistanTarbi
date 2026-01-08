<template>
    <div class="modal fade bd-example-modal-xl" id="AddMedicamentsTraitement" tabindex="-1" role="dialog"
        style="display: none;" aria-hidden="true">
        <span hidden>{{ trait.traitementV=props.traitement }}</span>

        <div class="modal-dialog modal-xl">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Ajouter Médicament / Traitement </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body"  style="min-height: 500px;">
                        <div class="row pt-2 ml-1">
                            <div class="col-lg-6">
                                <label class="typo__label"> selectionner medicaments</label>
                                <MultiSelect v-model="selectedMedicamentNormalEdit" :options="medicaments"
                                    label="nomMedicament" :multiple="true" :custom-label="customLabel" tag-position="bottom"
                                    track-by="id">
                                </MultiSelect>
                            </div>
                            <div class="col-md-3 mb-3 col-lg-6">
                                <label for="validationCustom02">Nom Traitement</label>
                                <input type="text" class="form-control" v-model="traitement.nomTraitement"
                                    id="validationCustom02" required placeholder="Saisir le nom Du Traitement...">
                            </div>

                        </div>

                        <div class="row  justify-content-center">
                            <div v-if="selectedMedicamentNormalEdit">
                                <div v-for="medicament in selectedMedicamentNormalEdit" :key="medicament.id">
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
                                                    v-model="medicament.NombreComprime" />
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
                                                    v-model="medicament.quantiteParJour"  />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="input3">Moment de
                                                    prise</label>
                                                <select class="form-control form-control-md"
                                                    v-model="medicament.momentDePrise" >
                                                    <option value="Avant Repas">Avant Repas</option>
                                                    <option value="Milieu Repas">Milieu Repas</option>
                                                    <option value="Aprés Repas">Aprés Repas</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="input1">Durée</label>
                                                <input type="text" class="form-control" id="input1"
                                                    v-model="medicament.dureeNombre"  />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="input3">Durée de
                                                    Prise</label>
                                                <select class="form-control form-control-md" v-model="medicament.duree"
                                                    >
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
                        <button type="submit" @click="updateTraitement(traitement)"
                            class="btn btn-primary">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
import MultiSelect from "vue-multiselect";
const medicamentTraitement = ref([]);
const selectedMedicamentNormalEdit = ref(null);


const props = defineProps({
    medicaments: Object,
    medicament: Object,
    traitement: Object
});

const trait = useForm({
    medicaments: selectedMedicamentNormalEdit,
    traitementV: props.traitement,
})

const customLabel = ({
    nomMedicament,
    dosageMedicament,
    uniteDosageMedicament,
}) => {
    return `${nomMedicament} – ${dosageMedicament} ${uniteDosageMedicament}`;
};

const updateTraitement = (traitement) => {
    const errors = {};

    if (!selectedMedicamentNormalEdit.value || selectedMedicamentNormalEdit.value.length === 0) {
        useToast().error('Sélectionnez au moins un médicament.', { position: 'bottom-right', duration: 3000 });
        return;
    }

    selectedMedicamentNormalEdit.value.forEach((medicament) => {
        if (!medicament.NombreComprime) {
            errors[medicament.id] = 'Le champ Dose est obligatoire';
        }

        if (!medicament.quantiteParJour) {
            errors[medicament.id] = 'Le champ Par/jour est obligatoire';
        }

        if (!medicament.dureeNombre) {
            errors[medicament.id] = 'Le champ Durée est obligatoire';
        }

        if (!medicament.momentDePrise) {
            errors[medicament.id] = 'Le champ Moment de prise est obligatoire';
        }

        if (!medicament.duree) {
            errors[medicament.id] = 'Le champ Durée de Prise est obligatoire';
        }
    });

    if (Object.keys(errors).length > 0) {
        useToast().error('Veuillez remplir tous les champs obligatoires.', { position: 'bottom-right', duration: 3000 });
        return;
    }

    router.visit(`/traitements/${traitement.id}`, {
        method: "put",
        data: trait,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Traitement Modifié', { position: 'bottom-right', duration: 3000 });
            $('#AddMedicamentsTraitement').modal('hide');
            trait.medicaments = null;
        },
    });
}

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
