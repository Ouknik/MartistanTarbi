<template>
    <div class="iq-sidebar" v-if="user">
        <div class="iq-sidebar-logo d-flex justify-content-between color-template">
            <Link href="/patients">
            <span><img src="/images/maristan.png" class="img-fluid" alt="" /></span>
            </Link>
            <div class="iq-menu-bt-sidebar">
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-more-fill"></i></div>
                        <div class="hover-circle"><i class="ri-more-2-fill"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li>
                        <Link href="/dashboard" class="iq-waves-effect">
                        <img class="white-image  pr-3" src="/images/logo/logoTarbi.png" width="80" height="80"
                            alt="Icone Accueil" />
                        <span class="font-weight-bold mt-2">Cabinet Medical <br> <span class="ml-1">Dr.
                                Tarbi Amina</span></span>
                        </Link>
                    </li>
                </ul>
            </nav>
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <hr class="hr" />
                    <li :class="route().current('dashboard') ? 'active font-weight-bold' : ''">
                        <Link href="/dashboard" v-if="user.type == 'docteur'"><i
                            class="ri-home-8-fill"></i><span>Dashboard</span>
                        </Link>
                    </li>
                    <li
                        :class="route().current('patients.index') || route().current('patients.show') ? 'active font-weight-bold' : ''">
                        <Link :href="route('patients.index')" class="iq-waves-effect"><i
                            class="ri-user-fill"></i><span>Patients</span></Link>
                    </li>
                    <li :class="route().current('rendezVous.index') ? 'active font-weight-bold' : ''">
                        <Link :href="route('rendezVous.index')" class="iq-waves-effect"><i
                            class="ri-calendar-todo-line"></i><span>Rendez Vous </span></Link>
                    </li>
                    <li :class="route().current('operations.index') ? 'active font-weight-bold' : ''">
                        <Link :href="route('operations.index')" class="iq-waves-effect"><i
                            class="ri-hospital-fill"></i><span>Bloc Opératoire</span></Link>
                    </li>

                    <li v-if="user.type == 'docteur'"
                        :class="route().current('statistique') ? 'active font-weight-bold' : ''">
                        <Link :href="route('statistique')" class="iq-waves-effect"><i
                            class="ri-bar-chart-2-fill"></i><span>Statistiques </span></Link>
                    </li>
                    <li :class="route().current('caisse') ? 'active font-weight-bold' : ''">
                        <Link :href="route('caisse')" class="iq-waves-effect"><i
                            class="ri-money-dollar-circle-line"></i><span>Caisse</span></Link>
                    </li>
                    <li v-if="user.type == 'admin'" :class="route().current('docteurs') ? 'active font-weight-bold' : ''">
                        <a href="#mailbox" class="iq-waves-effect collapsed " data-toggle="collapse"
                            aria-expanded="false"><i class="ri-group-fill"></i><span>Personnles</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="mailbox" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class=" active main-active">
                                <Link href="/docteurs"><i class="ri-user-fill"></i>Secretaires</Link>
                            </li>
                            <li class=" active main-active">
                                <Link href="/docteurs"><i class="ri-user-2-fill"></i>Docteur</Link>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#Gestationnel"><i class="ri-heart-fill"></i><span>Âge
                                Gestationnel </span></a>
                    </li>
                    <li v-if="user.type == 'admin'"
                        :class="route().current('permis.index') ? 'active font-weight-bold' : ''">
                        <Link :href="route('permis.index')" class="iq-waves-effect"><i
                            class="ri-roadster-line"></i><span>Permis de Conduite</span></Link>
                    </li>
                    <li :class="route().current('parametrage') ? 'active font-weight-bold' : ''">
                        <Link :href="route('parametrage')" class="iq-waves-effect"><i
                            class="ri-settings-2-line"></i><span>Paramétrage</span></Link>
                    </li>
                    <li v-if="user.type != 'secretaire'"
                        :class="route().current('reglages.index') ? 'active font-weight-bold' : ''">
                        <Link :href="route('reglages.index')" class="iq-waves-effect"><i
                            class="ri-list-settings-line"></i><span>Réglage</span>
                        </Link>
                    </li>
                </ul>
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
    <AgeGestationnelle :patient="$page.props.patient"></AgeGestationnelle>
</template>
<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AgeGestationnelle from '../../Pages/Admin/AgeGestationnelle/AgeGestationnelle.vue';

const page = usePage();
const user = computed(() => page.props.user);
</script>
<style scoped>
.white-image {
    filter: brightness(0) invert(1);
}

.white-hr {
    background-color: white;
    height: 0.001px;
    margin-top: 20px;
}
</style>
