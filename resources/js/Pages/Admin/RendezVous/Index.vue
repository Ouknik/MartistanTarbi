<template>
    <AdminLayout>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <CalendarRendezVOus :rendezvous="rendezvous"></CalendarRendezVOus>
                    </div>
                </div>
            </div>
        </div>
       
    </AdminLayout>
</template>
<script setup>
import { ref, onMounted } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router, useForm } from "@inertiajs/vue3";
import CalendarRendezVOus from "../RendezVous/Calendar.vue";

const props = defineProps({
    rendezvous: Object,
});

</script>
