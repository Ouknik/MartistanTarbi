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
        Schema::create('echographie_gynecologiques', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('uterus')->nullable();
            $table->string('caviteUterine')->nullable();
            $table->string('endometre')->nullable();
            $table->string('annexeGauche')->nullable();
            $table->string('annexeDroite')->nullable();
            $table->string('culDeSacDouglas')->nullable();
            $table->string('conclusion')->nullable();
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
        Schema::dropIfExists('echographie_gynecologiques');
    }
};
