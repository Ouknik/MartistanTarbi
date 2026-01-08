<template>
  <div class="mt-3 mb-0 row">
    <label for="html5-search-input" class="col-lg-0 col-form-label ml-4 mb-3 mt-2">Recherche :</label>
    <div class="col-lg-5">
      <input class="form-control mt-2" type="search" id="html5-search-input" v-model="searchValue" />
    </div>
    <!-- dropdown filter -->
    <div class="col-lg-2 ml-3 mt-3">
      <img src="../../../../../public/images/icon/filter.png" class="filter-icon" style="width: 20px; height: 20px" />
      <span class="font-size-16 ml-2">Filtrer Par Clinique</span>

    </div>
    <div class="col-lg-4">
      <!-- <label for="select2Icons" class="form-label">Filter</label> -->
      <div class="col-form-label">
        <select class="form-control form-control-md " v-model="listClinique" name="favouriteSport">
          <option value="all">Tout Les Cliniques</option>
          <option v-for="clinique in $page.props.cliniques" :key="clinique.id" :value="clinique.nomClinique">
            {{ clinique.nomClinique }}
          </option>
        </select>
      </div>

    </div>

  </div>
  <div class="col-lg-12 p-4">
    <EasyDataTable buttons-pagination :items="items" :headers="headers" :filter-options="filterOptions"
      :search-value="searchValue" :search-field="searchField" :rows-per-page="10" alternating
      table-class-name="customize-table">
      <template #empty-message>
        <a href="">Aucune opération</a>
      </template>
      <template #item-cinPatient="item">
        {{ item.patient.cinPatient }}
      </template>
      <template #item-nomPatient="item">
        {{ item.patient.nomPatient }}
      </template>
      <template #item-prenomPatient="item">
        {{ item.patient.prenomPatient }}
      </template>
      <template #item-typeAssurance="item">
        {{ item.patient.assurance.typeAssurance }}
      </template>
      <template #item-prixOperation="item">
        <span v-if="item.prixOperation != null">
          {{ item.prixOperation + " DH" }}
        </span>
        <span v-else>
          Non Spécifié
        </span>

      </template>
      <template #item-Operation="item">
        <button type="button" class="btn m-2" style="background-color: #ceebee"
          @click.prevent="openUpdateOperationModal(item)">
          <i class="ri-file-edit-fill"></i>
        </button>
        <button type="button" class="btn m-2" style="background-color: #d9130f" @click.prevent="deleteOperation(item)">
          <i class="ri-delete-bin-2-fill text-white"></i>
        </button>
      </template>

      <!-- etat operation  -->
      <template #item-etatOperation="item">
        <div class="dropdown">
          <button class="btn  fixed-width-btn" :class="getStatusClassBtn(item.etatOperation)" type="button"
            id="statusDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ item.etatOperation }}
          </button>
        </div>
      </template>
      <template #item-nomClinique="item">

        {{ item.clinique.nomClinique }}
      </template>

      <template #expand="item">
        <div style="padding: 15px;font-size: 20px;">
          <ul>
            <li>
              <span>Clinique :</span> {{ item.clinique.nomClinique }}
            </li>
            <li>
              <span>Type :</span> {{ item.nomOperation }}
            </li>
            <li>
              <span>Description : </span>{{ item.descriptionOperation }}
            </li>
          </ul>

        </div>
      </template>
      <template #header-nomClinique="header">
        <div class="filter-column">
          <img src="../../../../../public/images/icon/filter.png" class="filter-icon" style="height: 20px; width: 20px"
            @click.stop="
              showFavouriteCliniqueFilter = !showFavouriteCliniqueFilter
              " />
          {{ header.text }}
          <div class="filter-menu filter-sport-menu" v-if="showFavouriteCliniqueFilter">
            <select class="select2-icons form-select" v-model="listClinique" name="favouriteClinique">
              <option value="all">all</option>
              <!-- <option value="Maimona">Maimona</option> -->
              <option v-for="clinique in $page.props.cliniques" :key="clinique.id" :value="clinique.nomClinique">
                {{ clinique.nomClinique }}
              </option>
            </select>
          </div>
        </div>
      </template>
      <!-- <template #header-typeAssurance="header">
        <div class="filter-column">
          <img src="../../../../../public/images/icon/filter.png" class="filter-icon" style="height: 20px; width: 20px"
            @click.stop="showtypeAssuranceFilter = !showtypeAssuranceFilter" />
          {{ header.text }}
          <div class="filter-menu filter-typeAssurance-menu" v-if="showtypeAssuranceFilter">
            <input v-model="assuranceTyp" class="" />
          </div>
        </div>
      </template> -->
      <!-- end -->
    </EasyDataTable>
  </div>

  <div v-if="currentOperation" class="modal-overlay"></div>
  <div class="modal" tabindex="-1" role="dialog" ref="UpdateOperationModal" id="updateOperation">
    <form @submit.prevent="submit">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #eff7f8">
          <div class="modal-header" style="background-color: #ceebee" v-if="currentOperation">
            <h5 class="modal-title text-black">
              Modifier Opération :
              {{
                currentOperation.patient.nomPatient +
                " " +
                currentOperation.patient.prenomPatient
              }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
              @click="closeUpdateOperationModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row" v-if="currentOperation">
              <div class="col-md-4 col-lg-6">
                <label class="control-label align-self-center mb-1"><span style="color: red; font-size: 1.5em">*
                  </span><span style="font-size: 18px; color: black; font-weight: bold">Etat Opération :</span></label>
                <select name="assurance_id" v-model="currentOperation.etatOperation" class="form-control bg-white"
                  id="assurance_id" required>
                  <option value="Validée">Validée</option>
                  <option value="Annuler">Annulée</option>
                  <option value="Reporter">Reporter</option>
                  <option value="Programmer">Programmer</option>
                </select>
              </div>
              <div class="col-lg-6" style="font-size: 15px; color: black; font-weight: bold">
                <div class="form-group">
                  <label class="control-label align-self-center mb-1"><span style="color: red; font-size: 1.5em">*
                    </span><span style="font-size: 18px; color: black; font-weight: bold">Montant Payé :</span></label>
                  <input type="text" v-model="currentOperation.MontantValideeOperation" class="form-control bg-white"
                    id="exampleInputText1" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6" v-if="currentOperation" style="font-size: 15px; color: black; font-weight: bold">
                <div class="form-group">
                  <label for="exampleInputText1">Opération </label>
                  <input type="text" class="form-control bg-white" id="exampleInputText1"
                    v-model="currentOperation.nomOperation" placeholder="Enter Name" />
                </div>
              </div>
              <div class="col-lg-6" v-if="currentOperation" style="font-size: 15px; color: black; font-weight: bold">
                <div class="form-group">
                  <label for="exampleInputText1">Prix Opération </label>
                  <input type="text" class="form-control bg-white" id="exampleInputText1"
                    v-model="currentOperation.prixOperation" placeholder="Enter Name" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6" v-if="currentOperation" style="font-size: 15px; color: black; font-weight: bold">
                <div class="form-group">
                  <label for="exampleInputdate">Date </label>
                  <input type="date" class="form-control bg-white" id="exampleInputdate"
                    v-model="currentOperation.dateOperation" />
                </div>
              </div>
              <div class="col-lg-6" v-if="currentOperation" style="font-size: 15px; color: black; font-weight: bold">
                <div class="form-group">
                  <label for="exampleInputText1">Clinique </label>
                  <select name="assurance_id" class="form-control" id="assurance_id"
                    v-model="currentOperation.clinique_id">
                    <option v-for="(clinique, index) in cliniques" :value="clinique.id" v-bind:key="index">
                      {{ clinique.nomClinique }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row" v-if="currentOperation">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description de l'opération :
                  </label>

                  <textarea class="form-control bg-white" id="exampleFormControlTextarea1"
                    v-model="currentOperation.descriptionOperation" rows="2">
                  </textarea>
                </div>
              </div>
            </div>
            <div class="row m-4">
              <div class="col-lg-12">

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" @click="UpdateOperation(currentOperation)"
              style="font-size: 16px; background-color: #ceebee" class="btn btn-primary text-white">
              OK
            </button>
            <button type="button" style="font-size: 16px" class="btn btn-secondary" data-dismiss="modal"
              @click="closeUpdateOperationModal">
              Annuler
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { useToast } from "vue-toast-notification";
import { ref, computed } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";

const searchValue = ref("");
const currentOperation = ref(null);
const searchField = ref(["nomOperation",
  "patient.nomPatient",
  "patient.prenomPatient",
  "patient.cinPatient",
  "clinique.nomClinique",
  "prixOperation",]);
const newRendezVousDate = ref(new Date());
const UpdateOperationModal = ref(null);
const props = defineProps({
  patients: Object,
  ProchaineOperations: Object,
  items: Object,
  cliniques: Object,
  operations: Object,
});


const listClinique = ref("all");
const assuranceTyp = ref('');

const filterOptions = computed(() => {
  const filterOptionsArray = [];
  if (listClinique.value !== "all") {
    filterOptionsArray.push({
      field: "clinique.nomClinique",
      comparison: "=",
      criteria: listClinique.value,
    });
  }
  // Filter By assurance
  if (assuranceTyp.value) {
    filterOptionsArray.push({
      field: "patient.assurance.typeAssurance",
      comparison: "=",
      criteria: assuranceTyp.value,
    });
  }
  return filterOptionsArray;
});
const headers = [
  { text: "CIN", value: "cinPatient", sortable: true },
  { text: "Nom", value: "nomPatient", sortable: true },
  { text: "Prénom", value: "prenomPatient", sortable: true },
  { text: "Assurance", value: "typeAssurance", sortable: true },
  { text: "Date Opération", value: "dateOperation", sortable: true },
  { text: "Prix Operation", value: "prixOperation", sortable: true },
  { text: "Prix Payée", value: "MontantValideeOperation", sortable: true },
  { text: "Etat", value: "etatOperation", sortable: true },
  { text: "Operation", value: "Operation", sortable: true },

];
const getStatusClassBtn = (status) => {
  switch (status) {
    case "Validée":
      return "btn-success";
    case "Annuler":
      return "btn-danger";
    case "Programmer":
      return "btn-warning";
    case "Reporter":
      return "btn-info";
    default:
      return "btn-dark"; // default class if none of the above
  }
};

const statusColorMap = {};
const getStatusClass = (status) => {
  if (!statusColorMap[status]) {
    statusColorMap[status] = `btn-${getRandomColor()}`;
  }
  return statusColorMap[status];
};

function getRandomColor() {
  const colors = ["success", "danger", "warning", "info", "secondary", "primary"];
  const randomIndex = Math.floor(Math.random() * colors.length);
  return colors[randomIndex];
}



const openUpdateOperationModal = (item) => {
  currentOperation.value = item;
  UpdateOperationModal.value.style.display = "block";
};

const closeUpdateOperationModal = () => {
  UpdateOperationModal.value.style.display = "none";
  currentOperation.value = null;
};

const UpdateOperation = (operation) => {
  router.visit(`/operations/${operation.id}`, {
    method: "PUT",
    data: operation,
    preserveState: true,
    preserveScroll: true,
    errorBag: null,
    preserveState: true,
    preserveScroll: true,
    onSuccess: (page) => {
      useToast().success("Opération Modifier", {
        position: "bottom-right",
        duration: 3000,
      });
      closeUpdateOperationModal();
    },
  });
};

const deleteOperation = (operationPatient) => {
  router.delete(`/operations/${operationPatient.id}`, {
    preserveState: true,
    preserveScroll: true,
    data: operationPatient,
    onProgress: (progress) => { },
    onSuccess: (page) => {
      useToast().success("Operation Supprimer", {
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

<style scoped>
.customize-table {
  --easy-table-body-row-font-size: 11px;
  --easy-table-header-font-size: 18px;
  --easy-table-header-height: 50px;
  --easy-table-body-row-hover-background-color: #eee;
  --easy-table-body-item-padding: 10px 15px;
  --easy-table-footer-font-color: #1d5d65;
  --easy-table-footer-font-size: 14px;
  --easy-table-footer-height: 50px;
  --easy-table-body-row-font-size: 15px;
  --easy-table-body-row-font-size: 20px;

}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  z-index: 1000;
}

.modal {
  z-index: 2000;
}
</style>
