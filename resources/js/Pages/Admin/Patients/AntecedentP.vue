<template>
    <div>
        <div class="row">
            <div class="col-md-6" v-for="antecedent in $props.antecedents" v-bind:key="antecedent.id">
                <div class="custom-control custom-switch custom-switch-text custom-switch-color mt-3 m-2">
                    <h5 for="nomAntecedent" class="ml-4">
                        {{ antecedent.nomAntecedent }}
                    </h5>

                    <div v-if="antecedent.typeAntecedent == 'true' ||
                        antecedent.typeAntecedent == 'false'
                        ">
                        <p hidden>
                            {{
                                antecedent.valueAntecedent == 1
                                ? (antecedent.valueAntecedent = true)
                                : (antecedent.valueAntecedent = false)
                            }}
                        </p>
                        <input type="checkbox" class="custom-control-input bg-danger" :id="antecedent.id"
                            :checked="antecedent.valueAntecedent"
                            @change="antecedent.valueAntecedent = $event.target.checked" />
                        <label class="custom-control-label ml-4 pl-5" :for="antecedent.id" data-on-label="Yes"
                            data-off-label="No"></label>
                    </div>


                    <input v-else type="text" class="form-control ml-3 text-dark font-weight-bold"
                        style="width: 95px; height: 35px;" :id="antecedent.id" :value="antecedent.valueAntecedent"
                        @input="antecedent.valueAntecedent = $event.target.value" />
                    <p v-if="antecedent.typeAntecedent == 'text'">
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, router, usePage } from "@inertiajs/vue3";
import AntecedentP from "./AntecedentP.vue";
const props = defineProps({
    patient: Object,
    antecedents: Object,
});
</script>
<script>
export default {
    props: {
        patient: Object,
        antecedents: Object,
    },

    data() {
        return {
            patient: {},
            antecedents: [],

        };
    },
    methods: {

    },
};
</script>
