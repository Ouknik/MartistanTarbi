<template>
  <div class="mt-3 mb-0 row">
    <label
      for="html5-search-input"
      class="col-lg-0 col-form-label ml-4 mb-3 mt-2"
      >Recherche :</label
    >
    <div class="col-lg-5">
      <input
        class="form-control mt-2"
        type="search"
        id="html5-search-input"
        v-model="searchValue"
      />
    </div>
    <!-- dropdown filter -->
    <div class="col-lg-2 ml-3 mt-3">
            <img
              src="../../../../../public/images/icon/filter.png"
              class="filter-icon"
              style="width: 20px; height: 20px"
            />
            <span class="font-size-16 ml-2">Filtrer Par Clinique</span>
       
    </div>
    <div class="col-lg-4">
          <!-- <label for="select2Icons" class="form-label">Filter</label> -->
          <div class="col-form-label">
            <select
              class="form-control form-control-md "
              v-model="listClinique"
              name="favouriteSport"
            >
              <option value="all">Tout Les Cliniques</option>
              <option
                v-for="clinique in $page.props.cliniques"
                :key="clinique.id"
                :value="clinique.nomClinique"
              >
                {{ clinique.nomClinique }}
              </option>
            </select>
          </div>

        </div>
   
  </div>
  <!-- end filter -->
  <div class="row">
    <div class="col-lg-12 p-4">
      <EasyDataTable
        buttons-pagination
        :items="items"
        :headers="headers"
        :filter-options="filterOptions"
        :search-value="searchValue"
        :search-field="searchField"
        :rows-per-page="4"
        alternating
        table-class-name="customize-table"
      >
        <template #empty-message>
          <a href="">Aucune opération pour cette journée</a>
        </template>
        <template #item-etatOperation="item">
          <span class="text-primary">{{ item.etatOperation }}</span>
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
        <!-- <template #item-nomClinique="item">
          {{ item.clinique.nomClinique }}
        </template> -->
        <template #item-prixOperation="item">
          {{ item.prixOperation + " DH" }}
        </template>
        <template #item-MontantValideeOperation="item">
          {{ item.MontantValideeOperation + " DH" }}
        </template>
        <!-- etat operation  -->
        <template #item-nomClinique="item">
          <div class="dropdown">
            <button
              class="btn dropdown-toggle fixed-width-btn"
              :class="getStatusClass(item.clinique.nomClinique)"
              type="button"
              id="statusDropdown"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ item.clinique.nomClinique }}
            </button>
          </div>
        </template>
        <!-- end -->
        <template #header-nomClinique="header">
          <div class="filter-column">
            <img
              src="../../../../../public/images/icon/filter.png"
              class="filter-icon"
              style="height: 20px; width: 20px"
              @click.stop="
                showFavouriteCliniqueFilter =!showFavouriteCliniqueFilter
              "
            />
            {{ header.text }}
            <div
              class="filter-menu filter-sport-menu"
              v-if="showFavouriteCliniqueFilter"
            >
              <select
                class="select2-icons form-select"
                v-model="listClinique"
                name="favouriteClinique"
              >
                <option value="all">all</option>
                <!-- <option value="Maimona">Maimona</option> -->
                <option
                  v-for="clinique in $page.props.cliniques"
                  :key="clinique.id"
                  :value="clinique.nomClinique"
                >
                  {{ clinique.nomClinique }}
                </option>
              </select>
            </div>
          </div>
        </template>
        <template #header-typeAssurance="header">
          <div class="filter-column">
            <img
              src="../../../../../public/images/icon/filter.png"
              class="filter-icon"
              style="height: 20px; width: 20px"
              @click.stop="showtypeAssuranceFilter = !showtypeAssuranceFilter"
            />
            {{ header.text }}
            <div
              class="filter-menu filter-typeAssurance-menu"
              v-if="showtypeAssuranceFilter"
            >
              <input v-model="assuranceTyp" class="" />
            </div>
          </div>
        </template>
      </EasyDataTable>
    </div>
  </div>
</template>
<script setup>
import EasyDataTable from "vue3-easy-data-table";
import { useToast } from "vue-toast-notification";
import { ref, computed } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";

const searchValue = ref("");
const currentOperation = ref(null);
const searchField = ref([
  "nomOperation",
  "patient.nomPatient",
  "patient.prenomPatient",
  "patient.cinPatient",
  "clinique.nomClinique",
  "prixOperation",
]);
const showFavouriteCliniqueFilter = ref(false);
const showtypeAssuranceFilter = ref(false);
const newRendezVousDate = ref(new Date());
const UpdateOperationModal = ref(null);
const props = defineProps({
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
  { text: "Type", value: "nomOperation", sortable: true },
  { text: "Clinique", value: "nomClinique", sortable: true },
  { text: "Etat", value: "etatOperation", sortable: true },
];

const statusColorMap = {};
const getStatusClass = (status) => {
  if (!statusColorMap[status]) {
    statusColorMap[status] = `btn-${getRandomColor()}`;
  }
  return statusColorMap[status];
};

function getRandomColor() {
  const colors = ["success", "danger", "warning", "info","secondary","primary"];
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
    forceFormData: false,
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
</script>
<script>
export default {
  data() {
    return {
      showModal: null,
      modalTitle: "My Modal",
      modalCloseButton: "Close",
      modalSaveButton: "Save",
      locale: "",

      currentPatient: null,
      newRendezVousDate: new Date(),
    };
  },
  methods: {},
};
</script>
<style>
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
