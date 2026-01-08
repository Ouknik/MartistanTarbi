<template>
    <AdminLayout>
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-body p-0">
                        <div class="iq-edit-list">
                            <ul class="iq-edit-profile d-flex nav nav-pills">
                                <li class="col-md-3 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                        La liste des Docteurs
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd"><i class="ion-plush"></i>
                                        Ajouter Docteur
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#ajoutsecretaire">
                                        Ajouter Secretaire
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                        Les Rendez Vous
                                    </a>
                                </li>
                            </ul>
                            <!-- <span class="font-medium">
                                   {{ $page.props.flash.message }}
                             </span> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show flex" id="personal-information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-6 col-md-3" v-for="docteur in docteurs" v-bind:key="docteur.id">
                                   <div class="iq-card">
                                        <div class="iq-card-body text-center">
                                        <div class="doc-profile">
                                            <img class="rounded-circle img-fluid avatar-80" src="images/user/12.jpg" alt="profile">
                                        </div>
                                        <div class="iq-doc-info mt-3">
                                            <h4> {{docteur.nomDocteur}} {{docteur.prenomDocteur}}</h4>
                                            <h5  style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;; ">Docteur</h5>
                                            <p class="mb-0" >{{docteur.specialiteDocteur}}</p>
                                            <p class="mb-0" >Tel :{{docteur.telephoneDocteur}}</p>
                                            <p class="mb-0" >Departement :{{docteur.departementDocteur}}</p>
                                            <a href="javascript:void();">{{docteur.adresseDocteur}}</a>
                                        </div>
                                        <div class="iq-doc-description mt-2">
                                            <!-- <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor non erat non gravida. In id ipsum consequat</p>
                                             -->
                                             <p class="mb-0">{{docteur.descriptionDocteur}}</p>
                                        </div>
                                        <div class="iq-doc-social-info mt-3 mb-3">
                                            <ul class="m-0 p-0 list-inline">
                                                <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                                                <li><a href="#"><i class="ri-twitter-fill"></i></a> </li>
                                                <li><a href="#"><i class="ri-google-fill"></i></a></li>
                                            </ul>
                                        </div>
                                        <Link :href="route('docteurs.show',docteur)"  preserve-scroll class="btn btn-primary">
                                            View Profile
                                         </Link>

                                        <!-- <a href="profile.html" class="btn btn-primary">View Profile</a> -->
                                        </div>
                                        <!-- <div class="text-center mt-0" >
                                        <Link @click="destroy(docteur.id)" :href="route('docteurs.show',docteur)"  preserve-scroll class="btn btn-danger" >
                                            Supprimer
                                         </Link>
                                        </div> -->
                                        <div class="text-center mt-0" >
                                            <button type="button" preserve-scroll class="btn btn-danger" @click="deleteDocteur(docteur.id)">Supprimer</button>
                                        </div>

                                        {{ docteur.id }}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3" v-for="secretaire in secretaires" v-bind:key="secretaire.id">
                                   <div class="iq-card">
                                        <div class="iq-card-body text-center">
                                        <div class="doc-profile">
                                            <img class="rounded-circle img-fluid avatar-80" src="images/user/12.jpg" alt="profile">
                                        </div>
                                        <div class="iq-doc-info mt-3">
                                            <h4> {{secretaire.nomSecretaire}} {{secretaire.prenomSecretaire}}</h4>
                                            <h5  class="mb-0" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;  color: crimson; ">Secretaire</h5>
                                            <p class="mb-0" >Tel :{{secretaire.telephoneSecretaire}}</p>
                                            <p class="mb-0" >Email :{{secretaire.emailSecretaire}}</p>
                                            <a href="javascript:void();">{{secretaire.adresseSecretaire}}</a>
                                        </div>
                                        <div class="iq-doc-description mt-2">
                                            <!-- <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor non erat non gravida. In id ipsum consequat</p>
                                             -->
                                             <p class="mb-0">{{secretaire.descriptionSecretaire}}</p>
                                        </div>
                                        <div class="iq-doc-social-info mt-3 mb-3">
                                            <ul class="m-0 p-0 list-inline">
                                                <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                                                <li><a href="#"><i class="ri-twitter-fill"></i></a> </li>
                                                <li><a href="#"><i class="ri-google-fill"></i></a></li>
                                            </ul>
                                        </div>
                                        <Link :href="route('secretaires.show',secretaire)"  preserve-scroll class="btn btn-primary">
                                            View Profile
                                         </Link>

                                        <!-- <a href="profile.html" class="btn btn-primary">View Profile</a> -->
                                        </div>
                                        <!-- <div class="text-center mt-0" >
                                        <Link @click="destroy(secretaire.id)" :href="route('secretaires.show',secretaire)"  preserve-scroll class="btn btn-danger" >
                                            Supprimer
                                         </Link>
                                        </div> -->
                                        <div class="text-center mt-0" >
                                            <button type="button" preserve-scroll class="btn btn-danger" @click="deletesecretaire(secretaire.id)">Supprimer</button>
                                        </div>

                                        {{ secretaire.id }}
                                    </div>
                                </div>

                            </div>



                        </div>
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Ajouter Patient</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">

                                    <Create  />

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ajoutsecretaire" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Ajout Secretaire</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <CreateSecretaire/>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Manage Contact</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="cno">Contact Number:</label>
                                            <input type="text" class="form-control" id="cno" value="001 2536 123 458">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="text" class="form-control" id="email" value="Binijone@demo.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="url">Url:</label>
                                            <input type="text" class="form-control" id="url"
                                                value="https://getbootstrap.com">
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button type="reset" class="btn iq-bg-danger">cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
//const rendezVous=null
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
// import {Inertia} from "@inertiajs/inertia";
// import List from "./List.vue";
import Create from "./Create.vue";
import CreateSecretaire from "../Secretaires/CreateSecretaire.vue";



defineProps ({
    docteurs : Object,
    patients : Object,
    secretaires:Object,
   // docteursSelect:Object,
    specialites:[]

    //listeattente: Object,
    //rendezVous: rendezVous,
});


const headers = [
    { text: "ID", value: "id", sortable: true },
    { text: "Nom", value: "nomDocteur", sortable: true },
    { text: "Prenom", value: "prenomDocteur", sortable: true },
    { text: "Adress", value: "adresseDocteur", sortable: true },
    { text: "Tel", value: "telephoneDocteur", sortable: true },
    { text: "Specialite", value: "specialiteDocteur", sortable: true },
    { text: "Action", value: "operation" }
];
// const destroy = (id)=>{
//     if(confirm('are you sure')){
//         Inertia.delete('docteurs.destroy',id)
//     }
// }


const deleteDocteur=(docteur)=> {
    router.visit('/docteurs', {
        method: 'delete',
        data: docteur,
        preserveState: false,
        preserveScroll: false,
        errorBag: true,
        forceFormData: false,
        onBefore: () => confirm('Are you sure you want to delete this docteur?'),
        onProgress: progress => { },
        onSuccess: page => { alert('Bien supprimer') },
        onError: errors => { alert('Erreurs de la suppression') },
    });
    // router.delete('/docteurs/docteur'),{
    //     onBefore: () => confirm('Are you sure you want to delete this docteur?'),
    // }
}

// const listeAttente = [
//     {
//         "id": "Curry",
//         "cinPatient": 178,
//         "nomPatient": 77,
//         "prenomPatient": 20,
//          "sexePatient": 20
//     },
//];




</script>

<style>
</style>
