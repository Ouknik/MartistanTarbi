<template>
  <div class="modal fade bd-example-modal-lg p-4" id="AddAnalyses" tabindex="-1" role="dialog" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <form @submit.prevent="submit">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <h5 class="modal-title text-white">Gestion Des Analyses</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Famille Analyse</label>

                  <select class="form-control mb-3" v-model="selectedFamille" @change="onFamilleChange">
                    <option selected disabled>Selectionner Une Famille Analyse</option>
                    <option v-for="famille in data" :value="famille.id">{{ famille.familleanalyse }}</option>
                  </select>
                </div>
                <div class="iq-card iq-card-block iq-card-stretch p-3">
                  <div class="iq-card-body">
                    <ul class="iq-timeline" style="max-height: 300px; overflow-y: auto;">
                      <li v-for="famille in data" class="mt-2">
                        <button @click="deleteFamilleAnalyse(famille)" class="btn btn-danger float-left mr-2"><i
                            class="ri-close-circle-fill"></i></button>
                        <h6 class="float-left text-dark mt-2"> {{ famille.familleanalyse }}
                        </h6>
                        <div class="d-inline-block w-90">
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="row mt-3">
                    <div class="col-lg-8">
                      <input type="text" class="form-control" v-model="familleAnalyse.familleanalyse"
                        placeholder="Famille Analyse">

                    </div>
                    <div class="col-lg-4">
                      <button type="button" @click="ajouterFamilleAnalyse(familleAnalyse)"
                        class="btn btn-primary mt-1 ml-4"><i class="ri-add-circle-line"></i>Ajouter</button>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Analyse</label>
                  {{ selectedFamille }}
                  <!-- <select class="form-control mb-3" v-model="selectedAnalyse" :disabled="!selectedFamille"
                    @change="onAnalyseChange">
                    <option selected disabled>Selectionner un Analyse</option>
                    <option v-for="analyse in analysesOptions" :value="analyse.id">{{ analyse.nomAnalyse }}</option>
                  </select> -->
                </div>
                <div class="iq-card iq-card-block iq-card-stretch p-3">
                  <div class="iq-card-body">
                    <ul class="iq-timeline" style="max-height: 300px; overflow-y: auto; min-height: 300px;">
                      <!-- <li v-for="analyse in selectedFamille.Analyses" class="mt-2">
                        <button @click="deleteAnalyse(analyse)" class="btn btn-danger float-left mr-2"><i
                            class="ri-close-circle-fill"></i></button>
                        <h6 class="float-left text-dark mt-2"> {{ analyse.nomAnalyse }}
                        </h6>
                        <div class="d-inline-block w-90">
                        </div>
                      </li> -->
                    </ul>
                  </div>
                  <div class="row mt-3" v-if="selectedFamille">
                    <div class="col-lg-8">
                      <input type="text" v-model="Analyse.nomAnalyse" class="form-control" placeholder="Analyse">

                    </div>
                    <div class="col-lg-4">{{ props.analyse }}
                      <button type="button" @click="ajouterAnalyse(Analyse)" class="btn btn-primary mt-1 ml-4"><i
                          class="ri-add-circle-line"></i>Ajouter</button>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Sous Analyse</label>
                  <select class="form-control mb-3" v-model="selectedSousAnalyse" :disabled="!selectedAnalyse">
                    <option selected disabled>Selectioner un Sous Analyse</option>
                    <option v-for="sousAnalyse in sousAnalysesOptions" :value="sousAnalyse">{{ sousAnalyse.nomSousAnalyse
                    }}</option>
                  </select>
                </div>
                <div class="iq-card iq-card-block iq-card-stretch p-3">
                  <div class="iq-card-body">
                    <ul class="iq-timeline" style="max-height: 300px; min-height: 300px; overflow-y: auto;">
                      <li v-for="sousAnalyse in sousAnalysesOptions" class="mt-2">
                        <button @click="deleteSousAnalyse(sousAnalyse)" class="btn btn-danger float-left mr-2"><i
                            class="ri-close-circle-fill"></i></button>
                        <h6 class="float-left text-dark mt-2"> {{ sousAnalyse.nomSousAnalyse }}
                        </h6>
                        <div class="d-inline-block w-90">
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="row mt-3" v-if="selectedAnalyse">
                    <div class="col-lg-8">
                      <input type="text" v-model="SousAnalyse.nomSousAnalyse" class="form-control"
                        placeholder="Sous Analyse">

                    </div>
                    <div class="col-lg-4">
                      <button type="button" @click="ajouterSousAnalyse(SousAnalyse)" class="btn btn-primary mt-1 ml-4"><i
                          class="ri-add-circle-line"></i>Ajouter</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
  
<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { ref, defineProps,onMounted } from 'vue';
import { useToast } from 'vue-toast-notification';

const props = defineProps({
  data: Object,
});

const selectedFamille = ref(null);
const selectedAnalyse = ref(null);
const selectedSousAnalyse = ref(null);

const famillesOptions = ref([]);
const analysesOptions = ref([]);
const sousAnalysesOptions = ref([]);


