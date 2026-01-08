<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import EasyDataTable from "vue3-easy-data-table";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
</script>
<template>
    <AdminLayout> <CrudUsers :users="users"></CrudUsers> </AdminLayout>
</template>

<script>
import CrudUsers from "./CrudUsers.vue";
export default {
    props: {
        users: Object,
    },
    methods: {},
    data() {
        return {
            //users: this.users,
        };
    },

    mounted() {},
};
</script>
