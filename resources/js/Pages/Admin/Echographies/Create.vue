<template>
    <p hidden>{{ (Echographie.patient = patient) }} {{ Echographie.consultation_id=
    idConsultation }}  {{ contenuEcho = props.content }}</p>
    <div>
        <div class="modal fade bd-Echographie-modal-xl" tabindex="-1" id="Echographie" role="dialog" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form @submit.prevent="submit">
                        <div class="modal-header bg-secondary">
                            <h5 class="modal-title text-white"> {{ nomEcho }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <div id="printable-content" style="width: 1070px;">
                                <textarea id="editorCreate"></textarea>
                            </div>
                            <div class="footer-cer">
                            </div>
                            <div class="text-left">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button style="font-size: 20px" @click="printInvoice()" type="button"
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

import { ref, onMounted, watch } from 'vue';

const props = defineProps({
    patient: Object,
    idConsultation: Number,
    content: String,
    nomEcho: String
});
const contenuEcho =ref('');
const Echographie = useForm({
    typeEcho: '',
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
    Echographie.typeEcho=props.nomEcho;
    router.visit('/Echographies', {
        method: 'post',
        data: Echographie,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Echographie Debut Grossesse Bien Ajouter avec ', { position: 'bottom-right', duration: 3000 });
            $('#Echographie').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
}; 

let editor = null;
let initialText = ref(''); // initialText should be a ref

initialText.value = contenuEcho.value || '<h3>Default Content if props.content is empty</h3>';


watch(() => contenuEcho.value, (newValue) => {
    initialText.value = newValue || '<h3>Default Content if props.content22 is empty</h3>';
    if (props.patient) {
        // Check if the editor instance already exists
        if (editor) {
            // Destroy the existing editor instance
            editor.destroy().then(() => {
                // After destroying, create a new editor instance
                createEditor(newValue);
            });
        } else {
            // If no editor instance exists, create a new one
            createEditor(newValue);
        }
    }
});


function createEditor(newValue) {
    ClassicEditor
        .create(document.querySelector('#editorCreate'), {
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
            createdEditor.setData(newValue);
            editor = createdEditor;
            Echographie.contenu = editor.getData();

            editor.model.document.on('change:data', () => {
                Echographie.contenu = editor.getData();
            });
        })
        .catch(error => {
            console.error('Error during initialization of the editor', error);
        });
}

const printInvoice = () => {
    let printContents = editor.getData();
    let mywindow = window.frames["print_frame"];
    mywindow.document.body.innerHTML = `
            <style>
                body  {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 130px;
                    padding : 10px;
                }
                
                .titre{
                    text-align:center;
                    font-size: 9px;
                    color:red;
                }
               
            </style>
            <div class="print-container" >` + printContents + `</div>`;

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
  





