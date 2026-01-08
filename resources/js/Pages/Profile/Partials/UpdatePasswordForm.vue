<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputError2 from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.put(route("user-password.update"), {
        errorBag: "updatePassword",
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <FormSection @submitted="updatePassword">
        <template #title>
            <div class="mt-0">Mettre à jour le mot de passe:
            </div>
        </template>

        <template #description>
            Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester en sécurité..
        </template>

        <template #form>
            <div class="row">
                <!-- current Password -->
                <div class="mb-3 col-12 col-sm-4 form-password-toggle">
                    <label class="form-label" for="currentPassword">Mot De Passe Actuel</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="password" id="currentPassword" v-model="form.current_password"
                            name="currentPassword" autocomplete="current-password"
                            placeholder="" />
                        <!-- <span class="input-group-text cursor-pointer"><i class="ri-eye-line"></i></span> -->
                        <InputError2 :message="form.errors.current_password" class="mt-2" />
                    </div>
                </div>
                <!-- end -->
                <div class="mb-3 col-12 col-sm-4 form-password-toggle">
                    <label class="form-label" for="newPassword">Nouveau Mot De Passe</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="password" v-model="form.password" id="newPassword"
                            name="newPassword" autocomplete="new-password"
                            placeholder="" />
                        <!-- <span class="input-group-text cursor-pointer"><i class="ri-eye-line"></i></span> -->

                    </div>
                    <InputError2 :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mb-3 col-12 col-sm-4 form-password-toggle">
                    <label class="form-label" for="confirmPassword">Confirmer Le Mot De Passe :</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="password" v-model="form.password_confirmation"
                            name="confirmPassword" id="confirmPassword" autocomplete="new-password"
                            placeholder="" />
                        <!-- <span class="input-group-text cursor-pointer"><i class="ri-eye-line"></i></span> -->
                    </div>
                    <InputError2 :message="form.errors.password_confirmation" class="mt-2" />
                </div>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Enregistrer
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-70': form.processing }" :disabled="form.processing">
                Modifier Le Mot De Passe 
            </PrimaryButton>
        </template>
    </FormSection>
</template>

