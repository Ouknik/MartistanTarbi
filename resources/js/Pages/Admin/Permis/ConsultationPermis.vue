<template>
  <div class="modal fade bd-Permis" tabindex="-1" id="permisModal" style="display: none" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title text-white">
              {{ patient.nomPatient }} {{ patient.prenomPatient
              }}<span>
              </span>
            </h3>
          </div>
          <div class="card-body">
            <div class="col-lg-12 pt-3">
              <div class="iq-card iq-card-block iq-card-stretch iq-card-height iq-user-profile-block" style="height: 75%">
                <div class="iq-card-body">
                  <div class="user-details-block">
                    <div class="user-profile text-center">
                      <img :src="patient.sexePatient == 'Masculin'
                          ? '/images/user/14.jpg'
                          : '/images/user/02.jpg'
                        " alt="story-img" class="rounded-circle avatar-80 img-fluid" style="margin-top: -28px" />
                    </div>
                    <div class="text-center mt-3">
                      <h4>
                        <b>{{ patient.nomPatient }}
                          {{ patient.prenomPatient }}</b>
                      </h4>
                      <p>{{ age }} ans, {{ patient.villePatient }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <form @submit.prevent="submit">
                <div class="row">
                  <div class="col-lg-12">
                    <h4>Générer un numéro de dossier</h4>
                    <input class="form-control" type="text" v-model="props.permisDossierNumber"
                      placeholder="Dossier Number" disabled />
                  </div>
                </div>
                <hr />
                <div class="row">
                  <div class="form-group col-md-6 col-lg-6">
                    <label class="control-label align-self-center mb-1" for="exampleInputdate">
                      Date Visite:
                    </label>
                    <input type="date" class="form-control" id="exampleInputdate"  v-model="form.dateVisite" />
                  </div>
                  <div class="form-group col-md-6 col-lg-6">
                    <label class="control-label align-self-center mb-1" for="exampleInputmontant">Montant A Payer
                    </label>
                    <input type="text" class="form-control" id="exampleInputmontant" v-model="form.montantAPayer" />
                  </div>
                </div>
                <hr />
              </form>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" @click="submit" class="btn mb-3 btn-primary">
              <i class="ri-bill-fill"></i>Ajouter
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";

const props = defineProps({
  patient: Object,
  docteur: Object,
  age: Number,
  permisDossierNumber: String,
});

const form = useForm({
  code: props.permisDossierNumber,
  nom: props.patient.nomPatient,
  prenom: props.patient.prenomPatient,
  dateNaissance: props.patient.dateNaissancePatient,
  genre: props.patient.sexePatient,
  montantAPayer: 0,
  dateVisite: '',
  patient_id: props.patient.id,
});

const submit = () => {
  router.visit("/permis", {
    method: "post",
    data: form,
    preserveState: true,
    preserveScroll: true,
    errorBag: null,
    forceFormData: true,
    onProgress: (progress) => { },
    onSuccess: (page) => {
      useToast().success("Patient a été Bien Ajouter", {
        position: "bottom-right",
        duration: 3000,

      });
      $('#permisModal').modal('hide');
    },
    onError: (errors) => {
      useToast().error("Les champs Nom et Prénom sont Obligatoire !", {
        position: "bottom-right",
        duration: 4000,
      });
    },
  });
};
</script>
