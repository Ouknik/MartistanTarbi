<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Login from './Auth/Login.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
    <Login></Login>
    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">
        </Link>

        <template v-else>
            <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">
            </Link>

            <Link v-if="canRegister" :href="route('register')"
                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
            </Link>
        </template>

    </div>
</template>
