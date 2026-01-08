<template>
    <AdminLayout>
        <span hidden>
            {{ user = $page.props.user }}
        </span>
        <div class="row">
            <div class="col-lg-3">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div class="">
                            <div class="iq-email-list">
                                <button class="btn btn-primary btn-lg btn-block mb-3 font-size-12 p-3"
                                    data-target="#compose-email-popup" data-toggle="modal">
                                    <i class="ri-setting-line mr-2"></i>Réglages
                                </button>
                                <div class="iq-email-ui nav flex-column nav-pills">
                                    <li  v-if="user.type == 'admin'" @click="getAssurances" class="nav-link" role="tab" data-toggle="pill"
                                        href="#tab-assurances" aria-selected="true">
                                        <a href=""><i class="ri-settings-5-line"></i>Informations Globale</a>
                                    </li>

                                    <li v-if="user.type == 'admin'" @click="getSoins" class="nav-link" role="tab"
                                        data-toggle="pill" href="#tab-soins" aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Importer/Exporter DataBase</a>
                                    </li>
                                    <li v-if="user.type == 'docteur'" @click="getTraitements" class="nav-link active" role="tab"
                                        data-toggle="pill" href="#tab-traitements" aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Profile information</a>
                                    </li>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mail-box-detail">
                <div class="iq-card">
                    <div class="iq-card-body p-0">
                        <div class="">
                            <div class="p-3">
                                <div class="d-flex justify-content-between"></div>
                            </div>
                            <div class="tab-content p-4">
                                <div class="tab-pane fade " id="tab-assurances" role="tabpanel">
                                    <Generale :configuration="configuration"></Generale>
                                </div>
                                <div class="tab-pane fade" id="tab-soins" role="tabpanel">
                                    <DataBase></DataBase>
                                </div>
                                <div class="tab-pane fade active show" id="tab-traitements" role="tabpanel">
                                    <Profile></Profile>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Component -->

    </AdminLayout>
</template>
<script setup>
import { useForm, router, Link } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, reactive } from "vue";
import DataBase from "./DataBase.vue";
import Generale from "./Generale.vue";
// import ShowProfile from "./ShowProfile.vue";
import Profile from "../../Profile/Show.vue"


const props = defineProps({
    configuration: Object
});

</script>
