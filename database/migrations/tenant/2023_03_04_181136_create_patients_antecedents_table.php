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
        Schema::create('patients_antecedents', function (Blueprint $table) {
            $table->id();
            $table->string('valeurAntecedent')->nullable();
            $table->string('descriptientAntecedent')->nullable();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('antecedent_id')->constrained();
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
        Schema::dropIfExists('patients_antecedents');
    }
};
