<template>
    <div class="iq-top-navbar" v-if="user">
        <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
                <div class="top-logo">
                    <a href="index.html" class="logo">
                        <img :src="user.profile_photo_path || user.profile_photo_url || '/images/user/1.jpg'"  class="img-fluid" alt="">
                        <span>MPoint</span>
                    </a>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-more-fill"></i></div>
                        <div class="hover-circle"><i class="ri-more-2-fill"></i></div>
                    </div>
                </div>
                <!-- <div class="text-right">
                    <label class="ml-5 mt-1 text-primary" style="font-size: 30px;">Dossier Medical Patient</label>
                </div> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list">

                        <li class="nav-item iq-full-screen">
                            <a href="#" class="iq-waves-effect" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="modal" data-target="#Gestationnel"><i class="ri-heart-fill"></i></a>
                            <div class="iq-sub-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="search-toggle iq-waves-effect">
                                <i class="ri-notification-3-fill"></i>
                                <span class="bg-danger dots"></span>
                            </a>
                            <div class="iq-sub-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-danger p-3">
                                            <h5 class="mb-0 text-white">Notifications<small
                                                    class="badge  badge-light float-right pt-1"></small></h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                       
                    </ul>
                </div>
                <ul class="navbar-list">
                    <li>
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                            <img :src="user.profile_photo_path || user.profile_photo_url || '/images/user/1.jpg'" class="img-fluid rounded mr-3" alt="user">
                            <div class="caption">
                                <h6 class="mb-0 line-height"><span v-if="user.type == 'docteur'">Dr.</span> {{
                                    user.name }}</h6>
                                <span class="font-size-12">Connecté</span>
                            </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="color-template p-3">
                                        <h5  class="mb-0 text-white line-height">Bonjour <span v-if="user.type == 'docteur'">Dr.</span> {{ user.name }}</h5>
                                    </div>
                                    <Link :href="route('docteurs.show', user)" v-if="user.type=='docteur'"
                                        class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-file-user-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Mon Profile</h6>
                                            <p class="mb-0 font-size-12">Modifier vos informations</p>
                                        </div>
                                        
                                    </div>
                                    </Link>
                                    <Link :href="route('statistique')" class="iq-sub-card iq-bg-primary-hover"  v-if="user.type == 'docteur'">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-account-box-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Statistiques</h6>
                                            <p class="mb-0 font-size-12">Consulter vos stattistiques</p>
                                        </div>
                                    </div>
                                    </Link>

                                    <div class="d-inline-block w-100 text-center p-3">
                                        <button type="submit" @click="logout" class="color-template iq-sign-btn text-white">Se
                                            Déconnecter<i class="ri-login-box-line ml-2"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AgeGestationnelle from '../../Pages/Admin/AgeGestationnelle/AgeGestationnelle.vue';

const page = usePage();
const user = computed(() => page.props.user);

const logout = () => {
    router.post(route('logout'));
};
</script>

<style></style>
