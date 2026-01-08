<template>
    <div class="modal fade" id="AddAntecedent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Ajouter Antecedant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
const antecedent = useForm({
    nomAntecedent: '',
    typeAntecedent: ''

});
const submit = () => {
    router.visit('/antecedents', {
        method: 'post',
        data: antecedent,
        preserveState: true,
        preserveScroll: false,
        errorBag: null,
        forceFormData: false,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#AddAntecedent').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
};
</script>

