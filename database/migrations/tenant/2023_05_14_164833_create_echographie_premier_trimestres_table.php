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
        Schema::create('echographie_premier_trimestres', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('indication')->nullable();;
            $table->string('uterus')->nullable();;
            $table->string('oeufUnique')->nullable();;
            $table->string('aspect')->nullable();
            $table->string('vesicule_ombilicale')->nullable();
            $table->string('embryonUnique')->nullable();
            $table->string('activite_cardiaque')->nullable();
            $table->string('mouvements_actifs')->nullable();
            $table->string('clarte_nucale')->nullable();
            $table->string('long_cranio_caudale')->nullable();
            $table->string('diametre_biparietal')->nullable();
            $table->string('long_cranio_caudaleSoitSemaines')->nullable();
            $table->string('long_cranio_caudaleSoitJours')->nullable();
            $table->string('diametre_biparietalSoitSemaines')->nullable();
            $table->string('diametre_biparietalSoitJours')->nullable();
            $table->string('annexe_gauche')->nullable();
            $table->string('annexe_droite')->nullable();
            $table->text('conclusion')->nullable();
            $table->text('conclusionde')->nullable();
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
        Schema::dropIfExists('echographie_premier_trimestres');
    }
};
