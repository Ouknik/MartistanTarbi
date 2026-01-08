<template>
    <div class="text-right pr-3">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddAnalyses">
            <i class="ri-add-fill"></i>

        </button>
    </div>
    <div class="row">
        <div class="form-group col-md-8 col-lg-4 ml-2">
            <input type="text" class="form-control" placeholder="Recherche..." id="cno" v-model="searchValue" />
        </div>
    </div>
    <EasyDataTable buttons-pagination :items="analyses" :headers="headers" :search-value="searchValue"
        :search-field="searchField" :rows-per-page="4" alternating class="p-0" table-class-name="customize-table">
        
        <template #empty-message>
            <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#AddMedicament">
                <i class="ri-add-fill"></i>
                Ajouter Familles Analyses
            </button>
        </template>

        <span>
        
        </span>
    </EasyDataTable>

</template>
<script setup>
import { ref } from "vue";
import EasyDataTable from "vue3-easy-data-table";




const props = defineProps({
    analyses: Object,
});

const searchValue = ref("");
const searchField = ref(["familleanalyse"]);

const headers = [
    { text: "Famille Analyses", value: "familleanalyse" },
    { text: "Nombre Analyses", value: "CountAnalyses" },

];



</script>
<style scoped>
.customize-table {
    --easy-table-body-row-font-size: 16px;
    --easy-table-header-font-size: 14px;
    --easy-table-body-row-hover-background-color: #089bab;
    --easy-table-body-item-padding: 10px 15px;
    --easy-table-footer-font-color: #1d5d65;
    --easy-table-footer-font-size: 14px;
    --easy-table-header-background-color: #f1f2f1;
}
</style>