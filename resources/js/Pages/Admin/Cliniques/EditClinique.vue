<template>
    <div class="modal fade" id="UpdateClinique" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Modifier Clinique</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="iq-card-body">

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationDefault01">Nom Clinique</label>
                                    <input type="text" class="form-control" v-model="$props.clinique.nomClinique"
                                        id="validationDefault01" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label class="control-label align-self-center mb-1"> Ville</label>
                                    <select class="form-control" id="selectcountry" v-model="$props.clinique.villeClinique"
                                        required>
                                        <option v-for="ville in villes" v-bind:key="ville.id" :value="ville.nomVille">
                                            {{ ville.nomVille }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" @click="updateClinique($props.clinique)" class="btn btn-primary"><i class="ri-bill-fill"
                               ></i>Modifier</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>
<script setup>
import {  router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
const props = defineProps({
    clinique: Object,
    villes:Object
});

const updateClinique = (clinique) => {
    router.visit(`/cliniques/${clinique.id}`, {
        method: 'put',
        data: clinique,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Clinique Bien Modifier', { position: 'bottom-right', duration: 3000 });
            $('#UpdateClinique').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
};

</script>

