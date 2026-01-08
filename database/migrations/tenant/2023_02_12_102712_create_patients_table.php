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
        Schema::disableForeignKeyConstraints();
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('cinPatient')->nullable();
            $table->string('codePatient')->nullable();
            $table->string('nomPatient');
            $table->string('prenomPatient');
            $table->string('sexePatient')->nullable();
            $table->string('adressePatient')->nullable();
            $table->string('villePatient')->nullable();
            $table->string('telephonePatient')->nullable();
            $table->string('emailPatient')->nullable();
            $table->string('statutPatient')->nullable();
            $table->date('dateNaissancePatient')->nullable();
            $table->string('nationalitePatient')->nullable();
            $table->boolean('isActive')->default(false);
            $table->string('descriptionPatient')->nullable();
            $table->foreignId('assurance_id')->constrained();
            $table->integer('suiviPar')->nullable();
            $table->integer('ClassListAtt')->nullable();
            $table->string('conjointPatient')->nullable();
            $table->string('groupeSanguinPatient')->nullable();
            $table->string('civilitePatient')->nullable();
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
        Schema::dropIfExists('patients');
    }
};
