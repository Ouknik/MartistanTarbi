<template>
    <p hidden>{{ (echographieEdit.patient = patient) }} </p>
    <div>
        <div class="modal fade bd-EchographieEdit-modal-xl" tabindex="-1" id="EchographieEdit" role="dialog"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form @submit.prevent="submit">
                        <div class="modal-header bg-secondary">
                            <h5 class="modal-title text-white">Modifier Echographie </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <div id="printable-content" style="width: 1070px;">
                                <textarea id="editorE"></textarea>
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

                            <button style="font-size: 20px" type="submit" @click="updateEchographie($props.echographieEdit)"
                                class="btn mt-3 btn-primary ml-4">
                                <i class="ri-bill-fill"></i>Modifier
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
import axios from 'axios';

import { ref, onMounted, watch } from 'vue';
import { defaultsDeep } from "lodash";


const props = defineProps({
    patient: Object,
    echographieEdit: Object,
    age: Number,

});
const date = ref('');
const fetchedContent = ref({});

const fetchContent = async (identifier) => {
    try {
        // Construct the path to the file using the patient's ID and the identifier
        const patientId = props.patient.id; // Assuming the patient ID is stored in props.patient.id
        const filePath = `Echographies/${patientId}/${identifier}.html`;

        const response = await axios.get(`/storage/${filePath}`);
        if (response.status === 200) {
            fetchedContent.value[identifier] = response.data;
            if (editor) {
                editor.setData(response.data);
            }
        } else {
            throw new Error('File not found');
        }
    } catch (error) {
        console.error('Error fetching file:', error.message);
    }
};

let editor = null;
let initialText = '';

// watch(() => {
//     if (props.echographieEdit && props.echographieEdit.contenuEcho) {
//         fetchContent(props.echographieEdit.contenuEcho)
//             .then(content => {
//                 initialText = content; 
//             })
//             .catch(error => {
//                 console.error('Error fetching content:', error.message);
//             });
//     }
// });

watch(() => props.echographieEdit.contenuEcho, (nouveauContenu) => {
    if (nouveauContenu) {
        fetchContent(nouveauContenu)
            .then(content => {
                initialText = content;
            })
            .catch(error => {
                console.error('Error fetching content:', error.message);
            });
    }
});

onMounted(() => {
    if (props.patient) {
        ClassicEditor
            .create(document.querySelector('#editorE'), {
                toolbar: {
                    items: [
                        'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo', '-'
                    ],
                    shouldNotGroupWhenFull: true
                },
            })
            .then(createdEditor => {
                createdEditor.setData(initialText);
                editor = createdEditor;

                editor.model.document.on('change:data', () => {
                    EchographieEdit.contenu = editor.getData();
                });
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    }


    const today = new Date();
    const dateParts = today.toJSON().slice(0, 10).split('-');
    EchographieEdit.dateEcho = `${dateParts[0]}-${dateParts[1]}-${dateParts[2]}`;
});

// update Echo
const updateEchographie = (echographie) => {
    let updatedContent = editor.getData(); // Get the updated content from CKEditor

    // Include the updated content in the request
    router.visit(`/Echographies/${echographie.id}`, {
        method: "put",
        data: {
            ...echographie,
            contenuEcho: updatedContent, // Add this line to include the updated content
        },
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            useToast().success('Echographie Modifier', { position: 'bottom-right', duration: 3000 });
            $('#EchographieEdit').modal('hide');
        },
        onError: errors => {
            // Handle errors
        }
    })
}

// end 
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
                    margin-top:500px;
                }
            </style>
            <div class="print-container">` + printContents + `</div>`;

    mywindow.focus();
    mywindow.print();
}

</script>

<style scoped>
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
  





