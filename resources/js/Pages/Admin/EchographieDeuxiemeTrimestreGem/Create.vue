<template>
    <p hidden>{{ (EchographieDeuxiemeTrimestreGem.patient = patient) }} {{ EchographieDeuxiemeTrimestreGem.consultation_id=
    idConsultation }}</p>

    <div class="modal fade bd-EchographieDeuxiemeTrimestreGems-modal-lg" tabindex="-1" id="EchographieDeuxiemeTrimestreGem"
        role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Echographie Deuxieme Trimestre Gemellaires
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <HeaderDocteur></HeaderDocteur>

                        <span hidden>
                            {{
                                (form.date = new Date()
                                    .toJSON()
                                    .slice(0, 10))
                            }}
                        </span>

                        <div id="printable-content2TRG" class="custom-margin-left" style="padding-top: 120px;">
                            <div class="header" style=" text-align: center; ">
                                <h2 class="font-weight-bold">ECHOGRAPHIE OBSTETRICALE</h2>
                                <h6>Date : {{ formattedDate }}</h6>
                            </div>

                            <div class="row font-weight-bold mt-3" style="font-size: 15px;">
                                <div class="col-lg-10">
                                    NOM & PRENOM : <span class="text-dark">Mme {{ patient.nomPatient + " " +
                                        patient.prenomPatient }}</span>
                                </div>
                                <div class="col-lg-2">
                                    Âge : <span class="text-dark">{{ age }} Ans</span>
                                </div>
                            </div>
                            <div class="row" v-for="GS in gestationnelle" v-bind:key="GS.id">
                                <div class="col-lg-12 text-left" style="font-size: 15px;">
                                    Date Des Dernieres Regles : <span class="text-dark font-weight-bold">{{
                                        GS.dateDernierRegle.split('-').reverse().join('-') }}</span>
                                </div>
                            </div>
                            <div>
                                <div style="display: flex; align-items: center;">
                                    <label class="font-weight-bold" style="white-space: nowrap;" for="indication">INDICATION
                                        :</label>
                                    <input id="indication" type="text" v-model="EchographieDeuxiemeTrimestreGem.indication"
                                        class="form-control text-dark"
                                        style="width: 300px; border: none; margin-top: -7px; ">
                                </div>
                            </div>
                            <div class="mt-2">
                                <div style="display: flex; align-items: center;">
                                    <h4 class="font-weight-bold" style="white-space: nowrap;" for="indication">
                                        2 <sup>ème</sup> / 3 <sup>ème</sup> TRIMESTRE : </h4>

                                </div>
                            </div>


                            <div class="ml-4" style=" margin-top: 10px;">
                                <div style="display: flex; align-items: center; margin-top: 5px;;">
                                    <span
                                        style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                    <label class="font-weight-bold " for="indication2" style="white-space: nowrap;">
                                        Grossesse gémellaire :
                                    </label>
                                    <input id="indication2" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.grossesse_gemellaire"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none; margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap; margin-left: 45px;">
                                        Activité Cardiaque :
                                    </label>
                                    <select id="indication4" v-model="EchographieDeuxiemeTrimestreGem.activite_cardiaque"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="positive" selected>positive</option>
                                        <option value="negative">negative</option>
                                    </select>
                                </div>

                            </div>
                            <div>
                                <div style="display: flex; align-items: center; margin-top: 1px;">
                                    <label class="font-weight-bold " for="indication3" style="white-space: nowrap;">
                                        Mouvements actifs :</label>
                                    <select id="indication4" v-model="EchographieDeuxiemeTrimestreGem.mouvements_actifs"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 400px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="présents" selected>présents</option>
                                        <option value="absents">absents</option>
                                    </select>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: 73px;">
                                        Mouvements respiratoires :
                                    </label>
                                    <select id="indication4"
                                        v-model="EchographieDeuxiemeTrimestreGem.mouvements_respiratoires"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="présents" selected>présents</option>
                                        <option value="absents">absents</option>
                                    </select>

                                </div>


                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Présentation : 1<sup style="font-size: 10px;">er</sup> :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.presentation1"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                </div>
                                <div style="display: flex; align-items: center;  margin-top: 5px; margin-left: 110px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        2<sup style="font-size: 10px;">éme</sup> :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.presentation2"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Liquide amniotique :
                                    </label>
                                    <select id="indication4" v-model="EchographieDeuxiemeTrimestreGem.liquide_amniotique"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                        <option value="Normale" selected>Normale</option>
                                        <option value="Hydramnios">Hydramnios</option>
                                        <option value="Anomnios">Anomnios</option>
                                        <option value="Oligomios">Oligomios</option>
                                        <option value="Liquide Amniotique diminué">Liquide Amniotique diminué</option>

                                    </select>
                                </div>

                                <div>
                                    <div style="display: flex; align-items: center; margin-top: 1px;;">
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Placenta :
                                        </label>
                                    </div>
                                </div>

                                <div style="margin-left: 20px;">
                                    <div style="display: flex; align-items: center;  margin-top: 1px;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                            Localisation :
                                        </label>
                                        <select id="indication4"
                                            v-model="EchographieDeuxiemeTrimestreGem.localisation_placenta"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -17px; appearance: none;">
                                            <option value="postérieur" selected>postérieur</option>
                                            <option value="antérieur">antérieur</option>
                                            <option value="fundique">fundique</option>
                                        </select>
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                            Grade :
                                        </label>
                                        <input id="indication4" type="text"
                                            v-model="EchographieDeuxiemeTrimestreGem.grade_placenta"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                            Cordon :
                                        </label>
                                        <input id="indication4" type="text" v-model="EchographieDeuxiemeTrimestreGem.cordon"
                                            class="form-control text-dark"
                                            style="margin-left: 5px; width: 300px; border: none;margin-top: -8px; ">
                                    </div>
                                    <div style="display: flex; align-items: center;  margin-top: 1px;">

                                    </div>
                                    <div style="display: flex; align-items: center;  margin-top: 1px;">

                                    </div>
                                </div>

                            </div>
                            <div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Diamètre Bipariétal 1 :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diametre_biparietal_1"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diametre_biparietal_1_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diametre_biparietal_1_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Longueur Fémur 1 :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.longueur_femur_1"
                                        class="form-control text-dark"
                                        style="margin-left: 30px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.longueur_femur_1_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.longueur_femur_1_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Diamètre Bipariétal 2 :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diametre_biparietal_2"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 70px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diametre_biparietal_2_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diametre_biparietal_2_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Longeur Fémur 2 :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.longueur_femur_2"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 100px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 180px;">
                                        mm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.longueur_femur_2_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.longueur_femur_2_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Diam Abd Trans :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diam_abd_trans"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 100px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 190px;">
                                        cm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diam_abd_trans_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.diam_abd_trans_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div>
                                <div style="display: flex; align-items: center; ">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Circonf Abd :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.circonf_abd" class="form-control text-dark"
                                        style="margin-left: 5px; width: 130px; border: none;margin-top: -8px; text-align: right;">

                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 190px;">
                                        cm
                                    </label>
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-right: 80px;">
                                        correspond au
                                    </label>

                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.circonf_abd_sa"
                                        class="form-control text-dark"
                                        style="margin-left: 1px; width: 50px; border: none;margin-top: -8px; ">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -12px;">
                                        SA
                                    </label>
                                    <label class="" for="indication4" style="white-space: nowrap; margin-left: 15px;">
                                        et
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.circonf_abd_j"
                                        class="form-control text-dark"
                                        style="margin-left: 2px; width: 45px; margin-top: -8px; margin-left: -0px; border: none;">
                                    <label class="font-weight-bold " for="indication4"
                                        style="white-space: nowrap;margin-left: -8px;">
                                        J
                                    </label>

                                </div>
                            </div>

                            <div class="ml-4" style=" margin-top: 5px;">
                                <div class="ml-1">
                                    <div style="display: flex; align-items: center; margin-top: 1px;;">
                                        <span
                                            style="font-size:30px; margin-top: -10px;color: black; margin-right: 5px;">&bull;</span>
                                        <label class="font-weight-bold " for="indication2"
                                            style="white-space: nowrap;">Etudemorphologique
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--Etude morphologique -->
                            <div style="margin-left: 20px;">
                                <div style="display: flex; align-items: center;  margin-top: 1px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Crane :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieDeuxiemeTrimestreGem.crane"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 220px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Rachis :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieDeuxiemeTrimestreGem.rachis"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 150px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Coeur :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieDeuxiemeTrimestreGem.coeur"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 150px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Estomac :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieDeuxiemeTrimestreGem.estomac"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width:  150px; border: none;margin-top: -8px;">

                                </div>

                                <div style="display: flex; align-items: center;  margin-top: 5px;">
                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Vessie :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieDeuxiemeTrimestreGem.vessie"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Reins :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieDeuxiemeTrimestreGem.reins"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Membres :
                                    </label>
                                    <input id="indication4" type="text" v-model="EchographieDeuxiemeTrimestreGem.membres"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                    <label class="font-weight-bold " for="indication4" style="white-space: nowrap;">
                                        Paroi abdominale :
                                    </label>
                                    <input id="indication4" type="text"
                                        v-model="EchographieDeuxiemeTrimestreGem.paroi_abdominale"
                                        class="form-control text-dark"
                                        style="margin-left: 5px; width: 125px; border: none;margin-top: -8px;">

                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; margin-top: -15px;">
                                <h4 class="font-weight-bold" for="indication" style="margin-top: 20px;">Conclusion </h4>
                                <textarea v-model="EchographieDeuxiemeTrimestreGem.conclusion"
                                    class="form-control ml-3 text-dark mt-3"
                                    style="border: none; margin-top: -55px; color: black;  overflow: hidden; line-height: 1.8;"></textarea>
                            </div>

                        </div>


                        <div class="footer-cer">
                            <FooterDocteur></FooterDocteur>

                        </div>
                       
                        <div class="text-right">
                            <button style="font-size: 20px" @click="printInvoice()" type="button"
                                class="btn btn-outline-primary  mt-3">
                                <i class="ri-printer-line"></i>Imprimer
                            </button>
                            <button style="font-size: 20px" type="submit" class="btn mt-3 btn-primary ml-4"
                                :disabled="form.processing">
                                <i class="ri-bill-fill"></i>Ajouter
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</template>



