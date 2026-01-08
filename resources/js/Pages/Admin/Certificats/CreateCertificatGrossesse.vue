<template>
    <div class="modal fade" id="AddCertificatGrossesse" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Ajouter Certificat Grossesse
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="exampleInputdate">Date Certificat</label>
                                <input type="date" class="form-control my-2" id="exampleInputdate"
                                    v-model="form.dateCertificat">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Contenu</label>
                                    <textarea v-model="form.contenu" class="form-control text-dark"
                                        id="exampleFormControlTextarea1" rows="5">
                                </textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 ml-auto text-right">
                                <div class="form-group">
                                    <button type="submit" class="btn mb-3 btn-primary" style="height: 50px; width: 100px;">
                                        <i class="ri-bill-fill" :disabled="form.processing"></i>Ajouter
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref, computed, watchEffect } from 'vue';
import { useForm, router, Link } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';

const props = defineProps({
    patient: Object,
    docteur: Object,
    DateGrossesse: String,

});


const getTodayDate = () => {
    const today = new Date();
    const year = today.getFullYear();
    let month = today.getMonth() + 1;
    let day = today.getDate();
    month = month < 10 ? `0${month}` : month;
    day = day < 10 ? `0${day}` : day;
    return `${year}-${month}-${day}`;
};
const form = useForm({
    typeCertificat: "Certificat Grossesse",
    contenu: "",
    patient_id: props.patient.id,
    dateCertificat: getTodayDate()
})




const AGGSS = computed(() => {
    const startDate = new Date(props.DateGrossesse);
    const currentDate = new Date();
    const timeDifference = currentDate - startDate;
    const millisecondsInDay = 1000 * 60 * 60 * 24;
    const daysDifference = Math.floor(timeDifference / millisecondsInDay);
    const monthsDifference = Math.floor(daysDifference / 30);
    return monthsDifference;
});


watchEffect(() => {
    form.contenu = `Je, soussigné Dr. ${props.docteur.name} ceritife \nQue ${props.patient.civilitePatient}. ${props.patient.prenomPatient} ${props.patient.nomPatient}. est enceinte d'une Grossesse estimée Cliniquement à ${AGGSS.value} Mois.\nCertificat délivré à l'intéressée pour servir et valoir ce que de droit`;
});




const submit = () => {
    let dataToSend = { ...form };
    dataToSend.contenu = form.contenu.replace(/\n/g, '<br>');
    router.visit('/certificats', {
        method: 'post',
        data: dataToSend,
        preserveState: true,
        preserveScroll: false,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Certificat Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#AddCertificatGrossesse').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
}


</script>

