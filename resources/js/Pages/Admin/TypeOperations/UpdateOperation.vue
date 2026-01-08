<template>
    <div class="modal fade said" id="UpdateOperation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="submit">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Modifier Operation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="iq-card-body">

                            <form>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault01">Nom Operation </label>
                                        <input type="text" class="form-control" id="validationDefault01" required=""
                                            v-model="$props.operation.typeOperation">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" @click="updateOperation($props.operation)"
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
    operation: Object
});

const updateOperation = (operation) => {
    router.visit(`/typeOperations/${operation.id}`, {
        method: "put",
        data: operation,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Operation Modifier', { position: 'bottom-right', duration: 3000 });
            $('#UpdateOperation').modal('hide');
        },
    })
}
</script>