<script setup>
import { useForm, router, Link } from "@inertiajs/vue3";
import { useToast } from 'vue-toast-notification';
import HeaderDocteur from "../../../Layouts/Template/HeaderDocteur.vue";
import FooterDocteur from "../../../Layouts/Template/FooterDocteur.vue";

const props = defineProps({
    patient: Object,
    age: Number,
    gestationnelle: Object,
    idConsultation: Number
})

const EchographieDeuxiemeTrimestreGem = useForm({
    date: '',
    indication: 'Grossesse',
    grossesse_gemellaire: '2',
    activite_cardiaque: 'positive',
    mouvements_actifs: 'présents',
    mouvements_respiratoires: 'présents',
    presentation1: 'siege',
    presentation2: 'céphalique',
    liquide_amniotique: '',
    localisation_placenta: '',
    grade_placenta: '',
    cordon: '',
    diametre_biparietal_1: '',
    diametre_biparietal_1_sa: '',
    diametre_biparietal_1_j: '',
    longueur_femur_1: '',
    longueur_femur_1_sa: '',
    longueur_femur_1_j: '',
    diametre_biparietal_2: '',
    diametre_biparietal_2_j: '',
    diametre_biparietal_2_sa: '',
    longueur_femur_2: '',
    longueur_femur_2_sa: '',
    longueur_femur_2_j: '',
    diam_abd_trans: '',
    diam_abd_trans_sa: '',
    diam_abd_trans_j: '',
    circonf_abd: '',
    circonf_abd_sa: '',
    circonf_abd_j: '',
    crane: 'contour bien suivi',
    rachis: 'bien suivi',
    coeur: '4 cavités',
    estomac: 'vu',
    vessie: 'vu',
    reins: 'normaux',
    membres: '4',
    paroi_abdominale: 'intégre',
    conclusion: 'grossesse gémellaire évolutive de 19- 20 SA mono choriale mono amniotique',
    consultation_id: props.idConsultation,
    patient: ""
})


