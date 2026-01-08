<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddOperation">
            <i class="ri-add-fill"></i>
            Operation
        </button>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3" v-for="operation in typeOperations" v-bind:key="operation.id">
            <div class="iq-card border border-primary ml-2 mr-2">
                <div class="iq-card-body text-center">
                    <div class="iq-doc-info mt-3">
                        <h4 style="font-weight: bold;">{{ operation.typeOperation }}
                        </h4>
                    </div>
                    <a @click="editAssurance(operation)" data-toggle="modal" class="btn btn-primary text-white mr-2 mt-2"
                        data-value="{{operation}}" data-target="#UpdateOperation"><i class="ri-edit-2-line"></i>Modifier</a>
                    <a @click="deleteOperation(operation)" class="btn btn-danger text-white mr-2 mt-2"><i
                            class="ri-edit-2-line"></i>Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    <UpdateOperation :operation="operationobj"></UpdateOperation>
</template>
<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import UpdateOperation from "../TypeOperations/UpdateOperation.vue";
import { useToast } from 'vue-toast-notification';
const props = defineProps({
    typeOperations: Object,
});
let operationobj = ref({})
const editAssurance = (data) => {
    operationobj.value = data
}
const deleteOperation = (operation) => {
    router.delete(`/typeOperations/${operation.id}`, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().info('Operation Supprimer', { position: 'bottom-right', duration: 3000 });
        },
    })
}
</script>
