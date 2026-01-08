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
        Schema::create('echographie_deuxieme_trimestres', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('indication')->nullable();
            $table->string('grossesse_unique')->nullable();
            $table->string('activite_cardiaque')->nullable();
            $table->string('mouvements_actifs')->nullable();
            $table->string('mouvements_respiratoires')->nullable();
            $table->string('presentation')->nullable();
            $table->string('liquide_amniotique')->nullable();
            $table->string('placenta_localisation')->nullable();
            $table->string('placenta_grade')->nullable();
            $table->string('placenta_cordon')->nullable();
            $table->string('diametre_biparietal')->nullable();
            $table->string('diametre_biparietal_sa')->nullable();
            $table->string('diametre_biparietal_j')->nullable();
            $table->string('longueur_femur')->nullable();
            $table->string('longueur_femur_sa')->nullable();
            $table->string('longueur_femur_j')->nullable();
            $table->string('diam_abd_trans')->nullable();
            $table->string('diam_abd_trans_sa')->nullable();
            $table->string('diam_abd_trans_j')->nullable();
            $table->string('circonf_abd')->nullable();
            $table->string('circonf_abd_sa')->nullable();
            $table->string('circonf_abd_j')->nullable();
            $table->string('crane')->nullable();
            $table->string('rachis')->nullable();
            $table->string('coeur')->nullable();
            $table->string('estomac')->nullable();
            $table->string('vessie')->nullable();
            $table->string('reins')->nullable();
            $table->string('membres')->nullable();
            $table->string('paroi_abdominale')->nullable();
            $table->text('conclusion')->nullable();
            $table->foreignId('consultation_id')->constrained();
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
        Schema::dropIfExists('echographie_deuxieme_trimestres');
    }
};
