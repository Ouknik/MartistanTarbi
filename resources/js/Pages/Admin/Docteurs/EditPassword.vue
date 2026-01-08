<template>
    <div class="modal fade bd-updatePassword-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white">Modifier Le Mot De Passe du Docteur : {{ $page.props.docteur.name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                        <div v-if="$page.props.jetstream.canUpdatePassword">
                            <UpdatePasswordForm class="mt-0" />
                        </div>
                        <!-- <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                            <UpdateProfileInformationForm :docteur=$page.props.docteur :user=$page.props.user></UpdateProfileInformationForm>
                        </div> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
 
 
<script setup>
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

import { useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    docteur: Object,
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,

})



</script>
 
<style></style>
 