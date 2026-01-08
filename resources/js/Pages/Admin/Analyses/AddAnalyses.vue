<template>
    <div class="card-body col-sm-12 col-lg-12">
        <button type="button" data-toggle="modal" data-target=".bd-OronnanceAnalyses-modal-lg"
            class="btn btn-outline-primary mb-1 mt-3">Imprimer Analyses <i class="ri-eye-line"></i></button>
            <!-- <button type="button" class="btn btn-outline-primary mb-1 ml-2 mt-3" @click="addAnalysesPat">Enregistrer <i class="ri-add-line"></i></button> -->
        <div class="form-group">
            <div class="row">
                <div class="col-lg-3" style="overflow: auto" v-for="familleanalyse in familleanalyses"
                    v-bind:key="familleanalyse.id">
                    <div class="iq-card-body">
                        <ul class="consultation-progress m-0 p-0">
                            <li class="d-flex align-items-center ml-2">
                                <h5 class="fst-bold">
                                    <i class="ri-bill-fill"></i>
                                    {{ familleanalyse.familleanalyse }}
                                </h5>
                            </li>
                            <li class="d-flex align-items-center " style="margin-left:30px"
                                v-for="analyse in familleanalyse.analyses" v-bind:key="analyse.famille_analyse_id">
                                <div
                                    class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                    <input type="checkbox" class="custom-control-input bg-primary" name="analyses"
                                        :value="analyse" :id="'analysesAdd_' + analyse.id" v-model="checkedAnalysesAdd" />
                                    <label class="custom-control-label" :for="'analysesAdd_' + analyse.id">
                                        {{ analyse.nomAnalyse }}
                                    </label>

                                    <ul class="consultation-progress mt-4 mb-0 p-0" style="margin-left:-45px">
                                        <div v-for="sousAnalyse in sousAnalyses" v-bind:key="sousAnalyse.id">
                                            <li v-if="analyse.id == sousAnalyse.analyse_id"
                                                class="d-flex align-items-center ml-2 ">
                                                <input type="checkbox" class="custom-control-input bg-primary"
                                                    name="sousAnalyses[]" :value="sousAnalyse"
                                                    :id="'subanalysesAdd' + sousAnalyse.id"
                                                    v-model="checkedSousAnalysesAdd" />

                                                <label class="custom-control-label"
                                                    :for="'subanalysesAdd' + sousAnalyse.id">
                                                    {{ sousAnalyse.nomSousAnalyse }}</label>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <printAnalyses :patient="patient" :analyses="checkedAnalysesAdd" :sousAnalyses="checkedSousAnalysesAdd"
        :familleanalyses="familleanalyses"></printAnalyses>
</template>

<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { ref, computed, watch, onMounted } from "vue";
import printAnalyses from "./OrdonnanceAnalyses.vue";

const checkedAnalysesAdd = ref([]);
const checkedSousAnalysesAdd = ref([]);
const selectedAnalysesAdd = ref([]);
const selectedAnalysesRefAdd = ref([]);
watch(selectedAnalysesAdd, (newVal) => {
    selectedAnalysesRefAdd.value = newVal;
});
const props = defineProps({
    familleanalyses: Object,
    sousAnalyses: Object,
    patient: Object,
});
const analysesAdd = useForm({
  analyses: checkedAnalysesAdd,
 
});
</script>