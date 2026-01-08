<template>
  <div style="width: 100%;border:  1px solid #089bab;" ref="printableContent">
    <div class="header" style=" text-align: center;">
      <h4 contenteditable="true" style="font-size: 18px;"> Taroudant Le : {{ currentDate }} : تارودانت في </h4>
      <h1 class="ordonnance">Ordonnance</h1>
      <h4 contenteditable="true" class="ordonnance mt-1" style="font-size: 18px;"> {{
        modelValue.dataord.patient.nomPatient + " " +
        modelValue.dataord.patient.prenomPatient }}</h4>
    </div>
    <div contenteditable="true"
      style="font-size:20px ;font-family: Verdana, Geneva, Tahoma, sans-serif; color: black; margin-top: 40px;margin-left: 20px;"
      class="contentMedicament">
      <div>
        <div v-for="medicament in modelValue.dataord.traitementsChoisi" v-bind:key="medicament.id"
          class="medicamentNormal">
          <h6 class="text-left font-weight-bold" style="margin-top: -10px;"> {{ medicament.nomMedicament }} {{
                              medicament.dosageMedicament }} {{ medicament.uniteDosageMedicament }}
          </h6>
          <ul style="margin-top: -30px;" class="medicament">
            <li style="text-align: left;">
              {{ medicament.prescription }}
            </li>
          </ul>
        </div>
      </div>   
    </div>
  </div>
</template>
<script>
import printJS from 'print-js';

export default {
  props: {
    modelValue: Object,

  },
  data() {
    return {
      formattedDate: '',
      sumDays: 0,
      currentDate: '',
    }
  },
  methods: {
    printInvoice() {
      this.$nextTick(() => {
        let printContents = this.$refs.printableContent;
        if (printContents) {
          let mywindow = window.frames["print_frame"];
          mywindow.document.body.innerHTML = `
          <style>
            body {
              margin: 0;
              padding: 0;
            }
            .print-container {
              margin-top: 110px;
              padding: 10px;
            }
            .invoice-details {
              line-height: 1.9;
            }
            .invoice-details table td {
              text-align: center;
            }
            .invoice-details table td, .invoice-details table th {
              border: 1px solid black;
            }
            .headType{
              margin-top : 25px;
              margin-left:20px;
            }

            .headTypeNormal{
              margin-top : 25px;
            }

            
            .medicament{
              font-size:10px;
              
            }
            .ordonnance{
              margin-top:-15px;
            }

            .contentMedicament{
              margin-top:-200px;
            }

            .medicamentNormal{
              margin-bottom:35px;
            }
          </style>
          <div class="print-container">${printContents.innerHTML}</div>`;
          mywindow.focus();
          mywindow.print();
        } else {
          console.error("Element with ID 'printable-contentOR' not found.");
        }
      });
    },
  },
  mounted() {
    const date = new Date();
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    this.currentDate = `${day < 10 ? '0' + day : day}-${month < 10 ? '0' + month : month}-${year}`;
  }
};
</script>

<style scoped>
#printable-content {
  margin-top: 150px;
}

.header {
  margin-top: 15%;
}

.custom-margin-left {
  margin-left: 50px;
}

h1.facture {
  font-size: 55px;
}
</style>
<!-- <template >
   <h4 contenteditable="true" style="font-size: 18px;">

{{ modelValue.invoice_number }}
</h4>
</template>
<script setup>
const props = defineProps({
  modelValue: String,
  
});
</script> -->