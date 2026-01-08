<template>
  <span hidden>{{ operation.patient_id=currentPatient }}</span>
  <div class="modal fade bd-GestionRendezVous-modal-lg" tabindex="-1" role="dialog" ref="GestionOperationModal"
    id="ModalAddOperation">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="background-color: #eff7f8">
        <div class="modal-header modal-operation">
          <h5 class="modal-title text-white">Ajouter Operation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="p-2">
            <form @submit.prevent="submit">
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="cinPatient">CIN Patient :</label>
                    <input type="text" id="cinPatient" class="form-control" disabled :value="currentPatient.cinPatient" />
                  </div>
                  <!-- <div v-for="patient in selectedPatient" :key="patient.id"> -->
                  <div class="form-group">
                    <label for="nomP">Nom :</label>
                    <input type="text" id="nomP" class="form-control" disabled :value="currentPatient.nomPatient" />
                  </div>
                  <div class="form-group">
                    <label for="dateNaissance">Prénom :</label>
                    <input type="text" id="dateNaissance" class="form-control" disabled
                      :value="currentPatient.prenomPatient" />
                  </div>
                  <!-- </div> -->
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="dateOperation">Date de l'opération :</label>
                    <input type="date" id="dateOperation" class="form-control" v-model="operation.dateOperation" />
                  </div>
                  <div class="form-group">
                    <label for="clinique">Clinique </label>
                    <select name="clinique" class="form-control" id="clinique" v-model="operation.clinique">
                      <option v-for="(clinique, index) in cliniques" :value="clinique.id" v-bind:key="index">
                        {{ clinique.nomClinique }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="prixOperation">Prix de l'opération :</label>
                    <input type="text" id="prixOperation" class="form-control" v-model="operation.prixOperation" />
                  </div>
                </div>
                <div class="col-lg-4">
                  <label class="control-label align-self-center mb-1"><span class="text-danger font-size-16">*
                    </span>Type Operations:</label>
                  <select class="form-control" id="statutPatient" v-model="operation.typeOperation">
                    <option v-for="typeOperation in typeOperations" :value="typeOperation.typeOperation" v-bind:key="typeOperation.id">
                      {{ typeOperation.typeOperation }}
                    </option>
                  </select>
                  <div class="form-group">
                    <label for="descriptionOperation">Description opération</label>
                    <textarea class="form-control" id="descriptionOperation" rows="3"
                      v-model="operation.descriptionOperation"></textarea>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button @click="AJouter" type="submit" style="font-size: 16px" class="btn modal-operation text-white">
            Ajouter Operation
          </button>
          <button type="button" style="font-size: 16px" class="btn btn-danger" data-dismiss="modal">
            Fermer
          </button>
        </div>
      </div>
    </div>
  </div>
</template>




<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import { ref, computed } from "vue";

const props = defineProps({
  cliniques: Object,
  currentPatient: Object,
  cliniques: Object,
  typeOperations: Object
});

const operation = useForm({
  dateOperation: "",
  prixOperation: "",
  MontantValideeOperation: "0",
  MontantRestantOperation: "0",
  typeOperation: "",
  descriptionOperation: "",
  clinique: "",
  etatOperation: "Programmer",
  patient_id: "",
});

const AJouter = () => {
  // if (operation.prixOperation && isNaN(operation.prixOperation)) {
  //   useToast().error("Le prix de l'opération doit être un nombre.", {
  //     position: "bottom-right",
  //     duration: 3000,
  //   });
  //   return;
  // }
  const requiredFields = ["patient_id", "dateOperation", "clinique"];
  const emptyFields = requiredFields.filter((field) => !operation[field]);

  if (emptyFields.length > 0) {
    const errorMessage = emptyFields
      .map((field) => getFieldErrorMessage(field))
      .join(" ");
    useToast().error(errorMessage, {
      position: "bottom-right",
      duration: 3000,
    });
    return;
  } else {
    router.visit("/operations", {
      method: "post",
      data: operation,
      preserveState: true,
      preserveScroll: true,
      errorBag: null,
      forceFormData: true,
      onProgress: (progress) => { },
      onSuccess: (page) => {
        useToast().success("Opération Bien Ajouter", {
          position: "bottom-right",
          duration: 4000,
        });
        operation.dateOperation = "";
        operation.prixOperation = "";
        (operation.descriptionOperation = ""),
          (operation.typeOperation = ""),
          $("#ModalAddOperation").modal("hide");
      },
      onError: (errors) => {
        useToast().error("Veuillez remplir tout les champs", {
          position: "bottom-right",
          duration: 3000,
        });
      },
    });
  }
};
const getFieldErrorMessage = (fieldName) => {
  const errorMessages = {
    patient_id: "CIN Patient est obligatoire.",
    dateOperation: "Date de l'opération est obligatoire.",
    clinique: "Clinique est obligatoire.",
  };

  return errorMessages[fieldName] || "Ce champ est obligatoire.";
};
</script>

<style>
.medicament-list {
  max-height: 150px;
  width: 500px;
  overflow-y: auto;
  position: relative;
  z-index: 10;
}
</style>
