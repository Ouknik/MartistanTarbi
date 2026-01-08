<template>
    <!-- loader Start -->
    <!-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> -->
    <!-- loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <SideBar></SideBar>
        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <!-- TOP Nav Bar -->
            <Header />
            <!-- TOP Nav Bar END -->
            <div class="container-fluid">
                <slot></slot>
            </div>
            <!-- Footer -->
            <Footer :year="2023"></Footer>
            <!-- Footer END -->
        </div>

    </div>
</template>

<script setup>
import SideBar from "./Template/SideBar.vue";
import Header from "./Template/Header.vue";
import Footer from "./Template/Footer.vue";

import { useForm, router,usePage } from "@inertiajs/vue3";
import { ref,onMounted } from 'vue';

const props = defineProps({

});

// onMounted(() => {
//     setTimeout(() => {
//         isLoading.value = false;
//     }, 500);
// });
</script>
