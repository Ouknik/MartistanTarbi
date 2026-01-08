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
        Schema::create('echographie_mammaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->text('motif_examen')->nullable();
            $table->text('DDR')->nullable();
            $table->longText('compte_rendu')->nullable();
            $table->longText('conclusion')->nullable();
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
        Schema::dropIfExists('echographie_mammaires');
    }
};
