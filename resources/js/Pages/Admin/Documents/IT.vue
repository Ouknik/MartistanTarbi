<template>
    <div class="template" contenteditable="true">
        <div class="header">
            <!-- <div>
                <h1><span class="hide-in-print">INTERACTIVE </span>INVOICE</h1>
                <div class="hide-in-print" style="margin-bottom:10px">This page is rendered from a "template" Vue.js
                    component.<br>You can modify the fields highlighted in green and interact with the buttons without
                    having them in the print. Check out <a
                        href="https://github.com/motla/vue-document-editor/blob/master/src/Demo/InvoiceTemplate.ce.vue"
                        target="_blank">InvoiceTemplate.ce.vue</a></div>
            </div> -->

            <table>
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <td contenteditable="true">
                            <div class="col-lg-3">
                                <h3 class="text-dark">Dr.TARBI Amina</h3>
                                <div>Spécialite en Gynècologie et Obstétrique</div>
                                <div class="text-dark">
                                    <div>Accouchement - Suivi de grossesse Echo 3D/4D </div>
                                    <div> Chirurgie gynécologique et mammaire </div>
                                    <div> Stérilité de couple - Colposcopie</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div><img src="/images/logo/logoTarbi.png" style="width:110px"></div>

                            <!-- <img :src="$page.props.user.profile_photo_path" class="img-fluid" alt="" height="10"> -->

                        </td>
                        <td>
                            <div class="col-lg-5 text-right" style="text-align:right">
                                <h3 class="text-dark">الدكتورة طربي أمينة</h3>
                                <div>اخصائية أمراض النساء والتوليد</div>
                                <div class="text-dark">
                                    <div> 3D/4D تتبع الحمل و التوليد - الفحص بالصدىد</div>
                                    <div>جراحة أمراض و سرطان الثدي و الرحم</div>
                                    <div>عقم الزوجين - تنظير عنق الرحم</div>
                                </div>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
            <div class="row" style="margin-bottom: -250px;text-align: left;">

                <div class="col-lg-2">
                    <!-- <img :src="$page.props.user.profile_photo_path" class="img-fluid" alt="" height="10"> -->
                </div>


            </div>

        </div>
        <!-- <div id="printable-contentEDG" class="custom-margin-left" style="padding-top: 150px;">
            <div class="header" style=" text-align: center; ">

            </div>

            <div class="row font-weight-bold mt-3" style="font-size: 15px;">
                <div class="col-lg-10">
                    NOM & PRENOM :
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 text-left" style="font-size: 15px;">
                    Date Des Dernieres Regles : <span class="text-dark font-weight-bold">
                    </span>
                </div>
            </div>

            <div class="mt-2">
                <div style="display: flex; align-items: center;">
                    <label class="font-weight-bold mt-2" style="white-space: nowrap;" for="indication">INDICATION
                        :</label>
                    <input id="indication" type="text" class="form-control text-dark" style="width: 300px; border: none; ">
                </div>
            </div>
            <div class="mt-4">
                <div style="display: flex; align-items: center;">
                    <h4 class="font-weight-bold" style="white-space: nowrap;" for="indication">
                        1<sup>er</sup> TRIMESTRE : </h4>
                </div>
            </div>
            <div class="ml-4" style="margin-left: 20px; margin-top: 50px;">
                <div class="ml-5">
                    <div style="display: flex; align-items: center; margin-top: 15px;">
                        <span style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                        <label class="font-weight-bold " for="indication2" style="white-space: nowrap;">Utérus :
                        </label>
                        <input id="indication2" type="text" class="form-control text-dark"
                            style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                    </div>

                    <div style="display: flex; align-items: center; margin-top: 15px;">
                        <span style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                        <label class="font-weight-bold " for="indication3" style="white-space: nowrap;">OEuf
                            Unique / Multiple :</label>
                        <input id="indication3" type="text" class="form-control text-dark"
                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                    </div>

                    <div style="display: flex; align-items: center;  margin-top: 15px;">
                        <span style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                            Embryon :
                        </label>
                        <input id="indication4" type="text" class="form-control text-dark"
                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; margin-top: 60px;">
                    <h3 class="mt-3 font-weight-bold" for="indication">Conclusion </h3>
                    <textarea class="form-control ml-3 text-dark mt-2" style="border: none;">

                                    </textarea>
                </div>
            </div>
        </div> -->



    </div>
</template>

<script setup>
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";

</script>
<style scoped>
  table {
    width: 100%;
    border-spacing: 0;
  }

  </style>