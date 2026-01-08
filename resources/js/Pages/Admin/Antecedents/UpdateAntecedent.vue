<template>
    <div class="modal fade" id="UpdateAntecedent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Modifier Antecedant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="iq-card-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault01">Nom</label>
                                        <input type="text" class="form-control" v-model="$props.antecedent.nomAntecedent"
                                            id="validationDefault01" required="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <label class="control-label align-self-center mb-1">Type</label>
                                    <select v-model="antecedent.typeAntecedent" name="assurance_id" class="form-control"
                                        id="assurance_id">
                                        <option value="text">TEXTE</option>
                                        <option value="valeur">VALEURE NUMERIQUE</option>
                                        <option value="true">OUI / NON</option>
                                    </select>
                                </div>
                            </form>
                        </div> -->
                        <div class="iq-card-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationDefault01">Nom</label>
                                        <input type="text" class="form-control" v-model="antecedent.nomAntecedent"
                                            id="validationDefault01" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 col-lg-12">
                                        <label class="control-label align-self-center mb-1">Type</label>
                                        <select v-model="antecedent.typeAntecedent" name="assurance_id" class="form-control"
                                            id="assurance_id">
                                            <option value="text">TEXTE</option>
                                            <option value="valeur">VALEURE NUMERIQUE</option>
                                            <option value="true">OUI / NON</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="col-md-12 col-lg-12">
                                        <label class="control-label align-self-center mb-1"> <span
                                                class="text-danger font-size-16">* N.B</span></label>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <label class="control-label align-self-center mb-1"> <span
                                                class="text-primary font-size-16">* Texte : </span> Pour Les Antecedents Ayant un Long Texte</label>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <label class="control-label align-self-center mb-1"> <span
                                                class="text-primary font-size-16">* Valeur Numérique : </span> Pour Les Antecedents Ayant Une Valeur Numérique </label>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <label class="control-label align-self-center mb-1"> <span
                                                class="text-primary font-size-16">* OUI/ NON : </span> Pour Les Antecedents Ayant Pour OUI/NON</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" @click="updateAntecedent($props.antecedent)"
                            class="btn btn-primary">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';

const props = defineProps({
    antecedent: Object
});

const updateAntecedent = (antecedent) => {
    router.visit(`/antecedents/${antecedent.id}`, {
        method: "put",
        data: antecedent,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Antecedent Modifier', { position: 'bottom-right', duration: 3000 });
            $('#UpdateAntecedent').modal('hide');
        },
    })
}


const editAntededent = (data) => {
    traitementobj.value = data
}


</script>
