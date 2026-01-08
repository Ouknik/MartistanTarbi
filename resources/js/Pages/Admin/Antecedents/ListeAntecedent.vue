<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddAntecedent">
            <i class="ri-add-fill"></i>
            Antecedent
        </button>
    </div>
    <ul v-for="antecedent in antecedents" v-bind:key="antecedent.id" class="iq-email-sender-list">
        <li class="iq-unread">
            <div class="d-flex align-self-center">
                <div class="iq-email-sender-info">
                    <div class="iq-checkbox-mail">
                        <!-- <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="mailk" />
                            <label class="custom-control-label" for="mailk"></label>
                        </div> -->
                    </div>
                    <a href="#" class="iq-email-title">
                        {{ antecedent.nomAntecedent }}
                    </a>
                </div>
                <div class="iq-email-content">
                    <a href="javascript: void(0);" class="iq-email-subject">
                        <!-- <span>
                            {{ antecedent.typeAntecedent }}
                        </span> -->
                    </a>
                    <div class="iq-email-date"></div>
                </div>
                <ul class="iq-social-media">
                    <li>
                        <a @click="editAntecedent(antecedent)" data-toggle="modal" data-value="{{antecedent}}"
                            data-target="#UpdateAntecedent"><i class="ri-edit-2-line"></i></a>
                    </li>
                    <li @click="deleteAntecedent(antecedent)">
                        <a href="#"><i class="ri-delete-bin-2-line"></i></a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <UpdateAntecedent :antecedent="antecedentobj"></UpdateAntecedent>
</template>
<script setup>
import UpdateAntecedent from "../Antecedents/UpdateAntecedent.vue";
import { ref  } from "vue";
import {router} from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";

let antecedentobj = ref({});


const props = defineProps({
    antecedents: Object,
});


const editAntecedent = (data) => {
    antecedentobj.value = data
}

const deleteAntecedent = (antecedent) => {
    router.delete(`/antecedents/${antecedent.id}`, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().info('Antecedent Supprimer', { position: 'bottom-right', duration: 3000 });
        },
    })
}
</script>
