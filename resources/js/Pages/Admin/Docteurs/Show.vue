<template>
   <AdminLayout>
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-3">
               <div class="iq-card">
                  <div class="iq-card-body pl-0 pr-0 pt-0">
                     <div class="doctor-details-block">
                        <div class="doc-profile-bg color-template" style="height:150px;">
                        </div>
                        <div class="doctor-profile text-center">
                           <img :src="docteur.profile_photo_path" alt="profile-img" class="avatar-130 img-fluid">
                        </div>
                        <div class="text-center  mt-3 pl-3 pr-3">
                           <h4>Dr. <b>{{ docteur.name }}</b></h4>
                           <p class="mb-0">
                           </p>
                        </div>
                        <!-- <div class="text-center mt-4 p-2">
                           <button type="button" class="btn btn-secondary btn-block" data-toggle="modal"
                              data-target=".bd-example-modal-xl" style="font-size: larger;"><i
                                 class="las la-edit"></i>Modifier Informations</button>
                        </div> -->
                        <div class="text-center p-2">
                           <button type="button" class="btn btn-secondary btn-block" data-toggle="modal"
                              data-target=".bd-updatePassword-modal-lg" style="font-size: larger;"><i
                                 class="las la-edit"></i>Modifier Mot De Passe</button>
                        </div>
                        <hr>
                        <ul class="doctoe-sedual d-flex align-items-center justify-content-between p-0 m-0">
                           <li class="text-center">
                              <h3 class="counter">{{ counterPatients }}</h3>
                              <span>Patients</span>
                           </li>
                           <li class="text-center">
                              <h3 class="counter">{{ counterConsultation }}</h3>
                              <span>Consultations</span>
                           </li>
                           <li class="text-center">
                              <h3 class="counter">{{ totalCabinet }} DH</h3>
                              <span>Revenu Cabinet</span>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12 col-lg-9">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between color-template">
                           <div class="iq-header-title ">
                              <h4 class="card-title text-white">Liste des Patient : Mr {{ docteur.name }} </h4>
                           </div>                        
                        </div>
                        <div class="iq-card-body">
                           <ListDocteur :items="patients"></ListDocteur>
                        </div>
                     </div>
                  </div>


               </div>
            </div>
         </div>
      </div>
      <Edit :docteur="docteur"></Edit>
      <EditPassword></EditPassword>
   </AdminLayout>
</template>

<script setup >
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Edit from "./Edit.vue";
import ListDocteur from "./List.vue";
import EditPassword from "./EditPassword.vue";
defineProps({
   docteur: Object,
   patients: Object,
   consultations: Object,
   counterConsultation: '',
   counterPatients: '',
   totalCabinet: Number

})

</script>
<style scoped>
.doctor-profile {
   text-align: center;
}

.avatar-130 {
   width: 110px;
   /* Ajustez la largeur et la hauteur selon vos besoins */
   height: 130px;
   border-radius: 80%;
   /* Cette propriété crée un cercle en utilisant une bordure arrondie de 50% */
   border: 2px solid #fff;
   /* Ajoutez une bordure blanche pour délimiter l'image */
   background-color: #fff;
   /* Définit la couleur de fond du cercle en blanc */
}
</style>