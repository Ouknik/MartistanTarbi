<template>
    <div class="modal" tabindex="-1" role="dialog" ref="ReglementModal">
        <div class="modal-dialog modal-lg" role="reglement">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white"><i class="fas fa-notes-medical"></i> Reglements Patients</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tab navigation -->
                    <ul class="nav nav-pills nav-fill mb-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="patientFactures-tab" data-toggle="pill" href="#patientFactures"
                                role="tab" aria-controls="patientFactures" aria-selected="true"><i
                                    class="fas fa-file-invoice"></i> Patient Factures</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="patientReglement-tab" data-toggle="pill" href="#patientReglement"
                                role="tab" aria-controls="patientReglement" aria-selected="false"><i
                                    class="fas fa-hand-holding-usd"></i> Patient Règlement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ajouterReglement-tab" data-toggle="pill" href="#ajouterReglement"
                                role="tab" aria-controls="ajouterReglement" aria-selected="false"><i
                                    class="fas fa-plus-square"></i> Ajouter Règlement</a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="patientFactures" role="tabpanel"
                            aria-labelledby="patientFactures-tab" v-if="item">
                            <!-- <ListFactures :items="$props.item"></ListFactures> -->
                        </div>
                        <div class="tab-pane fade" id="patientReglement" role="tabpanel"
                            aria-labelledby="patientReglement-tab">
                            B
                        </div>
                        <div class="tab-pane fade" id="ajouterReglement" role="tabpanel"
                            aria-labelledby="ajouterReglement-tab">
                            C
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>
                        Fermer</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-check"></i> Régler</button>
                </div>
            </div>

        </div>
    </div>
</template>



<script setup>
import { ref, onMounted, watchEffect } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import ListFactures from "../Reglements/ListFactures.vue";

const props = defineProps({
    item: Object
});
</script>
