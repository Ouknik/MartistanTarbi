<template>
    <div class="modal fade bd-OrdonnanceAdd-modal-lg" tabindex="88" role="dialog" style="display: none;" id="AddOrdonnance"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white">Créer Ordonnance </h5>
                    <span hidden>{{AddMedicament.idConsultation  = props.idConsultation }}</span>
                    <span hidden>{{AddMedicament.patient  = props.patient }}</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-5">
                    <form @submit.prevent="submit">

                        <div class="row">
                            <label :style="messageStyle" v-if="selectedMedicaments">{{
                                message }}</label>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="medicament">Recherche Médicament : </label>
                                    <input type="text" class="form-control" id="email1" @input="filtrerMedicaments"
                                        v-model="rechercheMedicament">
                                </div>
                                <ul v-if="medicamentsFiltres.length > 0" class="liste-medicaments">
                                    <li v-for="medicament in medicamentsFiltres" :key="medicament.id"
                                        @click="selectionnerMedicament(medicament)">
                                        {{ medicament.nomMedicament }}
                                    </li>
                                </ul>
                                <ul v-else>
                                    <button v-if="medicamentsFiltres.length === 0 && rechercheMedicament.length > 0"
                                        type="button" class="btn btn-outline-primary mb-3" data-toggle="modal"
                                        data-target="#AddMedicament">
                                        <i class="ri-add-fill"></i>
                                        Ajouter Médicament
                                    </button>
                                </ul>
                            </div>
                            <div class="col-lg-6" v-if="medicamentSelectionne">
                                <label class="prescription"> Prescriptions</label>
                                <select class="form-control my-2" v-model="traitementSelectionne">
                                    <option value="" disabled>Sélectionnez une prescription</option>
                                    <option v-for="traitement in traitementsDisponibles" :key="traitement.id"
                                        :value="traitement">
                                        {{ traitement.prescription }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div>
                        </div>
                        <!-- New Medicaments Ordonnance -->
                        <div v-if="traitementsChoisis.length">
                            <div v-for="(traitement, index) in traitementsChoisis" :key="index">
                                <div class="row mt-2">
                                    <div class="col-lg-11">
                                        <h5 style="font-weight: bold">
                                            <a @click="supprimerTraitement(index)" class="iq-icons-list" href="#"><i
                                                    class="ion-trash-b text-danger"></i>{{ traitement.nomMedicament }} {{
                                                        traitement.dosageMedicament }} {{ traitement.uniteDosageMedicament }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row p-0" style="margin-top: -15px;">
                                    <div class="col-lg-11">
                                        <input type="text" class="form-control ml-3"
                                            v-model.lazy="traitement.prescription" />
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input v-model="traitement.isChecked" type="checkbox"
                                                class="custom-control-input" :id="'customCheck-' + index" :checked="false">
                                            <label class="custom-control-label" :for="'customCheck-' + index"></label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Annuler
                            </button>
                            <button type="submit" :disabled="AddMedicament.processing" class="btn btn-primary">
                                Ajouter </button>
                        </div>
                    </form>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
    <addMedicament></addMedicament>
</template>
<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { router, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
import addMedicament from "../Medicaments/CreateMedicament.vue";
const selectedMedicaments = ref([]);
const message = ref('');
const messageStyle = ref('');
let rechercheMedicament = ref("");
let medicamentsFiltres = ref([]);
let medicamentSelectionne = ref(null);
let traitementsDisponibles = ref([]);
let traitementSelectionne = ref(null);
let traitementsChoisis = ref([]);

const props = defineProps({
    medicaments: Object,
    idConsultation: Number,
    patient:Number
});

let medicamentsData = ref(props.medicaments);

const AddMedicament = useForm({
    medicaments: traitementsChoisis,
    idConsultation: '',
    patient:''
})

onMounted(() => {
    medicamentsData.value = props.medicaments;
    // window.Echo.channel('get-medicaments').listen('Medicaments', (e) => {
    //     medicamentsData.value = e.medicaments;
    // });
});

const submit = () => {
    if(props.idConsultation==0){
        useToast().error('Veuillez Choisir Une Consultation', { position: 'bottom-right', duration: 3000 });
        return false;
    }
    router.visit(`/ordonnances`, {
        method: "post",
        data: AddMedicament,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onSuccess: page => {
            useToast().success('Ordonnance Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#AddOrdonnance').modal('hide');
            traitementsChoisis.value = []; // Reset selectedMedicaments
        },
    })
}

// Fonction pour filtrer les médicaments
const filtrerMedicaments = () => {
    medicamentsFiltres.value = rechercheMedicament.value
        ? medicamentsData.value.filter(medicament =>
            medicament.nomMedicament.toLowerCase().includes(rechercheMedicament.value.toLowerCase())
        )
        : [];
};
// Sélection d'un médicament et chargement des prescriptions
const selectionnerMedicament = (medicament) => {
    medicamentSelectionne.value = medicament;
    traitementsDisponibles.value = medicament.prescriptions || [];
    rechercheMedicament.value = '';
    medicamentsFiltres.value = [];

    if (traitementsDisponibles.value.length === 0) {
        traitementsChoisis.value.push({
            medicament_id: medicament.id, // Utilisez une valeur unique pour l'ID
            nomMedicament: medicament.nomMedicament,
            dosageMedicament: medicament.dosageMedicament,
            uniteDosageMedicament: medicament.uniteDosageMedicament,
            prescription: ' ',
            isChecked: ''
            // Champ de saisie vide pour une nouvelle prescription
        });
    }
};

watch(traitementSelectionne, (nouveauTraitement) => {
    if (nouveauTraitement) {
        traitementsChoisis.value.push({
            ...nouveauTraitement,
            nomMedicament: medicamentSelectionne.value.nomMedicament,
            dosageMedicament: medicamentSelectionne.value.dosageMedicament,
            uniteDosageMedicament: medicamentSelectionne.value.uniteDosageMedicament
        });
        traitementSelectionne.value = null;
    }
});

const supprimerTraitement = (index) => {
    traitementsChoisis.value.splice(index, 1);
};
</script>

<style scoped>
.liste-medicaments {
    max-height: 100px;
    overflow-y: auto;
    list-style-type: none;
    padding: 0;
}

.liste-medicaments li {
    cursor: pointer;
    padding: 5px;
    font-weight: bold;
    color: black;
}

.liste-medicaments li:hover {
    background-color: #c9c9c9;
    color: black;
}
</style>
