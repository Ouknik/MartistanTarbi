<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";

import InputError from "@/Components/InputError.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <!--<div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="mt-4">
                <InputLabel for="role_id" value="Role" />
                <select   name="role_id"
                    v-model="form.role_id"
                    class="mt-1 block w-full"
                >
                    <option value="0"> </option>
                    <option value="1">Doctor</option>
                    <option value="2">Secretaire</option>
                    <option value="3">Patient </option>


                </select>
                {{  form.role_id }}
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div> -->

        <div class="sign-in-from">
            <h1 class="mb-0">Sign Up</h1>
            <form class="mt-4" @submit.prevent="submit">
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input id="name" v-model="form.name" type="text" class="form-control mb-0" placeholder="Nom" required
                        autofocus autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="form-group">
                    <label for="email">Address Email</label>
                    <input id="email" v-model="form.email" type="email" class="form-control mb-0" required
                        autocomplete="username" autofocus />
                </div>
                <div class="form-group">
                    <label for="role_id">Role : </label>
                    <select name="role_id" v-model="form.role" class="form-control mb-0">
                        <option value="admin">admin</option>
                        <option value="docteur">Docteur</option>
                        <option value="secretaire">Secretaire</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" v-model="form.password" type="password" class="form-control mb-0"
                        placeholder="Password" required autocomplete="new-password" />
                    <InputError :message="form.errors.password" />
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password Confirm</label>
                    <input id="password_confirmation" v-model="form.password_confirmation" type="password"
                        autocomplete="new-password" class="form-control mb-0" placeholder="Password" required />
                    <InputError :message="form.errors.password_confirmation" />
                </div>
                <div class="d-inline-block w-100">
                    <button type="submit" class="btn btn-primary float-right" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Authentification
                    </button>

                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                    </Link>
                </div>
            </form>
        </div>
    </AuthenticationCard>
</template>
