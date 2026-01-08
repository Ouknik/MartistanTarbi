<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddTraitement">
            <i class="ri-add-fill"></i>
            Traitement
        </button>
    </div>
    <ul v-for="traitement in traitements" v-bind:key="traitement.id" class="iq-email-sender-list">
        <div></div>
        <li class="iq-unread">
            <div class="d-flex align-self-center">
                <div class="iq-email-sender-info">
                    <div class="iq-checkbox-mail">

                    </div>
                    <a href="javascript: void(0);" class="iq-email-title"> {{
                        traitement.nomTraitement }} </a>
                </div>
                <div class="iq-email-content">
                    <a href="javascript: void(0);" class="iq-email-subject">
                        {{ traitement.dureeTraitement }}
                    </a>
                    <div class="iq-email-date"></div>
                </div>
                <ul class="iq-social-media">
                    <li>
                        <a @click="deleteTraitement(traitement)"><i class="ri-delete-bin-2-line"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-edit-line"></i></a>
                    </li>
                </ul>
            </div>
        </li>
        <div class="email-app-details">
            <div class="iq-card">
                <div class="iq-card-body p-0">
                    <div class="">
                        <div class="iq-email-to-list p-3">
                            <div class="d-flex justify-content-between">
                                <ul>
                                    <li class="mr-3">
                                        <a href="javascript: void(0);">
                                            <h4 class="m-0">
                                                <i class="ri-arrow-left-line"></i>
                                            </h4>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr class="mt-0" />
                        <div class="iq-inbox-subject p-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="iq-card">
                                        <div class="iq-card-body">
                                            <div id="table" class="table-editable">
                                                <div class="d-flex align-items-center mb-4">
                                                    <label for="subject" class="mr-2 mt-1">Nom
                                                        traitement
                                                    </label>
                                                    <input type="text" id="subject" disabled class="form-control col-md-6"
                                                        :value="traitement.nomTraitement" />
                                                    <button type="button" class="btn btn-outline-primary ml-4"
                                                        @click="selectedTraitementId = traitement" data-toggle="modal"
                                                        data-target="#AddMedicamentsTraitement"><i class="ri-add-fill"></i>
                                                        Modifier Le Traitement
                                                    </button>

                                                </div>
                                                <table
                                                    class="table table-bordered table-responsive-md table-striped text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Médicament</th>
                                                            <th>Dosage</th>
                                                            <th>La Dose</th>
                                                            <th>x Par J</th>
                                                            <th>Moment de Prise</th>
                                                            <th colspan="2">Durée</th>
                                                            <th>Modifier</th>
                                                            <th>Supprimer</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="medi in traitement.medicaments" v-bind:key="medi.id">

                                                            <td contenteditable="false">
                                                                {{
                                                                    medi.nomMedicament
                                                                }}
                                                            </td>
                                                            <td contenteditable="false">
                                                                {{
                                                                    medi.dosageMedicament
                                                                    +
                                                                    " " +
                                                                    medi.uniteDosageMedicament
                                                                }}
                                                            </td>
                                                            <td contenteditable="true">
                                                                <input type="text" style="width: 60px;" id="subject"
                                                                    class="form-control"
                                                                    v-model="medi.pivot.NombreComprime" />
                                                            </td>
                                                            <td contenteditable="false">

                                                                <input type="text" style=" width: 60px;" id="subject"
                                                                    class="form-control"
                                                                    v-model="medi.pivot.quantiteParJour" />
                                                            </td>

                                                            <td contenteditable="false">

                                                                <select class="form-control form-control-md"
                                                                    v-model="medi.pivot.momentDePrise">
                                                                    <option value="Avant Repas">Avant Repas</option>
                                                                    <option value="Milieu Repas">Milieu Repas</option>
                                                                    <option value="Aprés Repas">Aprés Repas</option>
                                                                </select>

                                                            </td>
                                                            <td contenteditable="false">
                                                                <input type="text" style=" width: 60px;" id="subject"
                                                                    class="form-control" v-model="medi.pivot.dureeNombre" />
                                                            </td>
                                                            <td>
                                                                <select class="form-control form-control-md"
                                                                    v-model="medi.pivot.duree">
                                                                    <option value="Jours">Jours</option>
                                                                    <option value="Semaines">Semaines</option>
                                                                    <option value="Mois">Mois</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    @click="updateLigneTraitement(traitement.id, medi.pivot)"
                                                                    class="btn btn-outline-success mb-1 mt-3">
                                                                    <i class="ri-edit-2-fill"></i>
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    @click="deleteLigneTraitement(traitement.id, medi.pivot.medicament_id)"
                                                                    class="btn btn-outline-danger mb-1 mt-3">
                                                                    <i class="ri-delete-bin-3-fill"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ul>
    <AddMedicamentsTraitement :medicaments="medicaments" :traitement="selectedTraitementId">
    </AddMedicamentsTraitement>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import { useForm, router, Link } from "@inertiajs/vue3";
import AddMedicamentsTraitement from "../Traitements/AddMedicament.vue";
import { useToast } from "vue-toast-notification";

let selectedTraitementId = ref({});

const props = defineProps({
    medicaments: Object,
    traitements: Object,
});

const updateLigneTraitement = (traitementID, medicament) => {
    const jsonString = JSON.stringify(medicament);
    if (validateMedicament(medicament)) {
        router.put(`/traitement/${traitementID}/medicament/${jsonString}`, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: page => {
            },
            onError: error => {
                useToast().error("Erreur lors de la mise à jour : " + error.message, { position: 'bottom-right', duration: 3000 });
            }
        });
    }
};




const deleteTraitement = (traitement) => {
    router.delete(`/traitements/${traitement.id}`, {
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => { useToast().success('Traitement Bien Supprimer', { position: 'bottom-right', duration: 3000 }); },
    })
}

const deleteLigneTraitement = (traitementID, medicamentID) => {
    router.delete(`/traitement/${traitementID}/medicament/${medicamentID}`, {
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => { useToast().success('Medicament Bien Supprimer', { position: 'bottom-right', duration: 3000 }); },
    })
}

const validateMedicament = (medicament) => {
    if (!medicament.NombreComprime || 
        !medicament.quantiteParJour || 
        !medicament.momentDePrise || 
        !medicament.duree || 
        !medicament.dureeNombre) {
        useToast().error("Veuillez remplir tous les champs obligatoires", { position: 'bottom-right', duration: 3000 });
        return false;
    }

    if (!validateChiffres(medicament.NombreComprime) || 
        !validateChiffres(medicament.quantiteParJour) || 
        !validateChiffres(medicament.dureeNombre)) {
        useToast().error("Les champs doivent contenir uniquement des chiffres", { position: 'bottom-right', duration: 3000 });
        return false;
    }

    useToast().success("Medicament Bien Modifiée ", { position: 'bottom-right', duration: 3000 });
    
    return true;
};


const validate = () => {

    useToast().info("Veuillez remplir tous les champs obligatoires", { position: 'bottom-right', duration: 3000 });

    return true;
};



const validateChiffres = (valeur) => {
    const regex = /^[0-9]+$/;
    return regex.test(valeur);
};

</script>
