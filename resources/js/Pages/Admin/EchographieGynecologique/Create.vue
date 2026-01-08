<template>
    <p hidden>{{ (EchographieGynecologique.patient = patient) }} {{ EchographieGynecologique.consultation_id=
    idConsultation }}</p>
    <div>
        <div class="modal fade bd-EchographieGynecologique-modal-xl" tabindex="-1" id="EchographieGynecologique"
            role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form @submit.prevent="submit">
                        <div class="modal-header bg-secondary">
                            <h5 class="modal-title text-white">Echographie Gynecologique</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>ghjghj
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <!-- code -->
                            {{ nomEho }}

                            <!-- end code -->
                            <div id="printable-content" style="width: 1070px;">


                                <textarea id="editor"></textarea>
                            </div>
                            <div class="footer-cer">
                            </div>
                            <div class="text-left">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button style="font-size: 20px" @click="printInvoice2()" type="button"
                                class="btn btn-outline-primary mt-3">
                                <i class="ri-printer-line"></i>Imprimer
                            </button>
                            <button style="font-size: 20px" type="submit" class="btn mt-3 btn-primary ml-4">
                                <i class="ri-bill-fill"></i>Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import printJS from 'print-js';
// import Storage from 'laravel-file-storage'; // Importez Storage de Laravel
import axios from 'axios';

import { ref, onMounted } from 'vue';

const props = defineProps({
    patient: Object,
    Echographies: Object,
    age: Number,
    gestationnelle: Object,
    idConsultation: Number,
    content:String,
    nomEho:String
});

const EchographieGynecologique = useForm({
    typeEcho: 'Echographie Gynecologique',
    contenu: '',
    patient: '',
    dateEcho: '',
    consultation_id: ''
});

const date = ref('');
const fetchedContent = ref({});
const submit = () => {
    if (props.idConsultation == 0) {
        useToast().error('Veuillez Choisir une consultation ', { position: 'bottom-right', duration: 3000 });
        return false;
    }

    router.visit('/Echographies', {
        method: 'post',
        data: EchographieGynecologique,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Echographie Debut Grossesse Bien Ajouter avec ', { position: 'bottom-right', duration: 3000 });
            $('#EchographieGynecologique').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
};

// new code fetch echo html
const fetchContent = async (identifier) => {
    try {
        const response = await fetch(`/storage/${identifier}.html`);
        if (!response.ok) {
            throw new Error('File not found');
        }
        const content = await response.text();
        fetchedContent.value[identifier] = content;
    } catch (error) {
        console.error('Error fetching file:', error.message);
    }
};

onMounted(() => {
    props.Echographies.flat().forEach((echographie) => {
        if (echographie.contenuEcho) {
            fetchContent(echographie.contenuEcho);
        }
    });
});
// 

let editor = null;
// let initialText = props.content;


onMounted(() => {
    if (props.patient) {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo', '-', '|'
                    ],
                    shouldNotGroupWhenFull: true
                },
            })
            .then(createdEditor => {
                if(props.content){
                    createdEditor.setData(props.content);
                }
               
                editor = createdEditor;

                editor.model.document.on('change:data', () => {
                    // const contenuDiv = document.getElementById('contenu');
                    EchographieGynecologique.contenu = editor.getData();
                    // contenuDiv.innerHTML = editor.getData();
                });
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    }
    {/* <h3>${EchographieGynecologique.dateEcho}</h3>
    <h3>${props.patient.civilitePatient} ${props.patient.nomPatient} ${props.patient.prenomPatient}</h3> */}
    const today = new Date();
    const dateParts = today.toJSON().slice(0, 10).split('-');
    EchographieGynecologique.dateEcho = `${dateParts[0]}-${dateParts[1]}-${dateParts[2]}`;
    // initialText = props.content;


});
const printInvoice = () => {
    const printableElement1 = editor.getData();
    // const printableElement = document.getElementById('contenu');
    printableElement1.classList.add('printable-print');
    printJS({
        printable: 'contenu',
        type: 'html',
        targetStyles: ['*']
    });
    setTimeout(() => {
        printableElement1.classList.remove('printable-print');
    }, 1000);
};
const printInvoice2 = () => {
    let printContents = editor.getData();
    let mywindow = window.frames["print_frame"];
    mywindow.document.body.innerHTML = `
            <style>
                body  {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 110px;
                    padding : 10px;
                }
                
                .titre{
                    text-align:center;
                    font-size: 9px;
                    color:red;
                }
                #printable-content{
                    color:yellow;
                }
            </style>
            <div class="print-container">` + printContents + `</div>`;

    mywindow.focus();
    mywindow.print();
}
</script>

<style>
@media print {
    .titre {
        font-size: 90px;
    }
}
.custom-margin-left {
    margin-left: 50px;
}
.custom-table tr {
    border-top: none;
    /* Removes the top border */
}
</style>
  





