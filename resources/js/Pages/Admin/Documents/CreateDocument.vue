<template>
    <p hidden>{{ (form.patient = patient) }}</p>
    <div class="modal fade" tabindex="-1" id="AddDocument" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Ajouter Document
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputText1">Nom Document </label>
                                    <input type="text" v-model="form.nomDocument" class="form-control"
                                        id="exampleInputText1" placeholder="Nom Document">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputText1">Chemin du fichier </label>
                                    <div class="custom-file">
                                        <!-- <input type="file" name="pathDocument" class="custom-file-input" id="customFile"
                                            @input="onFileChange($event.target.files[0])">
                                        <label class="custom-file-label" for="customFile">Choisir un document </label> -->
                                        <input type="file" name="pathDocument" class="custom-file-input" id="customFile"
                                            @change="updateFileName">
                                        <label class="custom-file-label" for="customFile">{{ form.pathDocument ?
                                            form.pathDocument.name : 'Choisir un document' }}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <img v-if="previewImage.value" :src="previewImage.value" alt="Aperçu de l'image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button type="submit" class="btn mb-3 btn-primary"><i class="ri-bill-fill"
                                            :disabled="form.processing"></i>Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useForm, router } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
defineProps({
    patient: Object
})
const form = useForm({
    nomDocument: "",
    pathDocument: "",
    patient: "",
})

let previewImage = ref("");
let previewPDF = ref(""); // For previewing PDF

const onFileChange = (file) => {
    // const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];
    // if (!validImageTypes.includes(file.type)) {
    //     useToast().error('Veuillez télécharger uniquement des images', { position: 'bottom-right', duration: 3000 });
    //     return;
    // }
    form.pathDocument = file;
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = (e) => {
        if (file.type.startsWith('image/')) {
            previewImage.value = e.target.result;
        } else if (file.type === 'application/pdf') {
            previewPDF.value = e.target.result; // Set PDF preview
        }
    };
};

const updateFileName = (event) => {
    const file = event.target.files[0];
    onFileChange(file);
    form.pathDocument = file;
};

const submit = () => {
    if (!form.pathDocument) {
        useToast().error('Veuillez télécharger une image', { position: 'bottom-right', duration: 3000 });
        return;
    }
    router.visit('/documents', {
        method: 'post',
        data: form,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            $('#AddDocument').modal('hide');
            useToast().success('Document Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            form.pathDocument = new File([], '');
        },
        onError: errors => {
            useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 });
            console.error('Erreur lors de la soumission du formulaire :', errors);
        },
    });
}
</script>
