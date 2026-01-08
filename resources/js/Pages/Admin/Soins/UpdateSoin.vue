<template>
    <div class="modal fade" id="UpdateSoin" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white" id="exampleModalScrollableTitle">Modifier Soin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01">Nom </label>
                                <input type="text" class="form-control"
                                    v-model="$props.soin.libelleSoin">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02">Prix</label>
                                <input type="text" class="form-control"
                                    v-model="$props.soin.montantSoin">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" @click="updateSoin($props.soin)" class="btn btn-primary">Modifier</button>
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
    soin: Object
});

const updateSoin = (soin) => {
    router.visit(`/soins/${soin.id}`, {
        method: "put",
        data: soin,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Soin Modifier', { position: 'bottom-right', duration: 3000 });
            $('#UpdateSoin').modal('hide');
        },
    })
}
</script>

