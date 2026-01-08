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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->date('dateFacture');
            $table->float('tvaFacture')->nullable();
            $table->float('montantFacture');
            $table->float('montantApayer')->nullable();
            $table->string('montantLettre')->nullable();
            $table->json('soins');
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('paiement_id')->constrained();
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
        Schema::dropIfExists('factures');
    }
};
