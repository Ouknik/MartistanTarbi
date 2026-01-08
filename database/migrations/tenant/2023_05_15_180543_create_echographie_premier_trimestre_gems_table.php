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
        Schema::create('echographie_premier_trimestre_gems', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('indication')->nullable();
            $table->string('uterus')->nullable();
            $table->string('oeuf_nombre')->nullable();
            $table->string('oeuf_aspect')->nullable();
            $table->string('vesicule_ombilicale_mm')->nullable();
            $table->string('embryon_nombre')->nullable();
            $table->string('activite_cardiaque')->nullable();
            $table->string('mouvements_actifs')->nullable();;
            $table->string('clarte_nucale_mm')->nullable();
            $table->string('long_cranio_caudale_1_mm')->nullable();
            $table->string('long_cranio_caudale_1_sa')->nullable();
            $table->string('long_cranio_caudale_1_j')->nullable();
            $table->string('long_cranio_caudale_2_mm')->nullable();
            $table->string('long_cranio_caudale_2_sa')->nullable();
            $table->string('long_cranio_caudale_2_j')->nullable();
            $table->string('diametre_biparietal_1_mm')->nullable();
            $table->string('diametre_biparietal_1_sa')->nullable();
            $table->string('diametre_biparietal_1_j')->nullable();
            $table->string('diametre_biparietal_2_mm')->nullable();
            $table->string('diametre_biparietal_2_sa')->nullable();
            $table->string('diametre_biparietal_2_j')->nullable();
            $table->string('annexe_gauche')->nullable();
            $table->string('annexe_droite')->nullable();
            $table->string('conclusion')->nullable();
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
        Schema::dropIfExists('echographie_premier_trimestre_gems');
    }
};
