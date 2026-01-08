<template>
   <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header bg-secondary">
               <h5 class="modal-title text-white">Modifier Les Informations du Docteur : {{ $page.props.docteur.name }}
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="new-user-info">
                  <form @submit.prevent="submit">
                     <!-- <div class="form-group row align-items-center">
                        <div class="col-md-12">
                           <div class="profile-img-edit">
                              <img class="profile-pic" src="/images/user/11.png" alt="profile-pic">
                              <div class="p-image">
                                 <i class="ri-pencil-line upload-button"></i>
                                 <input class="file-upload" type="file" accept="image/*">
                              </div>
                           </div>
                        </div>
                     </div> -->

                     <div class=" row align-items-center">
                        <div class="form-group col-lg-2">
                           <label for="fname">Prenom:</label>
                           <input type="text" class="form-control" id="fname" v-model="$page.props.docteur.prenomDocteur">
                        </div>
                        <div class="form-group col-lg-2">
                           <label for="lname">Nom:</label>
                           <input type="text" class="form-control" id="lname" v-model="$page.props.docteur.nomDocteur">
                        </div>
                        <div class="form-group col-lg-2">
                           <label for="uname">Email:</label>
                           <input type="text" class="form-control" id="uname" v-model="$page.props.docteur.emailDocteur">
                        </div>
                        <div class="form-group col-lg-2">
                           <label for="cname">Ville:</label>
                           <input type="text" class="form-control" id="cname" v-model="$page.props.docteur.villeDocteur">
                        </div>
                        <div class="form-group col-lg-2">
                           <label class="d-block">Genre:</label>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="customRadio6" name="customRadio1" class="custom-control-input"
                                 v-model="$page.props.docteur.sexeDocteur" value="Masculin" checked>
                              <label class="custom-control-label" for="customRadio6"> Masculin </label>
                           </div>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="customRadio7" name="customRadio1" class="custom-control-input"
                                 v-model="$page.props.docteur.sexeDocteur" value="Féminin">
                              <label class="custom-control-label" for="customRadio7"> Féminin </label>
                           </div>
                        </div>
                        <div class="form-group col-lg-2">
                           <label for="cname">Téléphone</label>
                           <input type="text" class="form-control" id="phone"
                              v-model="$page.props.docteur.telephoneDocteur">
                        </div>
                        <div class="form-group col-lg-2">
                           <label for="dob">Date de Naissance:</label>
                           <input class="form-control" id="dob" format="yyyy-mm-dd" value="1984-01-24">
                        </div>
                        <!-- <div class="form-group col-sm-6">
                           <label>Marital Status:</label>
                           <select class="form-control" id="exampleFormControlSelect1">
                              <option selected="">Single</option>
                              <option>Married</option>
                              <option>Widowed</option>
                              <option>Divorced</option>
                              <option>Separated </option>
                           </select>
                        </div> -->
                        <div class="form-group col-sm-6">
                           <label>Departement</label>
                           <select class="form-control" id="selectdepartement" v-model="$page.props.departementDocteur">
                              <option value="pole Femme">Pôle Femme – Mère – Enfant – Nouveau-né</option>
                              <option value="pole Tete">Pôle Tête et Cou</option>
                              <option value="pole Trauma Center">Pôle Trauma Center</option>
                              <option value="chirurgicales">Spécialités Chirurgicales</option>
                              <option value="medicales">Spécialités Médicales</option>
                              <option value="urgences">Urgences</option>
                              <option value="laboratoire">Imagerie Médicale et Laboratoire</option>

                           </select>
                        </div>
                        <!-- <div class="form-group col-sm-6">
                           <label>Nationalité:</label>
                           <select class="form-control" id="exampleFormControlSelect3"
                              v-model="$page.props.docteur.nationaliteDocteur">
                              <option selected="Marocain">Marocain</option>
                              <option>Etranger</option>
                              <option>Marocains Residant à Etranger</option>
                           </select>
                        </div> -->
                        <div class="form-group col-sm-4">
                           <label>Nationalité</label>
                           <select class="form-control" id="selectnationalite" v-model="docteur.nationaliteDocteur">
                              <option value="Marocain">Marocain</option>
                              <option value="Etranger">Etranger</option>
                              <option value="marocains residant a etranger">Marocains Residant à Etranger</option>
                           </select>
                        </div>
                        <div class="form-group col-sm-6">
                           <label>Specialités:</label>
                           <select class="form-control" id="selectspecialite"
                              v-model="$page.props.docteur.specialiteDocteur">
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
                        <div class="form-group col-sm-12">
                           <label>Address:</label>
                           <textarea class="form-control" name="address" rows="5" style="line-height: 22px;"
                              v-model="$page.props.docteur.adresseDocteur"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                           <label for="exampleFormControlTextarea1">Description</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Description"
                              rows="2" v-model="$page.props.docteur.descriptionDocteur"></textarea>
                        </div>
                     </div>

                     <button type="submit" @click="updateDocteur" class="btn btn-primary mr-2">Submit</button>
                     <button type="reset" class="btn iq-bg-danger">cancel</button>
                  </form>
               </div>
            </div>
            <!-- <div class="modal-footer">
               <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
               <button type="submit" class="btn btn-primary">Modifier</button>
            </div> -->
         </div>
      </div>
   </div>
</template>


<script setup>
import { useForm, router } from "@inertiajs/vue3";

defineProps({
   docteur: Object,
   // docteursSelects: Object,
   // specialites:array()
})

const updateDocteur = (docteur) => {
   router.visit('/docteurs.update', {
      method: 'PUT',
      data: docteur,
      preserveState: true,
      preserveScroll: false,
      errorBag: null,
      forceFormData: false,
      onProgress: progress => { },
      onSuccess: page => { alert('Bien Editer') },
      onError: errors => { alert('Erreurs') },
   });
}
const docteur = useForm({
   nomDocteur: '',
   prenomDocteur: '',
   adresseDocteur: '',
   telephoneDocteur: '',
   specialiteDocteur: '',
   codeDocteur: '',
   sexeDocteur: '',
   villeDocteur: '',
   emailDocteur: '',
   departementDocteur: '',
   dateNaissanceDocteur: '',
   descriptionDocteur: '',
   nationaliteDocteur: '',
   // profile_photo_path :''
});
</script>

<style></style>
