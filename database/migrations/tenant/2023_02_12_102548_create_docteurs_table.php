<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docteurs', function (Blueprint $table) {
            $table->id();
            $table->string('codeDocteur')->nullable();
            $table->string('nomDocteur')->nullable();
            $table->string('prenomDocteur')->nullable();
            $table->string('adresseDocteur')->nullable();
            $table->string('telephoneDocteur')->nullable();
            $table->enum('specialiteDocteur', [
                "Généco-Obstétrique",
                "Cardiologie",
                "Traumatologie",
                "Ophtalmologie",
                "ORL",
                "Pédiatrie",
                "Chirurgie Infentile",
                "Neurologie",
                "Dermatologie",
                "Endocrinologie",
                "Pre-Anastésie",
                "Gastro-Ethérologie",
                "Rhumatologie",
                "Dentiste",
            ])->nullable();
            $table->enum("sexeDocteur", ["Masculin", "Féminin"])->nullable();
            $table->string('villeDocteur')->nullable();
            $table->string('emailDocteur')->nullable();
            $table->enum('departementDocteur', [
                "Pôle Femme – Mère – Enfant – Nouveau-né",
                "Pôle Tête et Cou",
                "Pôle Trauma Center",
                "Spécialités Chirurgicales",
                "Spécialités Médicales",
                "Urgences",
                "Imagerie Médicale et Laboratoire",
            ])->nullable();
            $table->date('dateNaissanceDocteur')->nullable();
            $table->enum('nationaliteDocteur', [
                'Etranger',
                'Marocain',
                "Marocains Residant à Etranger",
            ])->nullable();
            $table->string('descriptionDocteur')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docteurs');
    }
};
