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
        Schema::create('patients_permis', function (Blueprint $table) {
            $table->id();
            $table->string('numeroDossier');
            $table->string('nom');
            $table->string('prenom');
            $table->date('dateNaissance')->nullable();
            $table->string('genre')->nullable();
            $table->date('dateVisite')->nullable();
            $table->float('montantAPayer');
            $table->float('montantPayer')->nullable();
            $table->foreignId('patient_id')->constrained();
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
        Schema::dropIfExists('patients_permis');
    }
};
