<template>
  <AdminLayout>
    <div class="row">
      <div class="col-lg-9">
        <HeaderStatistiquesDoctors :docteur="docteurs">
        </HeaderStatistiquesDoctors>
        <div class="col-lg-12">
        </div>
        <div class="col-lg-12">
          <div class="iq-edit-list-data">
            <div class="tab-content">
              <div
                class="tab-pane fade active show flex"
                id="liste-patients"
                role="tabpanel"
              >
                <div class="row">
                  <div class="col-lg-12">
                    <List :items="patientsPermis" :rowPerPage="10" :docteurs ="docteurs"></List>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="ajouter-patient" role="tabpanel">
                <Create />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 h-full">
        <ListAtt :patientsAtt="patientsAtt" :docteurs="docteurs"></ListAtt>
      </div>

      <!-- <CreateDocument :patient="patient"></CreateDocument> -->
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import HeaderStatistiquesDoctors from "../Statistiques/HeaderStat.vue";
import Create from "./Create.vue";
import List from "./List.vue";
import ListAtt from "../Patients/ListAtt.vue";

const props = defineProps({
  patientsPermis: Object,
  docteurs: Object,
  patientsAtt: Object,
});
</script>