// onMounted(() => {
//   famillesOptions.value = props.data;

// });

const onFamilleChange = () => {
  analysesOptions.value = [];
  sousAnalysesOptions.value = [];
  if (selectedFamille.value) {
    analysesOptions.value = selectedFamille.value.Analyses;
    // Analyse.famille_analyse_id = selectedFamille.value.id;
  }
};

const onAnalyseChange = () => {
  sousAnalysesOptions.value = [];
  if (selectedAnalyse.value) {
    sousAnalysesOptions.value = selectedAnalyse.value.SousAnalyses;
    SousAnalyse.analyse_id = selectedAnalyse.value.id;
  }

};



const familleAnalyse = useForm({
  familleanalyse: "",
});

const Analyse = useForm({
  nomAnalyse: '',
  famille_analyse_id: ''
});


const SousAnalyse = useForm({
  nomSousAnalyse: '',
  analyse_id: ''
});


const ajouterFamilleAnalyse = (familleAnalyse) => {

  if (familleAnalyse.familleanalyse.trim() === "") {
    useToast().error('Veuillez saisir le nom de Famille Analyse', { position: 'bottom-right', duration: 3000 });
  } else {
    router.visit('/FamilleAnalyse', {
      method: 'post',
      data: familleAnalyse,
      preserveState: true,
      preserveScroll: false,
      errorBag: null,
      forceFormData: true,
      onProgress: progress => { },
      onSuccess: page => {
        useToast().success('Famille Analyse Bien Ajouter', { position: 'bottom-right', duration: 3000 });
        // famillesOptions.value.push({ familleanalyse: familleAnalyse.familleanalyse, id: page.id });
        familleAnalyse.familleanalyse = "";
      },
      onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
  }

};


const ajouterAnalyse = (Analyse) => {
  Analyse.famille_analyse_id = selectedFamille.value.id;
  if (Analyse.nomAnalyse.trim() === "") {
    useToast().error('Veuillez saisir le nom de Analyse', { position: 'bottom-right', duration: 3000 });
  }
  else {
    // Analyse.famille_analyse_id = selectedFamille.value.id;
    router.visit('/Analyse', {
      method: 'post',
      data: Analyse,
      preserveState: true,
      preserveScroll: false,
      errorBag: null,
      forceFormData: true,
      onProgress: progress => { },
      onSuccess: page => {
        useToast().success('Analyse Bien Ajouter', { position: 'bottom-right', duration: 3000 });
        // analysesOptions.value.push({ nomAnalyse: Analyse.nomAnalyse, id: page.id });
        Analyse.nomAnalyse = "";
      },

      onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
  }

};


const ajouterSousAnalyse = (SousAnalyse) => {

  if (SousAnalyse.nomSousAnalyse.trim() === "") {
    useToast().error('Veuillez saisir le nom du Sous Analyse', { position: 'bottom-right', duration: 3000 });
  }
  else {
    SousAnalyse.analyse_id = selectedAnalyse.value.id;
    router.visit('/SousAnalyse', {
      method: 'post',
      data: SousAnalyse,
      preserveState: true,
      preserveScroll: false,
      errorBag: null,
      forceFormData: true,
      onProgress: progress => { },
      onSuccess: page => {
        useToast().success('Sous Analyse Bien Ajouter', { position: 'bottom-right', duration: 3000 });
        // sousAnalysesOptions.value.push({ nomSousAnalyse: SousAnalyse.nomSousAnalyse, id: page.id });
        SousAnalyse.nomSousAnalyse = "";
      },
      onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
  }

};


const deleteFamilleAnalyse = (familleAnalyse) => {
  router.delete(`/FamilleAnalyse/${familleAnalyse.id}`, {
    preserveState: true,
    preserveScroll: true,
    forceFormData: true,
    errorBag: null,
    forceFormData: false,
    onSuccess: page => {
      useToast().info('Famille Analyse SUpprimer', { position: 'bottom-right', duration: 3000 });
    },
    onError: (errors) => {
    },
  })

};


const deleteAnalyse = (Analyse) => {
  router.delete(`/Analyse/${Analyse.id}`, {
    preserveState: true,
    preserveScroll: true,
    forceFormData: true,
    errorBag: null,
    forceFormData: false,
    onSuccess: page => {
      useToast().info('Analyse Supprimer', { position: 'bottom-right', duration: 3000 });
    },
    onError: (errors) => {
      alert("Erreurs");
    },
  })

};


const deleteSousAnalyse = (SousAnalyse) => {
  router.delete(`/SousAnalyse/${SousAnalyse.id}`, {
    preserveState: true,
    preserveScroll: true,
    forceFormData: true,
    errorBag: null,
    forceFormData: false,
    onSuccess: page => {
      useToast().info('Sous Analyse SUpprimer', { position: 'bottom-right', duration: 3000 });
    },
    onError: (errors) => {
    },
  })

};


const getFamilleAnalyse = () => {
  router.get("/parametrage", {
    preserveState: true,
    preserveScroll: true,
  })
}

</script>
  