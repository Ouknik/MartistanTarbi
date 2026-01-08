<template>
    <div class="tab-pane fade show" id="pills-documents-fill" role="tabpanel" aria-labelledby="pills-documents-tab-fill">
        <div class="text-right"></div>
        <div class="text-right">
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ajouter un Document
                </button>
                <!--Start Menu Add Document / Echographie -->
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target="#AddDocument">
                        Ajouter Document
                    </button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-EchographiePelvienne-modal-lg" style="font-size: 15px;">
                        Echographie Pelvienne </button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-EchographieDebutGrossesse-modal-lg" style="font-size: 15px;">
                        Echographie Début de Grossesse </button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-EchographiePremierTrimestre-modal-lg" style="font-size: 15px;">
                        Echographie 1<sup>er</sup> Trimestre</button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-EchographieDeuxiemeTrimestre-modal-lg"
                        style="font-size: 15px;">
                        Echographie 2<sup>eme</sup> / 3<sup>eme</sup> Trimestre</button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-EchographiePremierTrimestreGems-modal-lg"
                        style="font-size: 15px;">
                        Echographie 1<sup>er</sup> Trimestre Gemellaires</button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-EchographieDeuxiemeTrimestreGems-modal-lg"
                        style="font-size: 15px;">
                        Echographie 2<sup>eme</sup> / 3<sup>eme</sup> Gemellaires</button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-EchographieMammaire-modal-lg" style="font-size: 15px;">
                        Echographie Mammaire </button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-EchographieNormale-modal-lg" style="font-size: 15px;">
                        Echographie Normale </button>
                </div>
                <!--End  Add Document / Echographie  -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div id="table" class="table-editable">
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Type Document</th>
                                        <th>Date</th>
                                        <th>Modifier / Imprimer</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="echographie in EchoDebutGrossesse" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie Début de Grossesse</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchGrossesse(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographieGrossesse" :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchGrossesse(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-for="echographie in EchoPelvienne" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie Pelvienne</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchPelviennes(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographiePelviennes" :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchPelvienne(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-for="echographie in EchoPremierTrimestre" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie Premier Trimestre</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchPremierTrimestre(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographiePremierTrimestre" :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchPremierTrimestre(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-for="echographie in EchoDeuxiemeTrimestre" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie 2Eme Trimestre</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchDeuxiemeTrimestre(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographieDeuxiemeTrimestre" :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchDeuxiemeTrimestre(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-for="echographie in EchoPremierTrimetreG" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie Premier Trimestre Gem</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchPremierTrimestreGem(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographiePremierTrimestreGems"
                                                :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchPremierTrimestreGem(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-for="echographie in EchoDeuxiemeTrimestreG" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie 2Eme Trimestre Gem</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchDeuxiemeTrimestreGem(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographieDeuxiemeTrimestreGem"
                                                :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchDeuxiemeTrimestreGem(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-for="echographie in EchoMammaire" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie Mammaire</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchMammaire(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographieMammaire" :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchMammaire(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-for="echographie in EchoNormale" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie Normale</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchNormale(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographieNormale" :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchNormale(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-for="echographie in EchoNormale.echographie_normale" :key="echographie.id"
                                        v-if="EchoNormale.echographie_normale">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie TEST</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchNormale(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographieNormale" :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchNormale(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <!-- Start List Document -->
                        <div id="table" class="table-editable" v-if="documents.length > 0">
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Type Document</th>
                                        <th>Date</th>
                                        <th>imprimer</th>
                                        <th>Supprimer</th>
                                        <th>Aperçu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="document in documents" v-bind:key="document.id">
                                        <td contenteditable="false">
                                            {{ document.id }}
                                        </td>
                                        <td contenteditable="false">
                                            {{ document.nomDocument }}
                                        </td>
                                        <td contenteditable="false">
                                            {{ formatDate(document.created_at) }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-success  mb-1 mt-3"><i
                                                    class="ri-eye-line"></i></button>
                                        </td>

                                        <td>
                                            <button @click="deleteDocument(document)" type="button"
                                                class="btn btn-outline-danger  mb-1 mt-3"><i
                                                    class="ri-delete-bin-6-line"></i></button>
                                        </td>
                                        <td>
                                            <img :src="'/' + document.pathDocument" class="object-cover h-40 w-80"
                                                width="250" height="250" @click="showImage(document)" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!-- End List Document -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Apercu Image -->
    <div class="modal fade" ref="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered large-modal">
            <div class="modal-content" ref="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img :src="selectedImage" class="img-fluid" alt="Image preview" />
                </div>
            </div>
        </div>
    </div>
    <!-- End Moadl Apercu Image -->
    <EditEchGrossesse :gestationnelle="gestationnelle" :EchographieDebutGrossesse="EchGrossesseObj" :patient="patient"
        :age="age">
    </EditEchGrossesse>
    <EditEchNormale :gestationnelle="gestationnelle" :EchographieNormale="EchNormaleObj" :patient="patient" :age="age">
    </EditEchNormale>
    <EditEchDeuxiemeTrimestre :gestationnelle="gestationnelle" :EchographieeDeuxiemeTrimestre="EchDeuxiemeTrimestreObj"
        :patient="patient" :age="age"></EditEchDeuxiemeTrimestre>
    <EditEchographieDeuxiemeTrimestreGem :gestationnelle="gestationnelle"
        :EchographieDeuxiemeTrimestreGem="EchDeuxiemeTrimestreGemObj" :patient="patient" :age="age">
    </EditEchographieDeuxiemeTrimestreGem>
    <EditEchographiePremierTrimestreGems :gestationnelle="gestationnelle"
        :EchographiePremierTrimestreGems="EchPremierTrimestreGemObjs" :patient="patient" :age="age">
    </EditEchographiePremierTrimestreGems>
    <EditEchographieMammaire :gestationnelle="gestationnelle" :EchographieMammaire="EchMammaireObj" :patient="patient"
        :age="age">
    </EditEchographieMammaire>
    <EditEchographiePremierTrimestre :gestationnelle="gestationnelle" :EchographiePremierTrimestre="EchPremierTrimestreObj"
        :patient="patient" :age="age">
    </EditEchographiePremierTrimestre>
    <EditEchographiePelviennes :gestationnelle="gestationnelle" :EchographiePelviennes="EchPelviennesObj" :patient="patient"
        :age="age">
    </EditEchographiePelviennes>
</template>

<script setup>
import { ref, computed, toRefs } from 'vue';
import { router } from '@inertiajs/vue3';
// Import Edit Component Echographie
import EditEchGrossesse from '../EchographieDebutGrossesses/Edit.vue';
import EditEchNormale from "../EchographieNormale/Edit.vue";
import EditEchDeuxiemeTrimestre from "../EchographieDeuxiemeTrimestre/Edit.vue";
import EditEchographieDeuxiemeTrimestreGem from "../EchographieDeuxiemeTrimestreGem/Edit.vue";
import EditEchographiePremierTrimestreGems from "../EchographiePremierTrimestreGems/Edit.vue";
import EditEchographieMammaire from "../EchographieMammaire/Edit.vue";
import EditEchographiePremierTrimestre from "../EchographiePremierTrimestre/Edit.vue";
import EditEchographiePelviennes from "../EchographiePelviennes/Edit.vue";
import { useToast } from 'vue-toast-notification';


const props = defineProps({
    test:Object,
    documents: Object,
    patient: Object,
    gestationnelle: Object,
    age: Number,
    EchoDebutGrossesse: {
        type: [Array, Object],
        default: () => []
    },
    EchoPelvienne: {
        type: [Array, Object],
        default: () => []
    },
    EchoPremierTrimestre: {
        type: [Array, Object],
        default: () => []
    },
    EchoDeuxiemeTrimestre: {
        type: [Array, Object],
        default: () => []
    },
    EchoPremierTrimetreG: {
        type: [Array, Object],
        default: () => []
    },
    EchoDeuxiemeTrimestreG: {
        type: [Array, Object],
        default: () => []
    },
    EchoMammaire: {
        type: [Array, Object],
        default: () => []
    },
    EchoNormale: {
        type: [Array, Object],
        default: () => []
    },
});


const ensureArray = (value) => {
    if (Array.isArray(value)) {
        return value;
    } else if (value && typeof value === 'object') {
        return [value];
    }
    return [];
};

const EchoDebutGrossesse = computed(() => ensureArray(props.EchoDebutGrossesse));
const EchoPelvienne = computed(() => ensureArray(props.EchoPelvienne));
const EchoPremierTrimestre = computed(() => ensureArray(props.EchoPremierTrimestre));
const EchoDeuxiemeTrimestre = computed(() => ensureArray(props.EchoDeuxiemeTrimestre));
const EchoPremierTrimetreG = computed(() => ensureArray(props.EchoPremierTrimetreG));
const EchoDeuxiemeTrimestreG = computed(() => ensureArray(props.EchoDeuxiemeTrimestreG));
const EchoMammaire = computed(() => ensureArray(props.EchoMammaire));
const EchoNormale = computed(() => ensureArray(props.EchoNormale));


</script>
<script>
export default {
    components: {},
    props: ["data", "errors"],
    data() {
        return {
            selectedImage: '',
            EchGrossesseObj: {},
            EchNormaleObj: {},
            EchPremierTrimestreObj: {},
            EchDeuxiemeTrimestreObj: {},
            EchPremierTrimestreGemObjs: {},
            EchDeuxiemeTrimestreGemObj: {},
            EchPelviennesObj: {},
            EchMammaireObj: {},
        };
    },
    methods: {
        getDocuments() {
            router.get("/documents", data.documents, {
                preserveState: true,
                preserveScroll: true,
            });
        },
        formatDate(timestamp) {
            return new Date(timestamp).toLocaleDateString("en-GB");
        },
        async showImage(document) {
            this.selectedImage = '/' + document.pathDocument;

            const img = new Image();
            img.src = this.selectedImage;

            await new Promise((resolve) => {
                img.onload = () => resolve();
            });

            this.$refs.modalContent.style.width = `${img.width}px`;
            this.$refs.modalContent.style.height = `${img.height}px`;

            // Affichez le modal
            const imageModal = new bootstrap.Modal(this.$refs.imageModal);
            imageModal.show();
        },
        // Function Edit Echographie
        editEchGrossesse: function (data) {
            this.EchGrossesseObj = data;
        },
        editEchDeuxiemeTrimestre: function (data) {
            this.EchDeuxiemeTrimestreObj = data;
        },
        editEchDeuxiemeTrimestreGem: function (data) {
            this.EchDeuxiemeTrimestreGemObj = data;
        },
        editEchMammaire: function (data) {
            this.EchMammaireObj = data;
        },
        editEchNormale: function (data) {
            this.EchNormaleObj = data;
        },
        editEchPelviennes: function (data) {
            this.EchPelviennesObj = data;
        },
        editEchPremierTrimestre: function (data) {
            this.EchPremierTrimestreObj = data;
        },
        editEchPremierTrimestreGem: function (data) {
            this.EchPremierTrimestreGemObjs = data;
        },
        // Function Delete Document
        deleteDocument(document) {
            router.delete(`/documents/${document.id}`, {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
            });
        },
        deleteEchGrossesse(echographieDebutGrossesseDelete) {
            router.delete(`/EchographieDebutGrossessess/${echographieDebutGrossesseDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: echographieDebutGrossesseDelete,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
                onError: (errors) => {
                    alert("Erreurs");
                },
            });
        },

        deleteEchMammaire(echographieMammaireDelete) {
            router.delete(`/EchographieMammaires/${echographieMammaireDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: echographieMammaireDelete,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
                onError: (errors) => {
                    alert("Erreurs");
                },
            });
        },
        deleteEchNormale(echographieNormaleDelete) {
            router.delete(`/EchographieNormales/${echographieNormaleDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: echographieNormaleDelete,
                errorBag: null,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
                onError: (errors) => {
                    alert("Erreurs");
                },
            });
        },

        deleteEchPelvienne(echographiePelvienneDelete) {
            router.delete(`/EchographiePelviennes/${echographiePelvienneDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: echographiePelvienneDelete,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
                onError: (errors) => {
                    alert("Erreurs");
                },
            });
        },

        deleteEchPremierTrimestre(echographiePremierTrimestreDelete) {
            router.delete(`/EchographiePremierTrimestres/${echographiePremierTrimestreDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: echographiePremierTrimestreDelete,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
                onError: (errors) => {
                    alert("Erreurs");
                },
            });
        },

        deleteEchDeuxiemeTrimestre(echographieDeuxiemeTrimestreDelete) {
            router.delete(`/EchographieDeuxiemeTrimestres/${echographieDeuxiemeTrimestreDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: echographieDeuxiemeTrimestreDelete,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
                onError: (errors) => {
                    alert("Erreurs");
                },
            });
        },


        deleteEchPremierTrimestreGem(echographiePremierTrimestreGemDelete) {
            router.delete(`/EchographiePremierTrimestreGems/${echographiePremierTrimestreGemDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: echographiePremierTrimestreGemDelete,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
                onError: (errors) => {
                    alert("Erreurs");
                },
            });
        },

        deleteEchDeuxiemeTrimestreGem(echographieDeuxiemeTrimestreGemDelete) {
            router.delete(`/EchographieDeuxiemeTrimestreGems/${echographieDeuxiemeTrimestreGemDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: echographieDeuxiemeTrimestreGemDelete,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
                onError: (errors) => {
                    alert("Erreurs");
                },
            });
        },


    },
};
</script>
