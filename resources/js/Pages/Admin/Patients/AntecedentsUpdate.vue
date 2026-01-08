<template>
  
                   
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-header d-flex justify-content-between color-template">
                                <div class="iq-header-title">
                                    <h3 class="text-white card-title"
                                        style="font-size: 20px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                                        Antecedants</h3>
                                </div>
                            </div>
                            <div class="iq-card-body scroller">
                                <!-- {{ antecedentsPatientData }}
                                <span class="text-danger">hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</span>
                                {{ antecedentsPatient }} -->
                                <div class="chat-sidebar-channel scroller">
                                    <div class="row ">
                                        <button @click="updateAntecedants()" type="button" class="btn btn-primary ml-4"
                                            data-toggle="modal" v-if="props.antecedentsPatientData != 0">
                                            <i class="ri-user-settings-fill"></i>Modifier Informations
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12"
                                            v-for="(antecedent, index) in antecedentsPatientData" v-bind:key="antecedent.id">

                                            <div
                                                class="m-2 mt-3 custom-control custom-switch custom-switch-text custom-switch-color">
                                                <h6 for="nomAntecedent" class="ml-4" style="color: blueviolet;">
                                                    {{ antecedent.nomAntecedent }}
                                                </h6>

                                                <div v-if="antecedent.typeAntecedent == 'true'">
                                                    <p hidden>
                                                        {{
                                                            antecedent.pivot.valeurAntecedent == 1
                                                            ? (antecedent.pivot.valeurAntecedent = true)
                                                            : (antecedent.pivot.valeurAntecedent = false)
                                                        }}
                                                    </p>
                                                    <input type="checkbox" class="custom-control-input bg-danger"
                                                        :id="antecedent.id" v-model="antecedent.pivot.valeurAntecedent"
                                                        @change="antecedent.pivot.valeurAntecedent = $event.target.checked" />
                                                    <label class="pl-5 ml-4 custom-control-label" :for="antecedent.id"
                                                        data-on-label="OUI" data-off-label="NON"></label>
                                                </div>
                                                <input v-else-if="antecedent.typeAntecedent == 'valeur'" type="text"
                                                    class="ml-3 form-control text-dark font-weight-bold"
                                                    style="width: 170px; height: 35px; background-color:  #aabdc8;"
                                                    :id="antecedent.id" v-model="antecedent.pivot.valeurAntecedent" />


                                                <div v-else-if="antecedent.typeAntecedent == 'text'" class="col">
                                                    <textarea style="width: 100%;" rows="5" :id="antecedent + index"
                                                        v-model="antecedent.pivot.valeurAntecedent">hiiii

                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  
                    
              
</template>
<script setup>
import {  router } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import { ref, onMounted,watch } from "vue";

const props = defineProps({
   
    antecedentsPatientData: Object,
   
});
let antecedentsPatientData = ref(props.antecedentsPatientData);

watch(() => props.antecedentsPatientData, (newValue, oldValue) => {
    antecedentsPatientData.value = newValue;
});

// onMounted(() => {
  
//     window.Echo.channel('antecedent-patient').listen('Antecedent', (e) => {
//         antecedentsPatientData.value = e.antecedentData;

//     });
// });
const updateAntecedants = () => {
    router.visit(`/AntecedentsUpdate`, {
        method: 'POST',
        data: antecedentsPatientData.value,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Antecedents Bien  Modifier', { position: 'bottom-right', duration: 3000 });
            $('#updatePatient').modal('hide');
        },
    })
}

</script>