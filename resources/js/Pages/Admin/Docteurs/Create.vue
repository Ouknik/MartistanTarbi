<template>
    <div class="new-user-info">
        <form @submit.prevent="submit">
            <div class="row" >
                <div class="form-group col-md-6 col-lg-4">
                    <label for="lname">Nom</label>
                    <input type="text" class="form-control" id="lname" placeholder="Nom" v-model="docteur.nomDocteur">
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="fname">Prénom </label>
                    <input type="text" class="form-control" id="fname" placeholder="Prénom"
                        v-model="docteur.prenomDocteur">
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label for="add1">Code Docteur</label>
                    <input type="text" class="form-control" id="code" placeholder="Code Docteur"
                        v-model="docteur.codeDocteur">
                </div>

                 <div class="form-group col-md-4 col-lg-4">
                    <label for="exampleInputdate">Date Naissance</label>
                    <input type="date" format="yyyy-mm-dd" class="form-control" id="exampleInputdate"
                        v-model="docteur.dateNaissanceDocteur" pattern="yyyy-mm-dd">
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label for="cname">Téléphone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Téléphone"
                        v-model="docteur.telephoneDocteur">
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label for="genre" class="d-block">Genre:</label>
                    <div id="genre" class="pt-2">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio8" name="customRadio1" class="custom-control-input"
                                v-model="docteur.sexeDocteur" value="Masculin" checked>
                            <label class="custom-control-label" for="customRadio8" > Masculin </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio9" name="customRadio1" class="custom-control-input"
                                 v-model="docteur.sexeDocteur" value="Féminin">
                            <label class="custom-control-label" for="customRadio9" > Féminin </label>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group col-sm-4">
                    <label>Genre</label>
                    <select class="form-control" id="genre" v-model="docteur.sexeDocteur">
                        <option value="Masculin">Masculin</option>
                        <option value="Femenin<">Femenin</option>

                    </select>
                </div> -->
                <div class="form-group col-md-4 col-lg-4">
                    <label for="villeDocteur">Ville:</label>
                    <input class="form-control" id="villeDocteur" v-model="docteur.villeDocteur"/>

                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Email"
                        v-model="docteur.emailDocteur">
                </div>
                <div class="form-group col-sm-4">
                    <label>Specialités</label>
                    <select class="form-control" id="selectspecialite" v-model="docteur.specialiteDocteur">
                        <option>Généco-Obstétrique</option>
                        <option>Cardiologie</option>
                        <option>Traumatologie</option>
                        <option>Ophtalmologie</option>
                        <option>ORL</option>
                        <option>Pédiatrie</option>
                        <option>Chirurgie Infentile</option>
                        <option>Pre-Anastésie</option>
                        <option>Neurologie</option>
                        <option>Dermatologie</option>
                        <option>Endocrinologie</option>
                        <option>Pre-Anastésie</option>
                        <option>Gastro-Ethérologie</option>
                        <option>Rhumatologie</option>
                        <option>Pediatrie</option>

                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label>Departement</label>
                    <select class="form-control" id="selectsdepartement" v-model="docteur.departementDocteur">
                        <option>Pôle Femme – Mère – Enfant – Nouveau-né</option>
                        <option>Pôle Tête et Cou</option>
                        <option>Pôle Trauma Center</option>
                        <option>Spécialités Chirurgicales</option>
                        <option>Spécialités Médicales</option>
                        <option>Urgences</option>
                        <option>Imagerie Médicale et Laboratoire</option>


                    </select>
                </div>
                <!-- <div class="form-group col-sm-4">
                    <label>Departement</label>
                    <select class="form-control" id="selectdepartement" v-model="docteur.departementDocteur">
                        <option value="pole Femme">Pôle Femme – Mère – Enfant – Nouveau-né</option>
                        <option value="pole Tete">Pôle Tête et Cou</option>
                        <option value="pole Trauma Center">Pôle Trauma Center</option>
                        <option value="chirurgicales">Spécialités Chirurgicales</option>
                        <option value="medicales">Spécialités Médicales</option>
                        <option value="urgences">Urgences</option>
                        <option value="laboratoire">Imagerie Médicale et Laboratoire</option>

                    </select>
                </div> -->
                <div class="form-group col-sm-4">
                    <label>Nationalité</label>
                    <select class="form-control" id="selectnationalite" v-model="docteur.nationaliteDocteur">
                        <!-- //<option v-for=" docteurSelect in docteur" :value="docteursSelect.id">{{ docteur.nationaliteDocteur }}</option> -->
                        <option value="Marocain">Marocain</option>
                        <option value="Etranger">Etranger</option>
                        <option value="marocains residant a etranger">Marocains Residant à Etranger</option>
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label for="add2">Adresse</label>
                    <textarea class="form-control" id="add2" placeholder="Adresse" rows="2"
                        v-model="docteur.adresseDocteur"></textarea>
                </div>
            </div>
            <hr>

             <div class="row">
                <div class="form-group col-md-12">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Description" rows="2"
                    v-model="docteur.descriptionDocteur"   ></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</template>

<script setup>
import { useForm ,router } from "@inertiajs/vue3";

defineProps({
    docteur: Object,
   // docteursSelects: Object,
   // specialites:array()
})

function submit() {
    router.visit('/docteurs', {
        method: 'post',
        data : docteur,
        preserveState: true,
        preserveScroll: true,
        errorBag: true,
        forceFormData: true,
        onProgress: progress => { },
        onSuccess: page => { alert('Bien Ajouter') },
        onError: errors => { alert("Erreur de l'Ajout") },
    });
}
const docteur = useForm({

        nomDocteur :'',
        prenomDocteur:'',
        adresseDocteur:'',
        telephoneDocteur:'',
        specialiteDocteur:'',
        codeDocteur :'',
        sexeDocteur :'Masculin',
        villeDocteur :'',
        emailDocteur :'',
        departementDocteur:'',
        dateNaissanceDocteur :'',
        descriptionDocteur:' ',
        nationaliteDocteur :'',
       // profile_photo_path :''


})


</script>

<style>

</style>
