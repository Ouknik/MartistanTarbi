<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddClinique">
            <i class="ri-add-fill"></i>
            Clinique
        </button>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3" v-for="clinique in cliniques" v-bind:key="clinique.id">
            <div class="iq-card border border-primary ml-2 mr-2">
                <div class="iq-card-body text-center">
                    <div class="doc-profile">
                        <img src="images/hospital.png" class=" img-fluid avatar-130" alt="clinique" />
                    </div>
                    <h3> {{ clinique.nomClinique }}</h3>
                    <div class="iq-doc-info mt-3 mb-3">
                        <h2>{{ clinique.nomCLinique }}</h2>
                        <p class="mb-0 mt-2 text-dark" style="font-size: 15px; font-weight: bolder;">{{
                            clinique.villeClinique }} </p>
                    </div>
                    <a @click="editClinique(clinique)" data-toggle="modal" class="btn btn-primary text-white mr-2 mt-2" data-value="{{clinique}}"
                        data-target="#UpdateClinique"><i class="ri-edit-2-line"></i>Modifier</a>
                    <a v-if="clinique.countOperations == 0" @click="deleteClinique(clinique)" class="btn btn-danger text-white mr-2 mt-2"><i
                            class="ri-edit-2-line"></i>Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    <UpdateClinique :clinique="cliniqueobj" :villes="villes"></UpdateClinique>
</template>
<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import UpdateClinique from "../Cliniques/EditClinique.vue";
import { useToast } from 'vue-toast-notification';

const props = defineProps({
    cliniques: Object,
    villes: Object
});
let cliniqueobj = ref({});
const editClinique = (data) => {
    cliniqueobj.value = data
}



const deleteClinique = (clinique) => {
    router.delete(`/cliniques/${clinique.id}`, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().info('Clinique Supprimer', { position: 'bottom-right', duration: 3000 });
        },
    })
}

</script>
