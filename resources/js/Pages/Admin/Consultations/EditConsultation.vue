<template>
    <div class="modal fade" id="updateConsultation" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Modifier Consultation
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-4 col-lg-3">
                                <label for="lname" class="control-label align-self-center mb-1">Motif Consultation :</label>
                                <input type="text" class="form-control" id="motifConsultation"
                                    placeholder="Motif Consultation..." v-model="$props.consultation.motifConsultation" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-lg-12">
                                <label class="control-label align-self-center mb-1"
                                    for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" id="descriptionConsultation"
                                    placeholder="Description Consultation..." rows="4"
                                    v-model="$props.consultation.descriptionConsultation"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Quitter</button>
                            <button type="submit" @click="updateConsultation(props.consultation)"
                                class="btn btn-secondary">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';

const props = defineProps({
    consultation: Object
});

const updateConsultation = (consultation) => {
    router.visit(`/consultations/${consultation.id}`, {
        method: "put",
        data: consultation,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: false,
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Consultation Modifier', { position: 'bottom-right', duration: 3000 });
            $('#updateConsultation').modal('hide');
        },
    })
}
</script>
