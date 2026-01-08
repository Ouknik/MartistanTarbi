<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddMotifVisite">
            <i class="ri-add-fill"></i>
            Motif Visite
        </button>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3" v-for="motif in motifVisite" v-bind:key="motif.id">
            <div class="iq-card border border-primary ml-2 mr-2">
                <div class="iq-card-body text-center">
                    <div class="iq-doc-info mt-3">
                        <h3 style="font-weight: bold;">{{ motif.motifVisite }}
                        </h3>
                    </div>
                    <a @click="editMotifVisite(motif)" data-toggle="modal" class="btn btn-primary text-white mr-2 mt-2"
                        data-value="{{motif}}" data-target="#UpdateMotifVisite"><i class="ri-edit-2-line"></i>Modifier</a>
                    <a @click="deleteMotifVisite(motif)" class="btn btn-danger text-white mr-2 mt-2"><i
                            class="ri-edit-2-line"></i>Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    <UpdateMotifVisite :motifVisite="motifVisiteobj"></UpdateMotifVisite>
</template>
<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import UpdateMotifVisite from "../MotifVisite/Update.vue";
import { useToast } from 'vue-toast-notification';
const props = defineProps({
    motifVisite: Object,
});

let motifVisiteobj = ref({})
const editMotifVisite = (data) => {
    motifVisiteobj.value = data
}
const deleteMotifVisite = (motif) => {
    router.delete(`/motifvisite/${motif.id}`, {
        preserveState: true,
        preserveScroll: true,
        data: motif,

        onSuccess: page => {
            useToast().info('Motif Visite Supprimer', { position: 'bottom-right', duration: 3000 });
        },
    })
}
</script>
