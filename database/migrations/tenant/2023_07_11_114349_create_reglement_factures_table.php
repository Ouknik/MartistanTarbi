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
        Schema::create('reglement_factures', function (Blueprint $table) {
            $table->id();
            $table->float('montantReglement');
            $table->string('modePaiement');
            $table->date('dateReglement');
            $table->string('motifVisite');
            $table->string('typeAssurance');
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('reglement_factures');
    }
};
