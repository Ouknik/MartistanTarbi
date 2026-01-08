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
        Schema::create('ordonnances_medicaments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordonnance_id')->constrained();
            $table->foreignId('medicament_id')->constrained();
            $table->string('prescription'); // Jours Semaine Mois
            $table->string('typeOrdonnance');// Normal / Enfant / Mere
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
        Schema::dropIfExists('ordonnances_medicaments');
    }
};
