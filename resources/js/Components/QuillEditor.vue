<template>
    <div>
        <div ref="editorContainer"></div>
        <button @click="printEditorContent">Print</button>
    </div>
</template>
  
<script setup>
import { ref, onMounted, watch } from 'vue';
import Quill from 'quill';
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';

const editorContainer = ref(null);
let quill;

const props = defineProps(['dynamicContent']);

const defaultTemplate = `
                    <div id="printable-contentOrdonnance" class="custom-margin-left" style="padding-top: 100px;">
                            <div class="header" style=" text-align: center;">
                                <h4 style="font-size: 18px;"> Taroudant Le : : تارودانت في </h4>
                                <h1 class="ordonnance mt-1">Ordonnance</h1>
                                <h4 class="mt-1" style="font-size: 18px;"> Nom et Prénom : 
                                </h4>
                            </div>
                            <div
                                style="font-size: 20px; font-family: Verdana, Geneva, Tahoma, sans-serif; color: black; text-align: justify;margin-top: 65px;margin-left: 15px;">
                                  
                                        {{contentPlaceholder}}
   
                             
                            </div>
                        </div>`
    ;
const setContentToEditor = (dynamicContentValue) => {
    const contentToSet = defaultTemplate.replace('{{contentPlaceholder}}', dynamicContentValue || '');
    quill.root.innerHTML = contentToSet;
}
onMounted(() => {
    quill = new Quill(editorContainer.value, {
        theme: 'snow'
    });
    setContentToEditor(props.dynamicContent);

});

// Watch for changes in dynamicContent prop and update the specific part of the editor content
watch(props, (newProps) => {
    if (quill && newProps.dynamicContent) {
        const contentToSet = defaultTemplate.replace('{{contentPlaceholder}}', newProps.dynamicContent);
        quill.root.innerHTML = contentToSet;
    }
}, { deep: true });

const printEditorContent = () => {
    const content = quill.root.innerHTML;
    printContent(content);
}

function printContent(content) {
    const iframe = document.createElement('iframe');
    document.body.appendChild(iframe);

    iframe.style.display = 'none';

    iframe.contentDocument.open();
    iframe.contentDocument.write('<html><head><title>Print</title></head><body>');
    iframe.contentDocument.write(content);
    iframe.contentDocument.write('</body></html>');
    iframe.contentDocument.close();

    // This timeout is necessary to ensure the content is fully loaded in the iframe before printing
    setTimeout(() => {

        iframe.contentWindow.print();

        // Remove the iframe after printing
        document.body.removeChild(iframe);
    }, 50);
}

</script>
  
<style scoped>
/* Add any additional styles for your editor here */
</style>
  