<template>
    <div class="new-user-info">
        <form @submit.prevent="submit">
            <div class="row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="lname">Nom</label>
                    <input type="text" class="form-control" id="lname" placeholder="Nom" v-model="secretaire.nomSecretaire">
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="fname">Prénom </label>
                    <input type="text" class="form-control" id="fname" placeholder="Prénom" v-model="secretaire.prenomSecretaire">
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label for="add1">CIN</label>
                    <input type="text" class="form-control" id="add1" placeholder="Carte nationale"  v-model="secretaire.cinSecretaire">
                </div>

                <div class="form-group col-md-4 col-lg-4">
                    <label for="exampleInputdate">Date Naissance</label>
                    <input type="date" class="form-control" id="exampleInputdate" v-model="secretaire.dateNaissanceSecretaire">
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label for="cname">Téléphone</label>
                    <input type="text" class="form-control" id="cname" placeholder="Téléphone"
                        v-model="secretaire.telephoneSecretaire">
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label for="genre" class="d-block">Genre:</label>
                    <div id="genre" class="pt-2">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio6" name="customRadio1" class="custom-control-input"
                             v-model="secretaire.sexeSecretaire" value="Masculin">
                            <label class="custom-control-label" for="customRadio6"> Masculin </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio7" name="customRadio1" class="custom-control-input"
                                 v-model="secretaire.sexeSecretaire" value="Féminin" checked>
                            <label class="custom-control-label" for="customRadio7"> Féminin </label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4 col-lg-4">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" v-model="secretaire.emailSecretaire">
                </div>
                <div class="form-group col-sm-4">
                    <label>Ville</label>
                    <select class="form-control" id="selectcountry" v-model="secretaire.villeSecretaire">
                        <option value="Agadir">Agadir</option>
                        <option value="Taroudant">Taroudant</option>
                        <option value="Marrakech">Marrakech</option>
                    </select>
                </div>
                <!-- <div class="form-group col-md-4 col-lg-4">
                    <label for="add1">Ville</label>
                    <input type="text" class="form-control" id="add1" placeholder="Ville"  v-model="secretaire.villesecretaire">
                </div> -->
                <!-- <div class="form-group col-sm-4">
                    <label>Assurance</label>
                    <select name="assurance_id" class="form-control" id="assurance_id" v-model="secretaire.assurance_id">
                        <option v-for=" assurance in assurances" :value="assurance.id">{{ assurance.typeAssurance }}</option>
                    </select>
                </div> -->

                <div class="form-group col-md-4">
                    <label for="add2">Nationnalité</label>
                    <select class="form-control" id="selectcountry" v-model="secretaire.nationaliteSecretaire">
                        <option selected value="Marocaine">Marocaine</option>
                        <option value="Française">Française</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
            </div>
            <div class="row">

            <div class="form-group col-md-6">
                    <label for="add2">Adresse</label>
                    <textarea class="form-control" id="add2" placeholder="Description" rows="2"
                        v-model="secretaire.adresseSecretaire"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Description" rows="2"
                        v-model="secretaire.descriptionSecretaire"></textarea>
                </div>
            </div>
            <button type="submit" class="btn mb-3 btn-primary"><i class="ri-bill-fill"></i>Ajouter</button>
.        </form>
    </div>
</template>

<script setup>
import { useForm, router  } from "@inertiajs/vue3";
defineProps({
    //secretaire: Object,
    //assurances : Object,
    villes : Object,
})

const secretaire = useForm({
    cinSecretaire: 'JT441',
    nomSecretaire: 'benhawa',
    prenomSecretaire: 'Salwa',
    sexeSecretaire: 'Féminin',
    emailSecretaire: 'Salwa57@gmail.com',
    adresseSecretaire: 'Alhouda ',
    telephoneSecretaire: '0695412879',
    dateNaissanceSecretaire: '12-05-1998',
    nationaliteSecretaire: 'Marocaine',
    villeSecretaire: 'Agadir',
    descriptionSecretaire:'secretaire Assistant',


})
const submit = ()=> {
    router.visit('/secretaires', {
        method: 'post',
        data: secretaire,
        preserveState: false,
        preserveScroll: false,
        errorBag: null,
        forceFormData: false,
        onProgress: progress => { },
        onSuccess: page => { alert('Bien Ajouter') },
        onError: errors => { alert('Erreurs') },
    });
}


</script>

<style></style>
