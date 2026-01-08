<template>
    <form class="needs-validation" novalidate>
        <div class="row pt-2">
            <div class="col-md-3 mb-3">
                <label for="validationCustom02">Nom Traitement</label>
                <input type="text" class="form-control" id="validationCustom02" v-model="trait.nomTraitement">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom02">Durée Traitement</label>
                <input type="text" class="form-control" id="validationCustom02" v-model="trait.dureeTraitement">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="iq-card pt-3">
            <div class="iq-card-header  bg-primary d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Traitement</h4>
                </div>
            </div>
            <div class="row">
                <button @click="itemsSelected.splice(itemsSelected)" type="button"
                    class="btn btn-outline-danger rounded-pill mb-1 mt-3 ml-4"><i class="ri-delete-bin-3-fill"></i>Vider La
                    Liste</button>
            </div>
            <div class="iq-card-body">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">Médicament</label>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="validationCustom02">Dosage</label>

                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="validationCustom02">Moment de Prise</label>

                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="validationCustom02">Quantité</label>

                    </div>
                    <div class="col-md-1 mb-2">
                        <label for="validationCustom03">Durée</label>

                    </div>
                    <div class="col-md-1 mb-1">
                        <label for="validationCustom03">Supprimer</label>
                    </div>
                </div>
                <div v-for="(items, index) in itemsSelected" :key="index" class="form-row">
                    <div class="col-md-4 mb-4">
                        <input type="text" class="form-control" v-model="items.nomMedicament" id="validationCustom01"
                            disabled>
                        <div class="valid-feedback">

                        </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a hidden>{{ strg = items.dosageMedicament + " " + items.uniteDosageMedicament }}</a>
                        <input type="text" class="form-control" v-model="strg" id="validationCustom02" disabled>
                        <div class="valid-feedback">

                        </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" class="form-control" id="validationCustom02" required>
                        <div class="valid-feedback">
                            <!-- :aria-label="`items ${index+1}`" -->
                        </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" class="form-control" id="validationCustom02" required>
                        <div class="valid-feedback">

                        </div>
                    </div>
                    <div class="col-md-1 mb-1">
                        <input type="text" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">

                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-1 mb-2">
                            <buttton @click="itemsSelected.splice(
                                    itemsSelected.indexOf(items),
                                    1
                                )
                                " class="btn btn-danger pt-2">
                                <i class="ri-close-line"></i>
                            </buttton>
                        </div>
                        <!-- <p>{{ consultation.medicamentP }}</p> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="form-group col-md-8 col-lg-4 ml-2">
            <input type="text" class="form-control" placeholder="Recherche..." id="cno" v-model="searchValue">
        </div>
    </div>
    <EasyDataTable buttons-pagination :items="medicaments" :headers="headers" :search-value="searchValue"
        :search-field="searchField" :rows-per-page="2" alternating v-model:items-selected="itemsSelected">
        <template #item-operation="item">
            <button @click="editMedicament(item)" class="btn btn-success m-2" data-toggle="modal" data-value="{{ item }}"
                data-target="#EditMedicament"><i class="ri-edit-line"></i></button>
            <button @click="deleteMedicament(item)" class="btn btn-danger m-2"><i class="ri-delete-bin-2-line"></i></button>
        </template>
        <template #empty-message>
            <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddMedicament"><i
                    class="ri-add-fill"></i>
                Ajouter Médicament</button>
        </template>

    </EasyDataTable>
    <button @click="submit" class="btn btn-primary" type="submit">Créer le Traitement</button>
</template>

<script setup>
import EasyDataTable from 'vue3-easy-data-table';
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
const searchValue = ref("");
const searchField = ref(["nomMedicament"]);
defineProps({
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
        onSuccess: page => { useToast().success('le Traitement a été Bien Ajouté', { position: 'bottom-right', duration: 3000 }); },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
}
const trait = useForm({
    nomTraitement: '',
    dureeTraitement: '',
    medicaments: itemsSelected
})
const headers = [
    { text: "Medicament", value: "nomMedicament", sortable: true },
    { text: "Dosage", value: "dosageMedicament", sortable: true },
    { text: "Unité Dosage", value: "uniteDosageMedicament", sortable: true },
    { text: "Forme", value: "formeMedicament", sortable: true },
    { text: "Prix", value: "prixMedicament", sortable: true },
    { text: "Action", value: "operation" }
];
</script>

<script>
const itemsSelected = ref([]);
export default {
    components: {
    },
    props: ['data', 'errors'],
    data() {
        return {
            form: this.$inertia.form({
                nTraitement: '',
                dTraitement: '',
            }),
            assurenceobj: Object,
            soinobj: Object,
            antecedentobj: Object,
            medicamentobj: Object
        }
    },
    methods: {

        editAssurance: function (data) {
            this.assurenceobj = data
        },
        editSoin: function (data) {
            this.soinobj = data
        },
        editMedicament: function (data) {
            this.medicamentobj = data
        },
        editTraitement: function (data) {
            this.traitementobj = data
        },
        editAntecedent: function (data) {
            this.antecedentobj = data
        },
        deletemedicament: function (items) {
            itemsSelected.splice(itemsSelected.indexOf(items), 1)
        }
    }
}
</script>
