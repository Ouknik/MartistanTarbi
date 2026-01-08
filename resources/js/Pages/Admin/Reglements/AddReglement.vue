<template>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="row justify-content-center align-items-center mb-2">
                <div v-for="(value, key) in items.TotalByDoctor" :key="key" :value="value.id"
                    class="col-md-6 col-lg-6 text-center font-size-17">
                    <span class="text-dark font-weight-bold">{{ value.nom }} </span> - <span
                        class="text-danger font-weight-bold">{{ calculateDifference(value) + " DH"
                        }}</span>
                </div>
            </div>
            <hr>
            <div class="row mt-2">

                <div class="col-lg-4">
                    <div class="form-group"><label for="cinPatient">CIN Patient :</label>
                        <input :value="items.cinPatient" type="text" id="cinPatient" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group"><label for="cinPatient">Nom Patient :</label>
                        <input :value="items.nomPatient" type="text" id="cinPatient" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group"><label for="cinPatient">Prénom Patient :</label>
                        <input :value="items.prenomPatient" type="text" id="cinPatient" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-2">
                <div class="form-group col-md-4 col-lg-4">
                    <label class="control-label align-self-center mb-1">Docteur</label>
                    <select name="docteur_id" class="form-control" id="docteur_id" v-model="Reglement.user_id">
                        <option v-for="(value, key) in items.TotalByDoctor" :key="key" :value="value.id">
                            {{ value.nom }}
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label class="control-label align-self-center mb-1">Motif</label>
                    <select name="motifReglement" class="form-control" id="motifReglement" v-model="Reglement.motifVisite">
                        <option v-for="motif in motifVisite" :value="motif.motifVisite">{{ motif.motifVisite }}</option>
                    </select>
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label class="control-label align-self-center mb-1">Mode</label>
                    <select name="modePaiement" class="form-control" id="modePaiement" v-model="Reglement.modePaiement">
                        <option value="Cash">Cash</option>
                        <option value="BiVirementlan">Virement</option>
                        <option value="Chéque">Chéque</option>
                    </select>
                </div>
                
            </div>
            <div class="row mt-2">
                <div class="form-group col-md-4 col-lg-6">
                    <label class="control-label align-self-center mb-1">Date Réglement</label>
                    <input type="date" id="montantReglement" class="form-control" v-model="Reglement.dateReglement"
                        >
                </div>
                <div class="form-group col-md-4 col-lg-6">
                    <label class="control-label align-self-center mb-1">Montant A Regler</label>
                    <input type="number" id="montantReglement" class="form-control" v-model="Reglement.montantReglement"
                        :max="montantMaximumPourDocteurSelectionne">
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <button @click="AddReglement($props.items)" type="button" class="btn btn-primary custom-width"
                    :disabled="isButtonDisabled">
                    <i class="ri-check-double-line"></i>Régler
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useToast } from 'vue-toast-notification';
import { ref, computed, watch } from "vue";
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps({
    items: Object,
    motifVisite: Object
});

const Reglement = useForm({
    montantReglement: '',
    modePaiement: 'Cash',
    motifVisite: props.items.statutPatient,
    patient_id: '',
    user_id: '',
    dateReglement:''
});
const montantMaximumPourDocteurSelectionne = ref(0); // Variable réactive pour le montant maximum

const emitReglementAdded = () => {
    // console.log('emit function called');
    // Emit an event to notify the parent component that the reglement is added
    const event = new Event('reglementAdded');
    window.dispatchEvent(event);
};


watch(() => [Reglement.user_id, props.items.TotalByDoctor], ([nouveauDocteurSelectionne]) => {
    const docteurSelectionne = props.items.TotalByDoctor.find((docteur) => docteur.id === nouveauDocteurSelectionne);

    if (docteurSelectionne) {
        montantMaximumPourDocteurSelectionne.value = docteurSelectionne.total_factures - docteurSelectionne.total_reglements;
    } else {
        montantMaximumPourDocteurSelectionne.value = 0;
    }
});

const isButtonDisabled = computed(() => {
    const isMontantValid =
        Reglement.montantReglement !== '' &&
        !isNaN(parseFloat(Reglement.montantReglement)) &&
        parseFloat(Reglement.montantReglement) > 0; // Check for greater than 0

    const isDocteurSelected = Reglement.user_id !== '';
    const isModeSelected = Reglement.modePaiement !== '';

    const montantSaisi = parseFloat(Reglement.montantReglement);

    return !(isMontantValid && isDocteurSelected && isModeSelected && montantSaisi <= montantMaximumPourDocteurSelectionne.value);
});
const AddReglement = (reglement) => {
    Reglement.patient_id = reglement.id;
    router.visit("ReglementFacture", {
        method: "post",
        data: Reglement,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        onProgress: (progress) => { },
        onSuccess: page => {
            useToast().success('Réglement  Ajouter', { position: 'bottom-right', duration: 3000 });
            emitReglementAdded();

            Reglement.montantReglement = '';
            Reglement.modePaiement = 'Cash';
            Reglement.motifVisite = props.items.statutPatient;
            Reglement.patient_id = '';
            Reglement.user_id = '';

        },
        onError: errors => {
            useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 });
        },
    });
};


const calculateDifference = (item) => {
    return (item.total_factures - item.total_reglements)
}

</script >
<style>
.custom-width {
    width: 200px;
    height: 50px;
}
</style>
