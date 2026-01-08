<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddSoins">
            <i class="ri-add-fill"></i>
            Soins
        </button>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3" v-for="soin in soins" v-bind:key="soin.id">
            <div class="iq-card border border-primary ml-2 mr-2">
                <div class="iq-card-body text-center">
                    <div class="doc-profile">
                        <img :src="soin.pathSoin" class="img-fluid avatar-130" alt="profile" />
                    </div>
                    <div class="iq-doc-info mt-3 mb-3">
                        <h4>{{ soin.libelleSoin }}</h4>
                        <p class="mb-0 mt-2 text-dark" style="font-size: 20px; font-weight: bolder;">{{
                            soin.montantSoin }} DH</p>
                    </div>

                    <a @click="editSoin(soin)" data-toggle="modal" class="btn btn-primary text-white mr-2 mt-2"
                        data-value="{{soin}}" data-target="#UpdateSoin"><i class="ri-edit-2-line"></i>Modifier</a>
                    <a v-if="soin.countConsultation == 0" @click="deleteSoin(soin)"
                        class="btn btn-danger text-white mr-2 mt-2"><i class="ri-edit-2-line"></i>Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    <UpdateSoin :soin="soinobj"></UpdateSoin>
</template>

<script setup>
import UpdateSoin from "../Soins/UpdateSoin.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';

const props = defineProps({
    soins: Object,
});

let soinobj = ref({});
const editSoin = (data) => {
    soinobj.value = data
}

const deleteSoin = (soin) => {
    router.delete(`/soins/${soin.id}`, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().info('Soin Supprimer', { position: 'bottom-right', duration: 3000 });
        },
    })
}

</script>
