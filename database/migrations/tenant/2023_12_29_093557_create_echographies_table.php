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
        Schema::create('echographies', function (Blueprint $table) {
            $table->id();
            $table->string('typeEcho');
            $table->date('dateEcho')->nullable();
            $table->longText('contenuEcho');
            $table->foreignId('consultation_id')->constrained();
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
        Schema::dropIfExists('echographies');
    }
};
