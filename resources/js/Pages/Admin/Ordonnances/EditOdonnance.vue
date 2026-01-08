<template>
    <div class="modal fade bd-OrdonnanceEdit-modal-lg" tabindex="-1" role="dialog" style="display: none;"
        id="updateOrdonnance" aria-hidden="true" v-if="ordonnance">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Modifier Ordonnance {{ ordonnance.dateOrdonnance }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <span hidden>{{ AddMedicament.Ordonnance=props.ordonnance }}</span>
                    <div class="modal-body p-5">
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
                            <div class="col-lg-6" v-if="medicamentSelectionne && traitementsDisponibles.length > 0">
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
                        <!-- Medicament Ordonnance -->
                        <div v-for="(ordo, index) in ordonnance.medicaments" :key="ordo.id">
                            <div class="row mt-2">
                                <div class="col-lg-11">
                                    <h5 style="font-weight: bold">
                                        <a @click="deleteLigneOrdonnance(props.ordonnance.id, ordo.id)"
                                            class="iq-icons-list" href="#"><i class="ion-trash-b text-danger"></i>{{
                                                ordo.nomMedicament + " " + ordo.dosageMedicament + " " +
                                                ordo.uniteDosageMedicament }}</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="row p-0" style="margin-top: -15px;">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control ml-1" v-model.lazy="ordo.pivot.prescription" />
                                </div>
                            </div>
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
                                    <input type="text" class="form-control ml-3" v-model.lazy="traitement.prescription" />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Annuler
                            </button>
                            <button type="submit" @click="updateOrdonnace(props.ordonnance)" class="btn btn-primary">
                                Modifier </button>
                        </div>
                    </div>
                </form>
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
    ordonnance: Object,
    medicaments: Object
});

let medicamentsData = ref(props.medicaments);

const AddMedicament = useForm({
    medicaments: traitementsChoisis,
    Ordonnance: props.ordonnance
})


onMounted(() => {
    medicamentsData.value = props.medicaments;
    window.Echo.channel('get-medicaments').listen('Medicaments', (e) => {
        medicamentsData.value = e.medicaments;
    });
});

const updateOrdonnace = (ordonnance) => {
    router.visit(`/ordonnances/${ordonnance.id}`, {
        method: "put",
        data: AddMedicament,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Ordonnance Modifier', { position: 'bottom-right', duration: 3000 });
            $('#updateOrdonnance').modal('hide');
            traitementsChoisis.value = []; // Reset selectedMedicaments
        },
    })
}

const deleteLigneOrdonnance = (odonnanceID, medicamentID) => {
    router.delete(`/ordonnances/${odonnanceID}/medicament/${medicamentID}`, {
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Medicament Bien Supprimer', { position: 'bottom-right', duration: 3000 });
            $('#updateOrdonnance').modal('hide');
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
            prescription: ' ' // Champ de saisie vide pour une nouvelle prescription
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