const submit = () => {
    if (props.idConsultation == 0) {
        useToast().error('Veuillez Choisir une consultation ', { position: 'bottom-right', duration: 3000 });
        return false
    }
    router.visit('/EchographieDeuxiemeTrimestreGems', {
        method: 'post',
        data: EchographieDeuxiemeTrimestreGem,
        preserveState: true,
        preserveScroll: true,
        errorBag: null,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => {
            useToast().success('Echographie Deuxieme Trimestre Gémellaires Bien Ajouter', { position: 'bottom-right', duration: 3000 });
            $('#EchographieDeuxiemeTrimestreGem').modal('hide');
        },
        onError: errors => { useToast().error('Veuillez remplir tout les champs', { position: 'bottom-right', duration: 3000 }); },
    });
}
</script>
<script>
import printJS from 'print-js';

export default {
    data() {
        return {
            formattedDate: '',
            form: {

            }
        }
    },

    methods: {

        printInvoice() {
            const printableElement = document.getElementById('printable-content2TRG');
            printableElement.classList.add('printable-content2TRG-print');
            printJS({
                printable: 'printable-content2TRG',
                type: 'html',
                targetStyles: ['*']
            });
            setTimeout(() => {
                printableElement.classList.remove('printable-content2TRG-print');
            }, 1000);
        }
    },
    mounted() {
        this.$nextTick(() => {
            document.querySelector('.bd-EchographieDeuxiemeTrimestreGems-modal-lg').addEventListener('shown.bs.modal', () => {
                this.printInvoice();
            });
        });
        const today = new Date();
        const dateParts = today.toJSON().slice(0, 10).split('-');
        this.formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
        this.gestationnelle.reverse();

    }
};
</script>
<style>
@media print {
    label {
        display: inline-block;
        /* Cela peut aider à garder le texte et les deux points sur la même ligne */
    }

    #printable-contentEDG {
        padding-top: 150px;
    }
}

.custom-margin-left {
    margin-left: 50px;
}
</style>
