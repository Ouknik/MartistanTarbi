<template>
    <div class="modal fade said" id="AddAssurance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Ajouter Assurance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="iq-card-body">

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationDefault01">Nom Assurance</label>
                                    <input type="text" class="form-control" v-model="assurance.typeAssurance"
                                        id="validationDefault01" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputText1">Chemin du fichier </label>
                                <div class="custom-file">
                                    <input type="file" name="imageAssurance" class="custom-file-input" id="customFile"
                                        @input="assurance.imageAssurance = $event.target.files[0]">
                                    <label class="custom-file-label" for="customFile">Choisir un document </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn mb-3 btn-primary"><i class="ri-bill-fill"
                                :disabled="assurance.processing"></i>Ajouter</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>




<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';

const props = defineProps({
    dataUpdate: {
        typeAssurance: String,
    },
});

const assurance = useForm({
    typeAssurance: "",
    imageAssurance: "",
});


const submit = () => {
    router.visit('/assurances', {
        method: 'post',
        data: assurance,
        preserveState: true,
        preserveScroll: false,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#AddAssurance').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
};

</script>

