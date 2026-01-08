<template>
    <AdminLayout>
        <span hidden> {{ user = $page.props.user }}
        </span>
        <div class="row">
            <div class="col-lg-2">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div class="">
                            <div class="iq-email-list">
                                <button class="btn btn-primary btn-lg btn-block mb-3 font-size-12 p-3"
                                    data-target="#compose-email-popup" data-toggle="modal">
                                    <i class="ri-setting-line mr-2"></i>Parametrage
                                </button>
                                <div class="iq-email-ui nav flex-column nav-pills">
                                    <li class="nav-link active" role="tab" data-toggle="pill" href="#tab-assurances"
                                        aria-selected="true">
                                        <a href=""><i class="ri-settings-5-line"></i>Assurances</a>
                                    </li>

                                    <li class="nav-link" role="tab" data-toggle="pill" href="#tab-soins"
                                        aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Soins</a>
                                    </li>
                                    <li class="nav-link" role="tab" data-toggle="pill" href="#tab-motifVisite"
                                        aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Motif Visite</a>
                                    </li>
                                    <li class="nav-link" role="tab" data-toggle="pill" href="#tab-operations"
                                        aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Operations</a>
                                    </li>
                                    <li class="nav-link" role="tab" data-toggle="pill" href="#tab-medicaments"
                                        aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Médicaments</a>
                                    </li>
                                    <li  v-if="user.type == 'admin'" class="nav-link" role="tab" data-toggle="pill" href="#tab-traitements"
                                        aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Traitement</a>
                                    </li>
                                    <li v-if="user.type == 'admin'" class="nav-link" role="tab" data-toggle="pill"
                                        href="#tab-analyses" aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Analyses</a>
                                    </li>

                                    <li @click="getAntecedents" class="nav-link" role="tab" data-toggle="pill"
                                        href="#tab-antecedents" aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Antecedents</a>
                                    </li>
                                    <li class="nav-link" role="tab" data-toggle="pill" href="#tab-cliniques"
                                        aria-selected="false">
                                        <a href="#"><i class="ri-settings-5-line"></i>Cliniques</a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 mail-box-detail">
                <div class="iq-card">
                    <div class="iq-card-body p-0">
                        <div class="">
                            <div class="p-3">
                                <div class="d-flex justify-content-between"></div>
                            </div>
                            <div class="iq-email-listbox">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab-assurances" role="tabpanel">
                                        <ListAssurance :assurances="assurances"></ListAssurance>
                                    </div>
                                    <div class="tab-pane fade" id="tab-soins" role="tabpanel">
                                        <ListSoin :soins="soins"></ListSoin>
                                    </div>
                                    <div class="tab-pane fade" id="tab-motifVisite" role="tabpanel">
                                        <ListMotifVisite :motifVisite="motifVisite"></ListMotifVisite>
                                    </div>
                                    <div class="tab-pane fade " id="tab-operations" role="tabpanel">
                                        <ListOperation :typeOperations="typeOperations"></ListOperation>
                                    </div>
                                    <div class="tab-pane fade" id="tab-medicaments" role="tabpanel">
                                        <ListMedicament :medicaments="medicaments"></ListMedicament>
                                    </div>
                                    <div class="tab-pane fade" id="tab-traitements" role="tabpanel">
                                        <ListTraitement :medicaments="medicaments" :traitements="traitements">
                                        </ListTraitement>
                                    </div>
                                    <div class="tab-pane fade" id="tab-analyses" role="tabpanel">
                                        <ListAnalyses :analyses="analyses"></ListAnalyses>
                                    </div>
                                    <div class="tab-pane fade" id="tab-antecedents" role="tabpanel">
                                        <ListAntecedent :antecedents="antecedents"></ListAntecedent>
                                    </div>
                                    <div class="tab-pane fade" id="tab-cliniques" role="tabpanel">
                                        <ListClinique :cliniques="cliniques" :villes="villes"></ListClinique>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Component -->
        <CreateAssurance></CreateAssurance>
        <CreateAntecedent></CreateAntecedent>
        <CreateSoin></CreateSoin>
        <CreateMotifVisite></CreateMotifVisite>
        <CreateMedicament></CreateMedicament>
        <CreateTraitement :medicaments="medicaments"></CreateTraitement>
        <CreateClinique :villes="villes"></CreateClinique>
        <CreateAnalyses :data="analysesData"></CreateAnalyses>
        <CreateOperation></CreateOperation>

    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, onMounted, defineAsyncComponent } from "vue";
// Import List Component
import ListSoin from "../Soins/ListeSoin.vue";
import ListAssurance from "../Assurances/ListeAssurance.vue";
import ListTraitement from "../Traitements/ListeTraitement.vue";
import ListClinique from "../Cliniques/ListClinique.vue";
import ListMedicament from "../Medicaments/ListMedicament.vue";
import ListAntecedent from "../Antecedents/ListeAntecedent.vue";
import ListAnalyses from "../Analyses/ListAnalyses.vue";
import ListMotifVisite from "../MotifVisite/ListeMotifVisite.vue";
import ListOperation from "../TypeOperations/ListOperation.vue";

const CreateAssurance = defineAsyncComponent(() =>
    import('../Assurances/CreateAssurance.vue')
)

const CreateAntecedent = defineAsyncComponent(() =>
    import('../Antecedents/CreateAntecedent.vue')
)

const CreateSoin = defineAsyncComponent(() =>
    import('../Soins/CreateSoin.vue')
)

const CreateMedicament = defineAsyncComponent(() =>
    import('../Medicaments/CreateMedicament.vue')
)

const CreateTraitement = defineAsyncComponent(() =>
    import('../Traitements/CreateTraitement.vue')
)

const CreateClinique = defineAsyncComponent(() =>
    import('../Cliniques/Create.vue')
)

const CreateAnalyses = defineAsyncComponent(() =>
    import('../Analyses/CreateAnalyses.vue')
)

const CreateMotifVisite = defineAsyncComponent(() =>
    import('../MotifVisite/Create.vue')
)

const CreateOperation = defineAsyncComponent(() =>
    import('../TypeOperations/CreateOperation.vue')
)
//Component Update
const props = defineProps({
    antecedents: Object,
    assurances: Object,
    soins: Object,
    medicaments: Object,
    uniteDosages: Object,
    traitements: Object,
    cliniques: Object,
    villes: Object,
    analyses: Object,
    motifVisite: Object,
    typeOperations: Object,

});

let analysesData = ref(props.analyses);
onMounted(() => {
    analysesData.value = props.analyses;
    window.Echo.channel('analyses-data').listen('Analyses', (e) => {
        analysesData.value = e.analyses;
    });
});


</script>
