<template>
  <div class="iq-card">
    <div class="iq-card-body">
      <hr />
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="cinPatient">Clinique </label>
            <input
              type="text"
              :value="items.nomClinique"
              id="nomClinique"
              class="form-control"
              disabled
            />
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="cinPatient">Adresse </label>
            <input
              type="text"
              :value="items.villeClinique"
              id="villClinique"
              class="form-control"
              disabled
            />
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="cinPatient">Montant A Regler</label>
            <input
              :value="calculateDifference(items)"
              type="text"
              id="cinPatient"
              class="form-control"
              disabled
            />
          </div>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="form-group col-md-4 col-lg-6">
          <label class="control-label align-self-center mb-1">Mode</label>
          <select
            name="modePaiement"
            v-model="reglementOperation.modeReglement"
            class="form-control"
            id="modePaiement"
          >
            <option value="Cash">Cash</option>
            <option value="Virement">Virement</option>
            <option value="Chéque">Chéque</option>
          </select>
        </div>
        <div class="form-group col-md-4 col-lg-6">
          <label class="control-label align-self-center mb-1"
            >Montant A Regler</label
          >
          <input
            type="number"
            v-model="reglementOperation.montantReglement"
            id="montantReglement"
            class="form-control"
          />
        </div>
        <div class="row justify-content-center">
          <div class="form-group col-md-12 col-lg-12">
            <button
              type="button"
              class="btn btn-primary custom-width"
              @click="AddReglementOperation"
              :disabled="isBouttonDisabled"
            >
              <i class="ri-check-double-line"></i>Régler
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, computed,ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";

const isReglementAdded = ref(false);

// const { items } = defineProps(['items']);

const props = defineProps({
  items: Object,
});
const emit = defineEmits();

const reglementOperation = useForm({
  modeReglement: "",
  montantReglement: "",
  clinique: "",
});
const calculateDifference = (item) => {
  return item.TotalClinique - item.TotalReglement;
};

const isMontantValide = () => {
  const montant = parseFloat(reglementOperation.montantReglement);
  return (
    !isNaN(montant) &&
    montant > 0 &&
    montant <= calculateDifference(props.items)
  );
};

const isBouttonDisabled = computed(() => {
    return !isMontantValide() || isReglementAdded.value;
});

const AddReglementOperation = () => {
  reglementOperation.clinique = props.items.id;
  router.visit("ReglementOperation", {
    method: "post",
    data: reglementOperation,
    preserveState: true,
    preserveScroll: true,
    errorBag: null,
    forceFormData: false,
    onProgress: (progress) => {},
    onSuccess: (page) => {
      useToast().success("Réglement  Ajouter", {
        position: "bottom-right",
        duration: 3000,
      });
      isReglementAdded.value = true; 
    },
    onError: (errors) => {
      useToast().error("Veuillez remplir tout les champs", {
        position: "bottom-right",
        duration: 3000,
      });
    },
  });
};
</script>