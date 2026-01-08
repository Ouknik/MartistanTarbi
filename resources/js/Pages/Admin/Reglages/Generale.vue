<template>
    <div class="row">
        <div class="col-lg-3 text-center">
            <form @submit.prevent="submit">
                <img :src="$page.props.user.profile_photo_path" class="img-fluid" alt="" width="90">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" name="logo" class="custom-file-input" id="customFile"
                            @input="onFileChange($event.target.files[0])">
                        <label class="custom-file-label text-left" for="customFile">Choisir un logo </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" style="width: 260px;" class="btn mb-3 btn-primary"><i class="ri-bill-fill"
                            :disabled="form.processing"></i>Modifier</button>
                </div>
            </form>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';

const form = useForm({
    logo: ""
})

const onFileChange = (file) => {
    const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
    if (!validImageTypes.includes(file.type)) {
        useToast().error('Veuillez télécharger uniquement des images', { position: 'bottom-right', duration: 3000 });
        return;
    }
    form.logo = file;
};

const submit = () => {
    if (!form.logo) {
        useToast().error('Veuillez télécharger une image', { position: 'bottom-right', duration: 3000 });
        return;
    }
    router.visit('/updateLogo', {
        method: 'post',
        data: form,
        preserveState: true,
        preserveScroll: false,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Document Bien Ajouter', { position: 'bottom-right', duration: 3000 });
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
}

</script>