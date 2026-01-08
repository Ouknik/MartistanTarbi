<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddAssurance">
            <i class="ri-add-fill"></i>
            Assurance
        </button>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3" v-for="assurance in assurances" v-bind:key="assurance.id">
            <div class="iq-card border border-primary">
                <div class="iq-card-body text-center">
                    <div class="doc-profile">

                        <img :src="assurance.imageAssurance" class="rounded-circle img-fluid avatar-100" alt="profile" />

                    </div>
                    <div class="iq-doc-info mt-3">
                        <h4 style="font-weight: bold;">{{ assurance.typeAssurance }}
                        </h4>

                        <!-- <a href="javascript:void();">www.demo.com</a> -->
                    </div>
                    <div class="iq-doc-social-info mt-3 mb-3">
                        <ul class="m-0 p-0 list-inline">
                            <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                            <li><a href="#"><i class="ri-twitter-fill"></i></a> </li>
                            <li><a href="#"><i class="ri-google-fill"></i></a></li>
                        </ul>
                    </div>
                    <!-- <h5 class="mb-0">Nombre Patient : {{ assurance.patient_count }}</h5> -->
                    <a @click="editAssurance(assurance)" data-toggle="modal" class="btn btn-primary text-white mr-2 mt-2"
                        data-value="{{assurance}}" data-target="#UpdateAssurance"><i class="ri-edit-2-line"></i>Modifier</a>
                    <a v-if="assurance.countPatients <= 0" @click="deleteAssurance(assurance)"
                        class="btn btn-danger text-white mr-2 mt-2"><i class="ri-edit-2-line"></i>Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    <UpdateAssurance :assurance="assurenceobj"></UpdateAssurance>
</template>
<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import UpdateAssurance from "../Assurances/UpdateAssurance.vue";
import { useToast } from 'vue-toast-notification';


const props = defineProps({
    assurances: Object,
});

let assurenceobj = ref({})
const editAssurance = (data) => {
    assurenceobj.value = data
}

const deleteAssurance = (assurance) => {
    router.delete(`/assurances/${assurance.id}`, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().info('Assurance Supprimer', { position: 'bottom-right', duration: 3000 });
        },
    })
}

</script>
