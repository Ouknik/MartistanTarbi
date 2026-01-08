<template>
    <div class="tab-pane fade show" id="pills-echographies-fill" role="tabpanel"
        aria-labelledby="pills-echographies-tab-fill">
        <div class="text-right"></div>
        <div class="text-right">
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ajouter un Document
                </button>
                <!--Start Menu Add Document / Echographie -->
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button type="button" @click="onSelectEcho('Echographie Gynecologique')"
                        class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black" data-toggle="modal"
                        data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie Gynecologique </button>
                    <button type="button" @click="onSelectEcho('Echographie Mammaire')"
                        class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black" data-toggle="modal"
                        data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie Mammaire </button>
                    <button type="button" @click="onSelectEcho('Echographie Pelvienne')"
                        class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black" data-toggle="modal"
                        data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie Pelvienne </button>
                    <button @click="onSelectEcho('Echographie Début de Grossesse 1')" type="button"
                        class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black" data-toggle="modal"
                        data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie Début de Grossesse 1 </button>
                    <button @click="onSelectEcho('Echographie Début de Grossesse 2')" type="button"
                        class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black" data-toggle="modal"
                        data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie Début de Grossesse 2 </button>
                    <!-- <button @click="onSelectEcho('Echographie 1ere Trimetre')" type="button"
                        class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black" data-toggle="modal"
                        data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie 1<sup>er</sup> Trimestre</button> -->
                    <button @click="onSelectEcho('Echographie 2ème/3ème Trimistre')" type="button"
                        class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black" data-toggle="modal"
                        data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie 2<sup>eme</sup> / 3<sup>eme</sup> Trimestre</button>
                    <!-- <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie 1<sup>er</sup> Trimestre Gemellaires</button> -->
                    <button type="button" @click="onSelectEcho('Echographie 2ème/3ème Trimistre GEM')"
                        class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black" data-toggle="modal"
                        data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie 2<sup>eme</sup> / 3<sup>eme</sup> Gemellaires</button>
                    <!-- <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie Mammaire </button>
                    <button type="button" class="dropdown-item btn btn-outline-primary mb-1 mr-2 mt-0 text-black"
                        data-toggle="modal" data-target=".bd-Echographie-modal-xl" style="font-size: 15px;">
                        Echographie Normale </button> -->
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

                                    <tr v-for="echographie in EchoGynecologique" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">Echographie Gynecologique</td>
                                        <td contenteditable="false">{{ echographie.date }}</td>
                                        <td>
                                            <button @click="editEchGynecologique(echographie)" type="button"
                                                class="btn btn-outline-success mb-1 mt-3" data-toggle="modal"
                                                data-target="#UpdateEchographieGynecologique" :data-value="echographie">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteEchGynecologique(echographie)" type="button"
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
                                    <tr v-for="echographie in echographies" :key="echographie.id">
                                        <td contenteditable="false">{{ echographie.id }}</td>
                                        <td contenteditable="false">{{ echographie.typeEcho }}</td>
                                        <td contenteditable="false">{{ echographie.dateEcho }}</td>
                                        <!-- <td>
                                            <button type="button" class="btn btn-outline-success mb-1 mt-3"
                                                data-toggle="modal" data-target="#UpdateEchographieNormale">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </button>
                                        </td> -->
                                        <td>
                                            <!-- button edit echo -->
                                            <a @click="editEchographie(echographie)" data-toggle="modal"
                                                class="btn btn-outline-success mb-1 mt-3" data-value="{{ echographie }}"
                                                data-target=".bd-EchographieEdit-modal-xl" style="font-size: 15px;">
                                                <i class="ri-edit-line"></i> <i class="ri-printer-line"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <button @click="deleteEchographie(echographie)" type="button"
                                                class="btn btn-outline-danger mb-1 mt-3">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <!-- Start List Document -->

                        <!-- End List Document -->
                    </div>
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
    <EditEchographieGynecologique :gestationnelle="gestationnelle" :EchographieGynecologique="EchGynecologiqueObj"
        :patient="patient" :age="age">
    </EditEchographieGynecologique>
    <!-- editEcho  -->
    <EditEchographie :echographieEdit="echographieEdit != null ? echographieEdit : null" :patient="patient" :age="age">
    </EditEchographie>

    <Echographie :patient="patient" :idConsultation="idConsultation" :content="content" :nomEcho="nomEcho">
    </Echographie>
</template>

