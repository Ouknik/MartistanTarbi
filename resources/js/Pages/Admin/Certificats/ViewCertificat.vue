<template>
    <div class="modal fade bd-certificatview-modal-lg" tabindex="-1" role="dialog" style="display: none;"
        id="viewCertificat" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h4 class="modal-title text-white">Certificat Médicale
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <HeaderDocteur style="margin-bottom: 10px;"></HeaderDocteur>
                       
                        <div id="printable-contentCertificat" v-if="certificat">
                            <div class="header" style=" text-align: center;">
                                <h4 style="font-size: 15px;"> Taroudant Le : {{ certificat.dateCertificat }} : تارودانت في </h4>
                                
                                <h2 class="mt-2">CERTIFICAT MEDICAL</h2>
                            </div>

                            <div class="invoice-details" v-if="certificat"
                                style="font-size: 17px; font-family: Verdana, Geneva, Tahoma, sans-serif; color: black; text-align: justify;">

                                <div v-html="certificat.contenu">
                                    </div>

                            </div>

                        </div>
                        <div class="footer-cer">
                           <FooterDocteur></FooterDocteur>
                        </div>
                        <div class="text-right">
                            <button @click="printContent" style="font-size: 20px" type="button"
                                class="btn btn-outline-primary  mt-3">
                                <i class="ri-printer-line"></i>Imprimer
                            </button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";
import FooterDocteur from "../../../Layouts/Template/FooterDocteur.vue";

</script>
<script>
export default {
    props: {
        patient: Object,
        age: Number,
        user: Object,
        docteur: Object,
        certificat: Object
    },
    methods: {
        printContent() {
            let printContents = document.getElementById('printable-contentCertificat').innerHTML;
            let mywindow = window.frames["print_frame"];

            mywindow.document.body.innerHTML = `
            <style>
                body {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 100px;
                    padding:30px;
                }
                .invoice-details {
                    line-height: 2; /* Adjust this value to change the line spacing */
                }
            </style>
            <div class="print-container">` + printContents + `</div>`;

            mywindow.focus();
            mywindow.print();
        },
    },
    data() {
        return {
            sumDays: 0,
            currentDate: '',
        }
    },
    mounted() {
        const date = new Date();
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        this.currentDate = `${day < 10 ? '0' + day : day}-${month < 10 ? '0' + month : month}-${year}`;
        let print_frame = document.createElement('iframe');
        print_frame.name = 'print_frame';
        print_frame.width = '0';
        print_frame.height = '0';
        print_frame.style.display = 'none';
        document.body.appendChild(print_frame);

    }
};
</script>
<style>
#printable-contentCertificat {
    margin-top: 30px;
}

.footer-cer {
    margin-top: 20px;
    margin-left: 20px;
    margin-right: 20px;
    color: black;
    font-weight: bolder;
}

.header {
    margin-top: 15%;
}

.invoice-details {
    margin-top: 10%;
    margin-bottom: 20%;
    padding-left: 5%;
    padding-right: 5%;
    font-size: 20%;
    line-height: 3;
}
</style>
