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
        Schema::create('secretaires', function (Blueprint $table) {
            $table->id();
            $table->string('cinSecretaire')->nullable();
            $table->string('nomSecretaire')->nullable();
            $table->string('prenomSecretaire')->nullable();
            $table->string('dateNaissanceSecretaire')->nullable();
            $table->string('telephoneSecretaire')->nullable();
            $table->string('adresseSecretaire')->nullable();
            $table->string('sexeSecretaire')->nullable();
            $table->string('villeSecretaire')->nullable();
            $table->string('emailSecretaire')->nullable();
            $table->string('nationaliteSecretaire')->nullable();
            $table->string('descriptionSecretaire')->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('secretaires');
    }
};
