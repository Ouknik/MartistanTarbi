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
        Schema::create('operation_patients', function (Blueprint $table) {
            $table->id();
            $table->date('dateOperation');
            $table->float('prixOperation')->nullable();
            $table->float('MontantValideeOperation')->nullable();
            $table->float('MontantRestantOperation')->nullable();
            $table->string('nomOperation')->nullable();
            $table->string('descriptionOperation')->nullable();
            $table->foreignId('clinique_id')->constrained('cliniques')->nullable();
            $table->string('etatOperation')->nullable();
            $table->integer('orderOperation')->nullable();
            $table->string('typeAssurance')->nullable();
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
        Schema::dropIfExists('operation_patients');
    }
};
