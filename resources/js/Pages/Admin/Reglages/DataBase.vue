<template>
  <form @submit.prevent="submit">
    <div class="col-lg-6">
      <div class="iq-card border">
        <div class="iq-card-header bg-primary d-flex justify-content-between">
          <div class="iq-header-title">
            <h4 class="card-title text-white">Exporter une Base de Données</h4>
          </div>
        </div>
        <div class="iq-card-body">
          <div class="row">
            <div class="col-lg-12 text-center">
              <label>La base de données sera exporter sur votre bureau.</label>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 text-center">
              <button type="submit" class="btn btn-primary" style="width: 200px;"
                @click="exportDatabase">Exporter</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>
<script setup>
import { useForm, router, Link } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
const submit = () => {
  router.visit('/export-database', {
    method: 'post',
    preserveState: true,
    preserveScroll: true,
    errorBag: null,
    forceFormData: true,
    onProgress: progress => { },
    onSuccess: page => {
      useToast().success('Base De Données Exporter Sur  Bureau Avec Succées', { position: 'bottom-right', duration: 5000 });
    },
    onError: errors => { useToast().error('Une Erreur s\'est produite lors de la sauvegarde !!', { position: 'bottom-right', duration: 5000 }); },
  });
};
</script>