<script setup>
import { ref, computed, defineAsyncComponent } from 'vue';
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
import EditEchographieGynecologique from "../EchographieGynecologique/Edit.vue";
import EditEchographie from "../Echographies/EditEcho.vue";
import { useToast } from 'vue-toast-notification';

let dateEcho = '';

const today = new Date();
const dateParts = today.toJSON().slice(0, 10).split('-');
dateEcho = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;

const Echographie = defineAsyncComponent(() =>
    import('../Echographies/Create.vue')
)

const props = defineProps({
    test: Object,
    documents: Object,
    patient: Object,
    gestationnelle: Object,
    age: Number,
    echographies: Object,
    idConsultation: Number,

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
    EchoGynecologique: {
        type: [Array, Object],
        default: () => []
    },
});

let echographieEdit = ref({});
const editEchographie = (data) => {
    echographieEdit.value = data
}

const nomEcho = ref('');
let content = ref('');


const onSelectEcho = (selectedEcho) => {
    switch (selectedEcho) {
        case 'Echographie Mammaire':
            nomEcho.value = "Echographie Mammaire";
            content.value = `
            <h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ${dateEcho}</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;${props.patient.civilitePatient} ${props.patient.nomPatient} ${props.patient.prenomPatient} &nbsp; &nbsp;</h4><h3>&nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ECHOGRAPHIE MAMMAIRE</h3><p>&nbsp;</p><h4><strong>INDICATION :
            </strong>&nbsp;</h4><p>&nbsp;</p><h4>- Sein droit et sein gauche d'échostructure homogène sans focale échographiquement individualisable.</h4><h4>- Les aires ganglionnaires axillaires sont libres.</h4><p>
            &nbsp;</p><h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>CONCLUSION :</strong></h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp;Echographie mammaire sans particularités ce jour</h4>`;
            break;
        case 'Echographie Gynecologique':
            nomEcho.value = "Echographie Gynecologique";
            content.value = `<h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ${dateEcho}</h3><h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ${props.patient.civilitePatient} ${props.patient.nomPatient} ${props.patient.prenomPatient} &nbsp; &nbsp;</h3><h2>&nbsp;
             &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ÉCHOGRAPHIE GYNÉCOLOGIQUE </h2><h4><strong>INDICATION :</strong> RAS</h4><h4><strong>
            Utérus :</strong> RAS</h4><h4><strong>Cavité utérine :</strong> RAS</h4><h4><strong>Endomètre :</strong> RAS</h4><h4><strong>Annexe Gauche :</strong> RAS</h4><h4><strong>
            Annexe Droite :</strong> RAS</h4><h4><strong>Cul de sac de douglas :</strong> absence d'épanchement.</h4><h4><strong>CONCLUSION :</strong></h4><h4>ASPECT DE POLYPE IC DE 14/10MM</h4>`;
            break;
        case 'Echographie 2ème/3ème Trimistre':
            nomEcho.value = "Echographie 2ème/3ème Trimistre";
            content.value = `<h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ${dateEcho}</h3><h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            ${props.patient.civilitePatient} ${props.patient.nomPatient} ${props.patient.prenomPatient} &nbsp; &nbsp;</h3><h2>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            ECHOGRAPHIE  2eme/3eme Trimestre</h2><h4><strong>INDICATION :</strong>&nbsp;</h4><h4>2ème/3ème TRIMESTRE :</h4><h4><strong>
            * Grossesse </strong>unique : 1</h4><h4><strong>&nbsp; &nbsp;Mouvement actifs</strong> : présents&nbsp;</h4><h4><strong>&nbsp; &nbsp;
            Présentation</strong> : céphalique</h4><h4><strong>&nbsp; &nbsp;Liquide amniotique</strong> : normale&nbsp;</h4><h4>&nbsp; &nbsp;
            Placenta</h4><h4><strong>* &nbsp;Localisation </strong>: &nbsp; &nbsp;postérieur : &nbsp; &nbsp; &nbsp; &nbsp;antérieure : &nbsp; &nbsp; &nbsp; &nbsp; fundique : &nbsp; &nbsp;</h4><h4><strong>* &nbsp;
            Grade </strong>: 2</h4><h4><strong>* &nbsp;Cordon </strong>: RAS&nbsp;</h4><h4><strong>&nbsp; &nbsp; Diamètre Bipariétal</strong> : &nbsp; &nbsp;
             &nbsp; &nbsp; mm &nbsp; &nbsp; &nbsp; correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SA et &nbsp;j</h4><h4><strong>&nbsp; &nbsp; Longueur Fémur</strong> : &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;mm &nbsp; &nbsp; &nbsp; correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SA et &nbsp;j</h4><h4><strong>&nbsp; &nbsp; 
            Circonf Abd</strong> : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; mm &nbsp; &nbsp; &nbsp; correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            SA et &nbsp;j</h4><p>&nbsp;</p><h4><strong>Conclusion </strong>:&nbsp;</h4><h4>grossesse évolutive de ${props.patient.AGGSS}</h4>`;
            break;

        case 'Echographie Pelvienne':
            nomEcho.value = "Echographie Pelvienne";
            content.value = `<h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ${dateEcho}</h3><h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  ${props.patient.civilitePatient} ${props.patient.nomPatient} ${props.patient.prenomPatient} &nbsp; &nbsp;</h3><h2>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ECHOGRAPHIE OBSTETRICALE</h2><h4><strong>INDICATION :</strong> RAS</h4><h4><strong>Vessie </strong>: Vide</h4><h4><strong>
            VAGIN ET COL</strong> : RAS</h4><h4><strong>UTERUS </strong>:</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; Position : antéversé&nbsp;</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; Contour : 
            réguliers&nbsp;</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; Echo structure : homogène&nbsp;</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; Endomètre : épaisseur &nbsp;normale</h4><h4>&nbsp;
             &nbsp; &nbsp; &nbsp; Cavite utérine : libre</h4><h4><strong>OVAIRES </strong>:</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; DROIT : RAS</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; GAUCHE: 
            RAS</h4><h4><strong>TROMPE </strong>:</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; DROIT : RAS</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; GAUCHE : RAS</h4><h4><strong>DOUGLAS </strong>: 
            libre</h4><h4><strong>Conclusion </strong>: Echographie pelvienne normale&nbsp;</h4><p>&nbsp;</p>`;
            break;


        case 'Echographie 2ème/3ème Trimistre GEM':
            nomEcho.value = "Echographie 2ème/3ème Trimistre GEM";
            content.value = `<h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;${dateEcho}</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp;${props.patient.civilitePatient} ${props.patient.nomPatient} ${props.patient.prenomPatient} &nbsp; &nbsp;</h4><h2>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            ECHOGRAPHIE OBSTITRICALE</h2><h4><strong>INDICATION :</strong>&nbsp;</h4><h4>2ème/3ème TRIMESTRE :</h4><h4><strong>&nbsp; &nbsp; &nbsp;* Grossesse gémellaire </strong>: 2 &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp;Activité Cardiaque : positive&nbsp;</h4><h4><strong>Mouvement actifs</strong> : présents &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Mouvements respiratoires : présents</h4><h4><strong>Présentation</strong> : 
            1ere siège</h4><h4>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2éme : céphalique&nbsp;</h4><h4><strong>Liquide amniotique</strong> :
            Liquide Amniotique diminué</h4><h4><strong>Placenta :&nbsp;</strong></h4><h4><strong>&nbsp; &nbsp; &nbsp;</strong><i><strong> </strong></i><strong>* Localisation</strong><i><strong></strong>:
            &nbsp; &nbsp;</i>postérieur <i>: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>* </strong></i><strong>Grade </strong><i>: &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</i>* <strong>Cordon </strong>:&nbsp;</h4><h4><strong>Diamètre Bipariétal 1</strong> : 
            &nbsp; &nbsp; &nbsp; &nbsp;mm &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SA &nbsp; &nbsp; et &nbsp; &nbsp;j</h4><h4><strong>Longueur 
            Fémur 1</strong> : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; mm &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SA &nbsp; 
            &nbsp; et &nbsp; &nbsp;j</h4><h4><strong>Diamètre Bipariétal 2</strong> : &nbsp; &nbsp; &nbsp; &nbsp;mm &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; SA &nbsp; &nbsp; et &nbsp; &nbsp;j</h4><h4><strong>Longueur  Fémur 2</strong> : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; mm &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp;correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SA &nbsp; &nbsp; et &nbsp; &nbsp;j</h4><h4><strong>Diam Abd</strong> &nbsp;<strong>Trans </strong>: 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; cm &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;SA &nbsp; &nbsp; et 
            &nbsp; &nbsp;j</h4><h4><strong>Circonf Abd</strong> : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;cm &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp;correspond au &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;SA &nbsp; &nbsp; et &nbsp; &nbsp;j</h4><h4>&nbsp;* Etude morphologique :</h4><h4><strong>Crane </strong>: &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>Rachis </strong>: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>Cœur </strong>: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>Estomac </strong>:
            &nbsp;</h4><h4><strong>Vessie </strong>: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>Reins </strong>: 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>Membres </strong>:<strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp;Paroi abdominale</strong> :</h4><h4><strong>Conclusion </strong>: grossesse gémellaire &nbsp;évolutive de ${props.patient.AGGSS} &nbsp; mono choriale &nbsp;mono amniotique</h4>`;
            break;



        case 'Echographie Début de Grossesse 2':
            nomEcho.value = "Echographie Début de Grossesse 2";
            content.value = `<h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ${dateEcho}</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;${props.patient.civilitePatient} ${props.patient.nomPatient} ${props.patient.prenomPatient}&nbsp; &nbsp;</h4><h2>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ECHOGRAPHIE 1er TRIMESTRE</h2><h4><strong>INDICATION :</strong>&nbsp;</h4><h4><strong>1er TRIMESTRE :</strong></h4><h4><strong>*</strong> <strong>Utérus 
            </strong>: gravide&nbsp;</h4><h4><strong>* Œuf Unique</strong> :&nbsp;</h4><h4>&nbsp; &nbsp; &nbsp; - Aspect :</h4><h4>&nbsp; &nbsp; &nbsp; - Vésicule ombilicale : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; mm</h4><h4><strong>
            * Embryon</strong> &nbsp;Unique :&nbsp;</h4><h4>&nbsp; &nbsp; &nbsp;- Activité cardiaque : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; positive&nbsp;</h4><h4>&nbsp; &nbsp; &nbsp;- Long cranio-caudale : &nbsp; &nbsp; &nbsp;
             &nbsp; &nbsp;mm, soit &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SA &nbsp; &nbsp;et &nbsp; &nbsp; j</h4><h4>&nbsp; &nbsp; &nbsp;- BIP &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;mm, soit &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SA</h4><h4><strong>* Annexe Gauche</strong> : RAS&nbsp;</h4><h4><strong>* Annexe Droite :</strong> RAS</h4><h4>&nbsp;</h4><h4>&nbsp; &nbsp;
             &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>Conclusion &nbsp;: &nbsp;</strong>grossesse évolutive &nbsp;de ${props.patient.AGGSS} &nbsp;
            </h4>`;
            break;

        case 'Echographie Début de Grossesse 1':
            nomEcho.value = "Echographie Début de Grossesse 1";
            content.value = `<h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ${dateEcho}</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;${props.patient.civilitePatient} ${props.patient.nomPatient} ${props.patient.prenomPatient} &nbsp; &nbsp;</h4><h2>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; ECHOGRAPHIE OBSTETRICALE</h2><h4><strong>INDICATION :</strong>&nbsp;</h4><h4><strong>1er TRIMESTRE :</strong></h4><h4><strong>*</strong> <strong>Utérus </strong>: gravide&nbsp;</h4>
            <h4><strong>* Œuf Unique/Multiple</strong> &nbsp;: &nbsp;1&nbsp;</h4><h4><strong>* Embryon</strong> &nbsp;: non vu</h4><h4><strong>* Trophoblaste Etalé homogène</strong>&nbsp;</h4><h4><strong>* Pas de MLU ni épanchement péritonéal
            </strong></h4><h4>&nbsp;</h4><h4>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>Conclusion &nbsp;: &nbsp;</strong>sac gestationnel de ${props.patient.AGGSS} &nbsp;</h4>`;
            break;
    }
};
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
const EchoGynecologique = computed(() => ensureArray(props.EchoGynecologique));

const deleteEchographie = (Echographie) => {
    router.delete(`/Echographies/${Echographie.id}`, {
        preserveScroll: true,
        preserveState: true,
        data: Echographie,
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
};


</script>
<script>
export default {
    components: {},
    props: ["data", "errors"],
    data() {
        return {
            EchGrossesseObj: {},
            EchNormaleObj: {},
            EchPremierTrimestreObj: {},
            EchDeuxiemeTrimestreObj: {},
            EchPremierTrimestreGemObjs: {},
            EchDeuxiemeTrimestreGemObj: {},
            EchPelviennesObj: {},
            EchMammaireObj: {},
            EchGynecologiqueObj: {}
        };
    },
    methods: {

        formatDate(timestamp) {
            return new Date(timestamp).toLocaleDateString("en-GB");
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
        editEchGynecologique: function (data) {
            this.EchGynecologiqueObj = data;
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

        deleteEchGynecologique(EchographieGynecologiqueDelete) {
            router.delete(`/EchographieGynecologique/${EchographieGynecologiqueDelete.id}`, {
                preserveScroll: true,
                preserveState: true,
                data: EchographieGynecologiqueDelete,
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
