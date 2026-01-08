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
        Schema::create('echographie_deuxieme_trimestre_gems', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('indication')->nullable();
            $table->string('grossesse_gemellaire')->nullable(); // Nombre de fœtus
            $table->string('activite_cardiaque')->nullable(); // Activité cardiaque
            $table->string('mouvements_actifs')->nullable(); // Mouvements actifs
            $table->string('mouvements_respiratoires')->nullable(); // Mouvements respiratoires
            $table->string('presentation1')->nullable(); // Présentation
            $table->string('presentation2')->nullable(); // Présentation
            $table->string('liquide_amniotique')->nullable(); // Liquide amniotique
            $table->string('localisation_placenta')->nullable(); // Localisation du placenta
            $table->string('grade_placenta')->nullable(); // Grade du placenta
            $table->string('cordon')->nullable(); // Cordon
            $table->string('diametre_biparietal_1')->nullable(); // Diamètre Bipariétal du premier fœtus
            $table->string('diametre_biparietal_1_sa')->nullable();
            $table->string('diametre_biparietal_1_j')->nullable();
            $table->string('longueur_femur_1')->nullable(); // Longueur du Fémur du premier fœtus
            $table->string('longueur_femur_1_sa')->nullable(); // Longueur du Fémur du premier fœtus
            $table->string('longueur_femur_1_j')->nullable(); // Longueur du Fémur du premier fœtus
            $table->string('diametre_biparietal_2')->nullable(); // Diamètre Bipariétal du second fœtus
            $table->string('diametre_biparietal_2_j')->nullable();
            $table->string('diametre_biparietal_2_sa')->nullable();
            $table->string('longueur_femur_2')->nullable(); // Longueur du Fémur du second fœtus
            $table->string('longueur_femur_2_sa')->nullable(); // Longueur du Fémur du premier fœtus
            $table->string('longueur_femur_2_j')->nullable(); //
            $table->string('diam_abd_trans')->nullable(); // Diamètre abdominal transversal
            $table->string('diam_abd_trans_sa')->nullable(); // Diamètre abdominal transversal
            $table->string('diam_abd_trans_j')->nullable(); // Diamètre abdominal transversal
            $table->string('circonf_abd')->nullable();
            $table->string('circonf_abd_sa')->nullable();
            $table->string('circonf_abd_j')->nullable();
            $table->string('crane')->nullable(); // Crane : contour bien suivi
            $table->string('rachis')->nullable(); // Rachis : bien suivi
            $table->string('coeur')->nullable(); // Coeur : 4 cavités
            $table->string('estomac')->nullable(); // Estomac : vu
            $table->string('vessie')->nullable(); // Vessie : vu
            $table->string('reins')->nullable(); // Reins : normaux
            $table->string('membres')->nullable(); // Membres : 4
            $table->string('paroi_abdominale')->nullable(); // Paroi abdominale : intègre
            $table->text('conclusion')->nullable(); // Paroi abdominale : intègre
            $table->timestamps();
            $table->foreignId('consultation_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('echographie_deuxieme_trimestre_gems');
    }
};
