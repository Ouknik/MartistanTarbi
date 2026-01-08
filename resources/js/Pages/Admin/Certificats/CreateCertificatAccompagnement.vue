<template>
    <div class="modal fade" id="AddCertificatAccompagnement" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Ajouter Certificat Accompagnement
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
import { ref, computed, watch, onMounted, watchEffect } from 'vue';
import { useForm, router, Link } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';

const props = defineProps({
    patient: Object,
    docteur: Object,

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
    typeCertificat: "Certificat Accompagnement",
    contenu: '',
    patient_id: props.patient.id,
    dateCertificat: getTodayDate()
})


const formatDate = (date) => {
    const d = new Date(date);
    let day = '' + d.getDate();
    let month = '' + (d.getMonth() + 1);
    let year = d.getFullYear();

    if (day.length < 2)
        day = '0' + day;
    if (month.length < 2)
        month = '0' + month;

    return [day, month, year].join('-');
};

const today = formatDate(new Date());


watchEffect(() => {
    form.contenu = `Je soussigné Dr.${props.docteur.name} que \n Mr.${props.patient.conjointPatient} A accompagné sa femme ${props.patient.civilitePatient} ${props.patient.prenomPatient} ${props.patient.nomPatient} pour consultation le ${today}. \nCertificat délivré à l'intéressée pour servir et valoir ce que de droit.`;
});

const submit = () => {
    let dataToSend = { ...form };
    dataToSend.contenu = form.contenu.replace(/\n/g, '<br>');
    router.visit('/certificats', {
        method: 'post',
        data: dataToSend,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Certificat Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#AddCertificatAccompagnement').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
}

</script>

