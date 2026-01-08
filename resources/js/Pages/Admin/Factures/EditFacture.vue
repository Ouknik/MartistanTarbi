<template>
    <div class="modal fade bd-EditFacture-modal-lg" id="updateFacture" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white">
                        Modifier Facture
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" v-if="facture">
                    <!-- <table border="1" style="width: 100%; color: black;">

                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>Désignation</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody v-if="facture" class="text-center">

                            <tr v-for="(soin, index) in JSON.parse(facture.soins)" :key="index">
                                <td class="center">{{ index + 1 }}</td>
                                <td> {{ soin.libelleSoin }}</td>
                                <td class="center text-center"> {{ soin.montantSoin + " DH" }}</td>
                            </tr>

                            <tr>
                                <td colspan="2" class="text-start font-weight-bold center">Total </td>
                                <td class="center font-weight-bold">{{ facture.montantFacture + " DH" }}</td>
                            </tr>

                        </tbody>
                    </table> -->
                    <EasyDataTable :items="soins" :headers="headerSoins" :search="searchValueSoin" :fields="searchFieldSoin"
                        v-model:items-selected="itemsSelectedSoinFacture" :select-all="false"
                        table-class-name="customize-table" alternating>
                        <template #header-libelleSoin="header">
                            <div class="mb-4">
                                <i class="ri-calendar-2-line"></i>
                                {{ header.text }}
                            </div>

                        </template>
                        <template #header-montantSoin="header">
                            <div class="mb-4">
                                <i class="ri-contacts-book-line"></i>

                                {{ header.text }}
                            </div>

                        </template>

                    </EasyDataTable>
                    <div class="row">
                        <div class="col-lg-4 mt-3" v-for="(items, index) in itemsSelectedSoinFacture" :key="index">
                            <label>{{ items.libelleSoin }}</label>
                            <input type="text" class="form-control" v-model="items.montantSoin" id="validationSoin02"
                                disabled />
                        </div>

                    </div>

                    <div class="col-lg-12 mt-4">
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6">
                                <label for="validationSoin04">Montant Total</label>
                                <input type="text" class="form-control col-md-12 text-white" id="validationSoin04"
                                    v-model="soinsFacture.total" disabled required
                                    style="background-color:#089bab;font-weight: 600;" />
                            </div>

                            <div class="form-group col-md-6 col-lg-6" hidden>
                                <label for="validationSoin04">Montant a Payer</label>
                                <input type="text" class="form-control col-md-12" id="validationSoin04"
                                    v-model="soinsFacture.montantApayer" />

                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" @click="updateFacture($props.facture)" class="btn btn-danger">Modifier</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useForm, router, Link } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import { ref, computed, watch } from "vue";
import EasyDataTable from "vue3-easy-data-table";
const itemsSelectedSoinFacture = ref([]);
const searchFieldSoin = ref(["libelleSoin", "montantSoin"]);
const searchValueSoin = ref("");

const props = defineProps({
    patient: Object,
    facture: Object,
    soins: Object
})


const headerSoins = [
    { text: "Soin", value: "libelleSoin", sortable: true },
    { text: "Montant", value: "montantSoin", sortable: true },
];


const soinsFacture = useForm({
    total: 0,
    montantApayer: "",
    soins: itemsSelectedSoinFacture,
});
const soins = ref(
    Array.isArray(props.soins)
        ? props.soins.map((soin) => ({ ...soin, selected: false }))
        : []
);

watch(itemsSelectedSoinFacture, (newItemsSelected) => {
    soins.value.forEach((soin) => {
        if (newItemsSelected.includes(soin)) {
            soin.selected = true;
        } else {
            soin.selected = false;
        }
    });
});

const totalSoin = computed(() => {
    return itemsSelectedSoinFacture.value.reduce((total, item) => total + parseInt(item.montantSoin), 0);
});


watch(totalSoin, (newTotal) => {
    soinsFacture.total = newTotal;
});


const updateFacture = (facture) => {
    router.visit(`/factures/${facture.id}`, {
        method: "put",
        data: soinsFacture,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Patient Modifier', { position: 'bottom-right', duration: 3000 });
            $('#updateFacture').modal('hide');
        },
    })
}
</script>

<style scoped>
.customize-table {
    --easy-table-header-height: 16px;
    --easy-table-header-item-padding: 0px 60px;
    --easy-table-header-font-size: 16px;
    --easy-table-header-font-color: #010101;
    --easy-table-body-row-font-size: 16px;

}
</style>