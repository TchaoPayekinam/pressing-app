<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->date('date_depot');
            $table->date('date_livraison');
            $table->float('frais_livraison')->nullable();
            $table->string('adresse_livraison')->nullable();
            $table->float('remise');
            $table->string('nom_client');
            $table->string('prenom_client')->nullable();
            $table->string('adresse_client');
            $table->string('tel_client');
            $table->tinyInteger('express')->default(0);
            $table->tinyInteger('statut')->default(0);
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
        Schema::dropIfExists('commandes');
    }
}
