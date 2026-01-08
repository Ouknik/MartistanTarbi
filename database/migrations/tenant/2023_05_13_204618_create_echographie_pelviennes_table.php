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
        Schema::create('echographie_pelviennes', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->text('indication')->nullable();
            $table->text('vessie')->nullable();
            $table->text('vaginetcol')->nullable();
            $table->text('uterus_position')->nullable();
            $table->text('uterus_contours')->nullable();
            $table->text('uterus_echo_structure')->nullable();
            $table->text('endometre')->nullable();
            $table->text('uterine_cavite')->nullable();
            $table->text('ovaire_droit')->nullable();
            $table->text('ovaire_gauche')->nullable();
            $table->text('trompe_droit')->nullable();
            $table->text('trompe_gauche')->nullable();
            $table->text('douglass')->nullable();
            $table->text('conclusion')->nullable();
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
        Schema::dropIfExists('echographie_pelviennes');
    }
};
