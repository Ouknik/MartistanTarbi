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
        Schema::create('medicaments_traitements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicament_id')->constrained();
            $table->foreignId('traitement_id')->constrained();
            $table->integer('NombreComprime')->nullable();
            $table->integer('quantiteParJour')->nullable();
            $table->integer('dureeNombre');
            $table->string('momentDePrise'); //Avant Repas -- Milieu Repas -- Aprés Repas
            $table->string('duree'); // Jours Semaine Mois
            // $table->string('typeOrdonnance');
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
        Schema::dropIfExists('medicaments_traitements');
    }
};
