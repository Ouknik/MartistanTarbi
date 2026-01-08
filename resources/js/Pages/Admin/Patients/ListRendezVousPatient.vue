<template>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="form-group col-md-6 col-lg-4">
                <input type="search" class="form-control" placeholder="Chercher Rendez Vous" id="cno" v-model="searchValue" />
            </div>
            <EasyDataTable buttons-pagination :items="items" :headers="headers" :search-value="searchValue"
                :hide-footer:search-field="searchField" :rows-per-page="4" alternating table-class-name="customize-table">
                <template #item-operation="item">
                    <div class="row">
                        <button @click="deleteRendezVous(item.id)" type="button" class="btn btn-danger m-2"
                            title="Ajouter à la Liste d'attente">
                            <i class="ri-delete-bin-2-line"></i>
                        </button>
                    </div>
                </template>
                <template #empty-message>
                    <a href="">Aucun patient avec les données saisie</a>
                </template>
            </EasyDataTable>
        </div>
    </div>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { useToast } from 'vue-toast-notification';
import { ref, onMounted, watchEffect } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import Datepicker from 'vue3-datepicker';
import { DatePicker } from 'v-calendar';
import { format } from 'date-fns';
//Import customize Components
//Reference
const searchValue = ref("");
const searchField = ref(["docteur.name"]);

//Define Props
const props = defineProps({
    items: Object,
});
//Delete Rendez-vous Patient
const deleteRendezVous = (rendezvous) => {
    router.delete(`/RendezVous/${rendezvous}`, {
        preserveState: true,
        preserveScroll: true,
        data: rendezvous,
        onSuccess: page => {
            useToast().info('Rendez Vous Supprimer', { position: 'bottom-right', duration: 3000 });
        },
    })
}
</script>
<style>
.customize-table {
    --easy-table-body-row-font-size: 11px;
    --easy-table-header-font-size: 14px;
    --easy-table-header-height: 20px;
    --easy-table-header-font-color: #010101;
    --easy-table-header-background-color: #ceebee;
    --easy-table-body-row-hover-background-color: #eee;
    --easy-table-body-item-padding: 6px 15px;
    --easy-table-footer-font-color: #281d65;
    --easy-table-footer-font-size: 14px;
    --easy-table-footer-height: 50px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-body-row-hover-font-color: #002561;
    --easy-table-body-row-hover-background-color: #ceebee;
}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(0, 0, 0);
    z-index: 1000;
}

.modal {
    z-index: 2000;
}
</style>
