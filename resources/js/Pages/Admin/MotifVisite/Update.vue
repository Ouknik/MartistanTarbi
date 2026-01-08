<template>
    <div class="modal fade said" id="UpdateMotifVisite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Modifier Motif Visite</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="iq-card-body">
                            <form>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault01">Motif Visite </label>
                                        <input type="text" class="form-control" id="validationDefault01" required=""
                                            v-model="$props.motifVisite.motifVisite">
                                    </div>
                                </div>                  
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" @click="updateMotifVisite($props.motifVisite)"
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
    motifVisite: Object
});

const updateMotifVisite = (motifVisite) => {
    router.visit(`/motifvisite/${motifVisite.id}`, {
        method: "put",
        data: motifVisite,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Motif Visite Modifier', { position: 'bottom-right', duration: 3000 });
            $('#UpdateMotifVisite').modal('hide');
        },
    })
}
</script>
