<template>
    <div class="modal fade" id="AddSoins" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form @submit.prevent="submit" >
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title  text-white" id="exampleModalScrollableTitle">Ajouter Soin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01">Nom </label>
                                <input type="text" class="form-control" id="validationDefault01" v-model="soin.libelleSoin"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02">Prix</label>
                                <input type="text" class="form-control" id="validationDefault02" v-model="soin.montantSoin"
                                    required>
                            </div>
                            <div class="col-lg-12 col-md-6 mb-1">
                                <label for="exampleInputText1">Chemin du fichier </label>
                                <div class="custom-file">
                                    <input type="file" name="imageAssurance" class="custom-file-input" id="customFile"
                                        @input="soin.pathSoin = $event.target.files[0]" data-ignore-validation>
                                    <label class="custom-file-label" for="customFile">Choisir un document </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary"><i class="ri-bill-fill"
                                :disabled="soin.processing"></i>Ajouter</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
const soin = useForm({
    libelleSoin: '',
    montantSoin: '',
    pathSoin: '',

});
const submit = () => {
    router.visit('/soins', {
        method: 'post',
        data: soin,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#AddSoins').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
};

</script>
