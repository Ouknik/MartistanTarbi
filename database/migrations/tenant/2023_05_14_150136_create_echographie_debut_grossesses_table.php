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
        Schema::create('echographie_debut_grossesses', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->text('indication')->nullable();
            $table->text('uterus')->nullable();
            $table->text('oeuf')->nullable();
            $table->text('embryon')->nullable();
            $table->text('sacGestationnel')->nullable();
            $table->text('aControler')->nullable();
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
        Schema::dropIfExists('echographie_debut_grossesses');
    }
};
